<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 2/11/14
 * Time: 7:14 PM
 */

require __DIR__ . '/vendor/autoload.php';
require_once 'db.php';

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ITP\Songs\SongQuery;

$session = new Session();
$session->start();

// check if user has been set
if(!$session->has('email')){
    $response = new RedirectResponse('login.php');
    $response->send();
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="bootstrap-3.0.3-dist/dist/css/bootstrap.min.css" />
    <title>Dashboard</title>
    <?php
        foreach ($session->getFlashBag()->get('success', array()) as $message) {
            echo "<div class='flash-warning'>$message</div>";
        }
    ?>

</head>
<body>
<h4 style="float:right">
    <?php echo $session->get('username'); ?>
    <br>
    <?php echo $session->get('email'); ?>
    <br>
    Logged in: <?php echo $session->get('timestamp')->diffForHumans();?>
    <br>
    <a href='logout.php'>LOGOUT<a/>
</h4>


<?php
    $songQuery = new SongQuery($pdo);

    $songs = $songQuery->withArtist()->withGenre()->orderBy('title')->all();

    echo "<table class='table'> <th>Title</th><th>Artist</th><th>Genre</th>";
    foreach ($songs as $song) :
        echo "<tr><td>$song->title</td><td>$song->artist</td><td>$song->genre</td></tr>";
    endforeach;
    echo "</table>";
?>

</body>
</html>




