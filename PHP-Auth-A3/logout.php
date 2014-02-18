<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 2/11/14
 * Time: 7:14 PM
 */

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

$session = new Session();
$session->start();

$session->clear();

$response = new RedirectResponse('login.php');

$response->send();