<?php

use Infrastructure\Authentication\Repository\DatabaseUsers;

require_once __DIR__ . '/../vendor/autoload.php';

//$users = new \Infrastructure\Authentication\Repository\FilesystemUsers(__DIR__ . '/../data/users');
$entityManager = require_once __DIR__.'/../bootstrap.php';

$users = new DatabaseUsers($entityManager);

$user = $users->get($_POST['emailAddress']);

$user->login($_POST['password'], function (string $password, string $hash) : bool { return password_verify($password, $hash); });

var_dump($user);