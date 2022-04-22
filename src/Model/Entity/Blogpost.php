<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class Blogpost extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _setAuthor($id) {
        var_dump(gettype($id));
        return intval($id);
    }

    protected function _getAuthor($authorId) {
        $authorsTable = TableRegistry::getTableLocator()->get('Client');

        return $authorsTable->find('all')
                            ->where(['id_client = ' => $authorId])
                            ->all()
                            ->first();
    }

    protected function _getComments() {
        $commentsTable = TableRegistry::getTableLocator()->get('Comments');

        return $commentsTable->find('all')
                             ->where(['blogpost_id = '=>$this->id])
                             ->all()
                             ->toArray();
    }
}