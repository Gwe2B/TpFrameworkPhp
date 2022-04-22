<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class Comment extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _getAuthor() {
        $authorsTable = TableRegistry::getTableLocator()->get('Client');

        return $authorsTable->find('all')
                            ->where(['id_client = ' => $this->client_id])
                            ->all()
                            ->first();
    }
}