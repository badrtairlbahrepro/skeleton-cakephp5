<?php

/**
 * Contrôleur pour tester les pages d'erreur
 *
 * Permet de déclencher différents types d'erreurs HTTP
 * pour vérifier que les pages d'erreur s'affichent correctement.
 */

 /**
  * @strict
  */
 declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\UnauthorizedException;

class ErrorTestController extends AppController
{
    /**
     * Page d'accueil du testeur d'erreur
     *
     * Affiche les boutons pour déclencher les différentes erreurs.
     */
    public function index()
    {
        $this->set('title', 'Test des Pages d\'Erreur');
    }

    /**
     * Déclencher une erreur 404 (non trouvé)
     */
    public function error404()
    {
        throw new NotFoundException('Page non trouvée - Ressource inexistante');
    }

    /**
     * Déclencher une erreur 403 (accès refusé)
     */
    public function error403()
    {
        throw new ForbiddenException('Accès refusé - Vous n\'avez pas les permissions nécessaires');
    }

    /**
     * Déclencher une erreur 400 (requête invalide)
     */
    public function error400()
    {
        throw new BadRequestException('Requête invalide - Les paramètres envoyés sont incorrects');
    }

    /**
     * Déclencher une erreur 401 (non authentifié)
     */
    public function error401()
    {
        throw new UnauthorizedException('Non authentifié - Veuillez vous connecter');
    }

    /**
     * Déclencher une erreur 500 (erreur interne)
     */
    public function error500()
    {
        throw new InternalErrorException('Erreur interne du serveur - Une erreur inattendue s\'est produite');
    }

    /**
     * Déclencher une erreur générique
     *
     * Teste le template error.php par défaut
     */
    public function generic()
    {
        throw new \Exception('Erreur générique - Ceci testera le template error.php');
    }
}
