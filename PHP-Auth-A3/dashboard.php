<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 2/11/14
 * Time: 7:14 PM
 */

require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$session->start();

foreach ($session->getFlashBag()->get('success', array()) as $message) {
    echo "<div class='flash-warning'>$message</div>";
}

echo $session->get('timestamp');