<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Contrôleur pour la galerie de composants
 *
 * Affiche tous les composants AdminLTE disponibles avec des exemples
 * et permet de copier facilement le code
 */
class ComponentsController extends AppController
{
    /**
     * Afficher tous les composants disponibles
     *
     * @return void
     */
    public function index()
    {
        $components = $this->loadComponents();
        $this->set(compact('components'));
    }

    /**
     * Afficher un groupe de composants spécifique
     *
     * @param string|null $group Le groupe de composants à afficher
     * @return \Cake\Http\Response|null
     */
    public function view(?string $group = null)
    {
        if (!$group) {
            return $this->redirect(['action' => 'index']);
        }

        $components = $this->loadComponents();

        if (!isset($components[$group])) {
            throw new \Exception("Groupe de composants non trouvé: $group");
        }

        $component = $components[$group];
        $variants = $component['variants'] ?? [];

        $this->set(compact('group', 'component', 'variants'));
    }

    /**
     * Charger les définitions des composants depuis le fichier JSON
     *
     * @return array
     */
    private function loadComponents(): array
    {
        $jsonPath = ROOT . '/resources/data/components.json';

        if (!file_exists($jsonPath)) {
            return [];
        }

        $json = file_get_contents($jsonPath);
        return json_decode($json, true) ?? [];
    }
}
