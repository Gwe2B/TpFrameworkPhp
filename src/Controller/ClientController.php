<?php

namespace App\Controller;

class ClientController extends AppController {

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configurer l'action login pour ne pas exiger d'authentification, et
        // ainsi empêcher un problème de boucle infinie de redirections
        $this->Authentication->addUnauthenticatedActions(['login', 'signup']);
    }

    public function login() {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // Qu'on soit en POST ou en GET, rediriger l'utilisateur s'il est déjà connecté
        if ($result->isValid()) {
            // rediriger vers /articles après une connexion réussie
            $redirect = $this->request->getQuery('redirect', [
                'controller' => '',
                'action' => 'index'
            ]);

            return $this->redirect($redirect);
        }
        // afficher une erreur si l'utilisateur a validé le formulaire mais que
        // l'authentification a échoué
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // Qu'on soit en POST ou en GET, rediriger l'utilisateur s'il est déjà connecté
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Client', 'action' => 'login']);
        }
    }

    public function signup() {

        $user = $this->Client->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Client->patchEntity($user, $this->request->getData());
            if ($this->Client->save($user)) {
                $this->Flash->success(__("L'utilisateur a été sauvegardé."));
                return $this->redirect(['action' => 'signup']);
            }
            $this->Flash->error(__("Impossible d'ajouter l'utilisateur."));
        }
        $this->set('client', $user);
    }
}