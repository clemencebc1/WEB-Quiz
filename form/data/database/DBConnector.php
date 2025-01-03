<?php
namespace data\database;
use \PDO;
class DBConnector {
    private $pdo;
    public function __construct() {
        $this->pdo = new PDO('sqlite:db.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec('PRAGMA foreign_keys = ON;');
    }
    
    /**
     * creer les tables dans la base de données
     * @return void
     */
    public function create(){
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS user (
            mail VARCHAR(25) PRIMARY KEY,
            password VARCHAR(100));");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS partie (
            idpartie INTEGER PRIMARY KEY,
            score INTEGER);");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS jouer (
            idpartie INTEGER,
            mail VARCHAR(25),
            PRIMARY KEY(idpartie, mail),
            FOREIGN KEY (idpartie) REFERENCES partie(idpartie),
            FOREIGN KEY (mail) REFERENCES user(mail);");
    }

    /**
     * drop l'ensemble de tables dans la base de données
     * @return void
     */
    public function drop(){
        $this->pdo->exec("DROP TABLE IF EXISTS jouer, 
        DROP TABLE IF EXISTS partie,
        DROP TABLE IF EXISTS user");
    }

    /**
     * get_user, verifie un utilisateur dans la base de données 
     * en fonction de l'identifiant et du mot de passe
     *
     * @param  string $mail
     * @param  string $password
     * @return bool true si l'utilisateur a saisi le bon mot de passe
     */
    public function get_user(string $mail, string $password):bool{
        $sql = "SELECT * FROM USER WHERE MAIL = ? AND PASSWORD = SHA1(?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$mail, $password]);
        $user = $stmt->fetch();
        if ($user == NULL){
            return false;
        }
        return true;
    }

    /**
     * ajout d'un utilisateur dans la base de données
     * @param string $mail
     * @param string $password
     * @return bool
     */
    public function new_user(string $mail, string $password):bool{
        $sql = "'SELECT * FROM USER WHERE MAIL=". $mail . "'";
        if (!($sql==null)){
            return false;
        }
        $insert = "'INSERT INTO USER VALUES (" . $mail . ",SHA1(" .$password .")'";
        $stmt = $this->pdo->query($insert);
        return true;
    }

}