<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 2/6/14
 * Time: 11:32 PM
 */
require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$session->start();

foreach ($session->getFlashBag()->get('error', array()) as $message) {
    echo "<div class='flash-warning'>$message</div>";
}
?>

<form method="post" action="login-process.php">
    <div>
        Username: <input type="text" name="username" />
    </div>
    <div>
        Password: <input type="password" name="password" />
    </div>
    <div>
        <input type="submit" value="Submit" />
    </div>
</form>