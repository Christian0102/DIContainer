<?php

require_once 'Container.php';
require_once 'User.php';
require_once 'Position.php';
require_once 'Developer.php';


$container = new Container();
$developer = new Developer('PHP', 3);
$user = new User('Tincia', 'Cristian', 28, $developer);

$container->set('User', $user);
echo "<pre>";
print_r($container->get('User', ['Cristina', 'Tinica', 22, $developer]));
echo "<pre>";
print_r($container);
