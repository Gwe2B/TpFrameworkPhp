<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['semantic.min']) ?>
    <?= $this->Html->script(['semantic.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <style type="text/css">
        body {
            background-color: #DADADA;
        }

        body>.grid {
            height: 100%;
        }

        .image {
            margin-top: -100px;
        }

        .column {
            max-width: 450px;
        }
    </style>
</head>

<body>

    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui teal image header">
                <!--<img src="assets/images/logo.png" class="image">-->
                <div class="content">
                    Sign-Up
                </div>
            </h2>
            <form action="/client/signup" method="post" class="ui large form">
                <?= $this->Form->create(); ?>
                <div class="ui stacked segment">
                    <div class="field">
                        <label>Nom</label>
                        <input type="text" name="nom_client" placeholder="Nom">
                    </div>
                    <div class="field">
                        <label>Prénom</label>
                        <input type="text" name="prenom_client" placeholder="Prénom">
                    </div>
                    <div class="field">
                        <label>E-mail</label>
                        <input type="text" name="mail_client" placeholder="E-mail">
                    </div>
                    <div class="field">
                        <label>Login</label>
                        <input type="text" name="login_client" placeholder="Prénom">
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <input type="password" name="mdp_client" placeholder="Password">
                    </div>
                    <button class="ui fluid large teal submit button" type="submit">Sign-Up</button>
                    <?= $this->Form->end(); ?>
                </div>

                <div class="ui error message">
                    <?= $this->Flash->render(); ?>
                </div>

            </form>
        </div>
    </div>

</body>

</html>