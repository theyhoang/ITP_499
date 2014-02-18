<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 2/11/14
 * Time: 4:29 PM
 */



namespace ITP;


class Auth {
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function attempt($username,$password) {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = SHA1('$password')";
        $statement = $this->pdo->prepare($sql);
        $response = $statement->execute();

        if($response == true) {
            if($statement->rowCount()==1){
                return $statement;
            }
            else {
                return false;
            }
        }
        else{
            echo "<p>SQL statement not executed correctly</p>";
        }
    }

};