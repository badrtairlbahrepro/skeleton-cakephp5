<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Contrôleur pour visualiser les logs
 *
 * Interface Telescope-like pour consulter et gérer les fichiers de log.
 * Permet de voir, filtrer et télécharger les logs en direct.
 */
class LogsController extends AppController
{
    /**
     * Répertoire des logs
     */
    private string $logsDir;

    /**
     * Constructeur
     */
    public function __construct(
        \Psr\Http\Message\ServerRequestInterface $request = null,
        \Psr\Http\Message\ResponseInterface $response = null,
        string $name = null,
        \Cake\Event\EventManager $eventManager = null,
        \Cake\Http\Controller\ComponentRegistry $components = null
    ) {
        parent::__construct($request, $response, $name, $eventManager, $components);
        // Définir le chemin du répertoire des logs
        $this->logsDir = LOGS;
    }

    /**
     * Lister tous les fichiers de log disponibles
     */
    public function index(): void
    {
        $logFiles = [];

        // Récupérer tous les fichiers de log
        if (is_dir($this->logsDir)) {
            $files = scandir($this->logsDir);
            if ($files !== false) {
                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..' && substr($file, -4) === '.log') {
                        $filePath = $this->logsDir . $file;
                        $logFiles[] = [
                            'name' => $file,
                            'path' => $filePath,
                            'size' => filesize($filePath),
                            'modified' => date('Y-m-d H:i:s', filemtime($filePath)),
                        ];
                    }
                }
            }
        }

        // Sort by modification date (newest first)
        usort($logFiles, function ($a, $b) {
            return $b['modified'] <=> $a['modified'];
        });

        $this->set(compact('logFiles'));
    }

    /**
     * Afficher le contenu d'un fichier de log spécifique
     *
     * @param string|null $filename Le nom du fichier de log
     * @return \Cake\Http\Response|null
     */
    public function view(?string $filename = null): ?\Cake\Http\Response
    {
        // Lire et afficher un fichier de log
        // Prevent directory traversal
        $filename = $filename ? basename($filename) : '';
        if (substr($filename, -4) !== '.log') {
            $filename .= '.log';
        }

        $filePath = $this->logsDir . $filename;

        if (!file_exists($filePath)) {
            $this->Flash->error('Fichier de log non trouvé: ' . $filename);
            return $this->redirect(['action' => 'index']) ?? $this->response;
        }

        // Get file content
        $content = file_get_contents($filePath);
        if ($content === false) {
            $this->Flash->error('Impossible de lire le fichier de log');
            return $this->redirect(['action' => 'index']) ?? $this->response;
        }

        $lines = explode("\n", trim($content));

        // Get pagination parameters
        $page = (int)$this->request->getQuery('page', 1);
        $perPage = 100;
        $totalLines = count($lines);
        $totalPages = ceil($totalLines / $perPage);

        // Validate page
        if ($page < 1) {
            $page = 1;
        }
        if ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages;
        }

        // Get page lines (reverse order - newest first)
        $startIndex = ($totalPages - $page) * $perPage;
        $pageLines = array_reverse(array_slice($lines, max(0, $totalLines - ($page * $perPage)), $perPage));

        // Parse log lines to extract timestamp, level, and message
        $parsedLines = [];
        foreach ($pageLines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            $parsed = $this->parseLogLine($line);
            $parsedLines[] = $parsed;
        }

        $this->set(compact('filename', 'parsedLines', 'page', 'totalPages', 'totalLines'));
        return null;
    }

    /**
     * Parser et colorer une ligne de log
     */
    private function parseLogLine(string $line): array
    {
        // Analyser et formater une ligne de log
        $level = 'info';
        $timestamp = date('Y-m-d H:i:s');
        $message = $line;

        // Try to extract timestamp
        if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $line, $matches)) {
            $timestamp = $matches[0];
            $message = substr($line, strlen($timestamp) + 1);
        }

        // Try to extract level
        if (preg_match('/\[(ERROR|WARNING|DEBUG|INFO|NOTICE|CRITICAL)\]/i', $message, $matches)) {
            $level = strtolower($matches[1]);
        }

        // Determine color based on level
        $color = match ($level) {
            'error' => '#dc3545',
            'warning' => '#ffc107',
            'debug' => '#6c757d',
            'critical' => '#c82333',
            'notice' => '#17a2b8',
            default => '#28a745',
        };

        return [
            'timestamp' => $timestamp,
            'level' => $level,
            'message' => substr($message, 0, 500), // Limit message length
            'color' => $color,
        ];
    }

    /**
     * Vider un fichier de log
     */
    public function clear(?string $filename = null): \Cake\Http\Response
    {
        // Supprimer le contenu d'un fichier de log
        if (!$this->request->is('post')) {
            $this->Flash->error('Méthode de requête invalide');
            return $this->redirect(['action' => 'index']) ?? $this->response;
        }

        // Prevent directory traversal
        $filename = $filename ? basename($filename) : '';
        if (substr($filename, -4) !== '.log') {
            $filename .= '.log';
        }

        $filePath = $this->logsDir . $filename;

        if (file_exists($filePath)) {
            file_put_contents($filePath, '');
            $this->Flash->success('Fichier de log vidé: ' . $filename);
        } else {
            $this->Flash->error('Fichier de log non trouvé: ' . $filename);
        }

        return $this->redirect(['action' => 'view', $filename]) ?? $this->response;
    }

    /**
     * Télécharger un fichier de log
     */
    public function download(?string $filename = null): \Cake\Http\Response
    {
        // Télécharger un fichier de log sur l'ordinateur
        // Prevent directory traversal
        $filename = $filename ? basename($filename) : '';
        if (substr($filename, -4) !== '.log') {
            $filename .= '.log';
        }

        $filePath = $this->logsDir . $filename;

        if (!file_exists($filePath)) {
            $this->Flash->error('Fichier de log non trouvé: ' . $filename);
            return $this->redirect(['action' => 'index']) ?? $this->response;
        }

        // Set response for download
        $this->response = $this->response
            ->withType('text/plain')
            ->withHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

        // Read and return file content
        $content = file_get_contents($filePath);
        if ($content === false) {
            $this->Flash->error('Impossible de lire le fichier de log');
            return $this->redirect(['action' => 'index']) ?? $this->response;
        }

        return $this->response->withStringBody($content);
    }
}
