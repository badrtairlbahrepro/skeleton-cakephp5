<?php

declare(strict_types=1);

namespace App\Controller;

use Application\UseCases\User\CreateUserUseCase;
use Application\UseCases\User\GetUserUseCase;

/**
 * Users Controller
 *
 * This controller uses hexagonal architecture with dependency injection.
 * Use cases are automatically injected by the DI container.
 */
class UsersController extends AppController
{
    /**
     * Index method - List all users
     *
     * @param \Application\UseCases\User\GetUserUseCase $getUserUseCase Injected use case
     * @return void
     */
    public function index(GetUserUseCase $getUserUseCase): void
    {
        $users = $getUserUseCase->getAll();
        $this->set(compact('users'));
    }

    /**
     * View method - Display a single user
     *
     * @param \Application\UseCases\User\GetUserUseCase $getUserUseCase Injected use case
     * @param int|null $id User id
     * @return \Cake\Http\Response|null
     */
    public function view(GetUserUseCase $getUserUseCase, ?int $id = null): ?\Cake\Http\Response
    {
        try {
            // Assure que $id n'est pas null avant l'appel
            if ($id === null) {
                $this->Flash->error('L\'ID de l\'utilisateur est requis');
                return $this->redirect(['action' => 'index']);
            }
            $user = $getUserUseCase->execute($id);
            $this->set(compact('user'));
            return null;
        } catch (\RuntimeException $e) {
            $this->Flash->error($e->getMessage());
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method - Create a new user
     *
     * @param \Application\UseCases\User\CreateUserUseCase $createUserUseCase Injected use case
     * @return \Cake\Http\Response|null
     */
    public function add(CreateUserUseCase $createUserUseCase): ?\Cake\Http\Response
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            try {
                $user = $createUserUseCase->execute(
                    $data['email'],
                    $data['name']
                );

                $this->Flash->success('L\'utilisateur a été enregistré.');

                return $this->redirect(['action' => 'index']);
            } catch (\Exception $e) {
                $this->Flash->error($e->getMessage());
            }
        }
        return null;
    }

    /**
     * Dashboard method - Example dashboard page
     *
     * @return void
     */
    public function dashboard(): void
    {
        $this->set('title', 'Dashboard');
    }
}
