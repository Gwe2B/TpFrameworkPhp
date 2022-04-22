<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class BlogpostController extends AppController {
    // public function initialize(): void
    // {
    //     parent::initialize();
    //     $this->loadComponent('Auth');
    //     $this->Auth->setConfig('authenticate', [
    //         'Basic' => ['userModel' => 'Client'],
    //         'Form' => ['userModel' => 'Client']
    //     ]);
    // }

    public function index() {
        $this->set('posts', $this->Blogpost->find('all')->all()->toArray());
    }

    public function publishBlog() {
        $this->disableAutoRender();
        $blogpost = $this->Blogpost->newEmptyEntity();
        if ($this->request->is('post')) {
            // $data = $this->request->getData();
            // $blogpost->set('message', )
            $blogpost->message = $this->request->getData()['message'];
            
            // L'écriture de 'user_id' en dur est temporaire et
            // sera supprimé quand nous aurons mis en place l'authentification.
            var_dump($this->Authentication->getIdentity()->getIdentifier());
            // $blogpost->set('author', $this->Authentication->getIdentity()->getIdentifier());
            $blogpost->set('author', 
            TableRegistry::getTableLocator()->get('Client')->find('all')->all()->first()->id_client
        );

            if ($this->Blogpost->save($blogpost)) {
                $this->Flash->success(__('Votre article a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre article.'));
        }
        $this->set('article', $blogpost);
    }
}