<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 1/28/14
 * Time: 3:11 PM
 */

$host = 'itp460.usc.edu';
$dbname = 'music';
$user = 'student';
$pass = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

?>