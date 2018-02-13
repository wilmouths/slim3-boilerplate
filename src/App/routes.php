<?php
use App\Controllers\AppController;

use App\Controllers\UserController;
use App\Middlewares\GuestMiddleware;
use App\Middlewares\AuthMiddleware;

$app->get('/', AppController::class . ':index')->setName('index');

$app->group('/user', function() {
    $container = $this->getContainer();

    $this->get('/registration', UserController::class . ':registrationForm')
        ->add(new GuestMiddleware($container))
        ->setName('user.register.form');

    $this->post('/registration', UserController::class . ':registration')
        ->add(new GuestMiddleware($container))
        ->setName('user.register');

    $this->get('/login', UserController::class . ':loginForm')
        ->add(new GuestMiddleware($container))
        ->setName('user.login.form');

    $this->post('/login', UserController::class . ':login')
        ->add(new GuestMiddleware($container))
        ->setName('user.login');

    $this->get('/view', UserController::class . ':view')
        ->add(new AuthMiddleware($container))
        ->setName('user.view');

    $this->get('/logout', UserController::class . ':logout')
        ->add(new AuthMiddleware($container))
        ->setName('user.logout');
});
