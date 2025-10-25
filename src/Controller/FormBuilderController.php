<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Contrôleur pour démontrer l'utilisation du FormBuilder AdminLTE
 *
 * Montre comment utiliser le AdminLteFormHelper pour créer
 * des formulaires avec le style AdminLTE rapidement
 */
class FormBuilderController extends AppController
{
    /**
     * Page d'accueil du FormBuilder
     *
     * @return void
     */
    public function index()
    {
        // Pas de logique particulière, juste l'affichage
    }

    /**
     * Exemple de formulaire de contact
     *
     * @return void
     */
    public function contact()
    {
        // Simulation de données pour l'exemple
        $this->set('contactData', [
            'name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'subject' => 'Question',
            'message' => 'Bonjour, j\'aimerais avoir plus d\'informations...'
        ]);
    }

    /**
     * Exemple de formulaire d'inscription
     *
     * @return void
     */
    public function register()
    {
        // Simulation de données pour l'exemple
        $this->set('registerData', [
            'firstname' => 'Jean',
            'lastname' => 'Dupont',
            'email' => 'jean@example.com',
            'password' => '',
            'confirm_password' => '',
            'terms' => false
        ]);
    }

    /**
     * Exemple de formulaire de profil utilisateur
     *
     * @return void
     */
    public function profile()
    {
        // Simulation de données pour l'exemple
        $this->set('profileData', [
            'firstname' => 'Jean',
            'lastname' => 'Dupont',
            'email' => 'jean@example.com',
            'phone' => '+33 1 23 45 67 89',
            'bio' => 'Développeur passionné par les nouvelles technologies.',
            'avatar' => '',
            'notifications' => true,
            'newsletter' => false
        ]);
    }

    /**
     * Exemple de formulaire de recherche avancée
     *
     * @return void
     */
    public function search()
    {
        // Simulation de données pour l'exemple
        $this->set('searchData', [
            'keywords' => 'CakePHP AdminLTE',
            'category' => 'web',
            'date_from' => '2024-01-01',
            'date_to' => '2024-12-31',
            'status' => 'active',
            'file_type' => ''
        ]);
    }

    /**
     * Exemple de formulaire avec sélecteurs multiples
     *
     * @return void
     */
    public function multiple()
    {
        // Simulation de données pour l'exemple
        $this->set('multipleData', [
            'skills' => ['php', 'javascript'],
            'languages' => ['fr', 'en'],
            'interests' => ['web', 'mobile']
        ]);
    }

    /**
     * Exemple de formulaire avec switches
     *
     * @return void
     */
    public function switches()
    {
        // Simulation de données pour l'exemple
        $this->set('switchData', [
            'notifications' => true,
            'dark_mode' => false,
            'auto_save' => true,
            'public_profile' => false
        ]);
    }
}
