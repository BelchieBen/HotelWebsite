<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$title = 'Hotel Website';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <?= $this->Html->css(['pageLayout', 'form', 'navbar', 'tags', 'slideshow', 'alerts', 'popup', 'table']) ?>
    <?= $this->Html->script(['navbar', 'tags', 'slideshow', 'popup']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav>
        <ul class="menu">
            <li class="logo"><?= $this->Html->link('Hotel GMC',['controller' => 'home', 'action' => 'index']) ?></li>
            <li class="item"><?= $this->Html->link('Home',['controller' => 'home', 'action' => 'index']) ?></li>

            <?php  if ($this->request->getAttribute('identity')['role'] == 'admin'): ?>
                <li class="item"><?= $this->Html->link('Profile',['controller' => 'users', 'action' => 'profile']) ?></li>
                <li class="item"><?= $this->Html->link('Admin',['controller' => 'admin', 'action' => 'index']) ?></li>

            <?php else: ?>
                <li class="item"><?= $this->Html->link('Profile',['controller' => 'users', 'action' => 'profile']) ?></li>

            <?php endif ?>
            </li>
            <?php if (is_null($this->request->getAttribute('identity'))): ?>
                <li class="item button"><?= $this->Html->link('Log In',['controller' => 'users', 'action' => 'login']) ?></li>

            <?php else: ?>  
                <li class="item button"><?= $this->Html->link('Log Out',['controller' => 'users', 'action' => 'logout']) ?></li>

            <?php endif ?>

            <li class="item button secondary"><?= $this->Html->link('Sign Up',['controller' => 'users', 'action' => 'register']) ?></li>
            <li class="toggle"><span class="bars"></span></li>
        </ul>
    </nav>
    <main class="main" style="height:100vh;">
        <div class="row">
            <div class="smallCol"></div>
            <div class="centerCol">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
            <div class="smallCol"></div>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
