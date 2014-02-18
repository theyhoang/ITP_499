<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 2/6/14
 * Time: 11:32 PM
 */

require __DIR__ . '/vendor/autoload.php';
require_once 'db.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Carbon\Carbon;
use ITP\Auth;



$request = Request::createFromGlobals();

$username = $request->get('username');
$password = $request->get('password');


$session = new Session();
$session->start();

$auth = new Auth($pdo);

$response = $auth->attempt($username,$password);

if ($response) {
        echo "<p>Found username and password</p>";
        $session->set('username',$username);

        // put results in an array so we can fetch columns
        $result = $response->fetch(PDO::FETCH_ASSOC);
        $session->set('email',$result['email']);
        $session->set('timestamp',Carbon::now());

        $response = new RedirectResponse('dashboard.php');
        $session->getFlashBag()->add(
            'success',
            'You have successfully logged in!'
        );
        $response->send();
}
else{
    echo "<p>Username/password not found";
    $response = new RedirectResponse('login.php');
    // add flash messages
    $session->getFlashBag()->add(
        'error',
        'Incorrect credentials.'
    );
    $response->send();

}


