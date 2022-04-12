<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Client extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id_client' => false
    ];

    protected function _setMdp_client($password) {
        if(strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}