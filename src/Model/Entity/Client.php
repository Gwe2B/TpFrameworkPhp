<?php

namespace App\Model\Entity;

use Authentication\IdentityInterface;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Client extends Entity implements IdentityInterface
{
    protected $_accessible = [
        '*' => true,
        'id_client' => false
    ];

    public function getIdentifier()
    {
        return $this->id_client;
    }

    public function getOriginalData()
    {
        return $this;
    }

    protected function _setMdp_client($password) {
        if(strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

    protected function _getFullname() {
        return $this->prenom_client.' '.$this->nom_client;
    }
}