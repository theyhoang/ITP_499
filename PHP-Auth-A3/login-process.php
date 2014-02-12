<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 2/6/14
 * Time: 11:32 PM
 */

require_once 'db.php';

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Carbon\Carbon;



$request = Request::createFromGlobals();

$username = $request->get('username');
$password = $request->get('password');


$session = new Session();
$session->start();



$sql = "SELECT * FROM users WHERE username = '$username' AND password = SHA1('$password')";

$statement = $pdo->prepare($sql);
$response = $statement->execute();

if ($response === true) :
    if ($statement->rowCount()==1) : {
        echo "<p>Found username and password</p>";
        $session->set('username',$username);

        // put results in an array so we can fetch columns
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $session->set('email',$result['email']);
        $session->set('timestamp',Carbon::now());

        $response = new RedirectResponse('dashboard.php');
        $session->getFlashBag()->add(
            'success',
            'You have successfully logged in!'
        );
        $response->send();
    }
    else :{
        echo "<p>Username/password not found";
        $response = new RedirectResponse('login.php');
        // add flash messages
        $session->getFlashBag()->add(
            'error',
            'Incorrect credentials.'
        );
        $response->send();
    }
    endif;
else :
    echo "<p>SQL statement not executed correctly</p>";
endif;


