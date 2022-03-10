<?php

namespace App\Model;

use PDO;
use App\database\Database;

//CLASSE POUR CHERCHER LES DONNEES DES STATUS EN BASE DE DONNEES ET POUVOIR LES MODIFIER
class StatusModel
{
    protected $id;
    protected $Auteur_Status;
    protected $Titre_Status;
    protected $Content_Status;
    protected $Date_Status;

    protected $pdo;

    const TABLE_NAME = 'Status_Table';


    //CONSTRUCTEUR
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    //FONCTION QUI RECUPERE LES STATUS EN BASE DE DONNEES
    public function findAll()
    {
        $sql = 'SELECT
                `id`
                ,`Auteur_Status`
                ,`Titre_Status`
                ,`Content_Status`
                ,`Date_Status`
                FROM ' . self::TABLE_NAME . '
                ORDER BY `id` ASC;
        ';

        $pdoStatement = $this->pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $results;
    }

    //FONCTION QUI PERMET DE RECUPERER UN STATUS AVEC SON ID
    public function findById($id)
    {
        $sql = 'SELECT
                `id`
                ,`Auteur_Status`
                ,`Titre_Status`
                ,`Content_Status`
                ,`Date_Status`
                FROM ' . self::TABLE_NAME . '
                WHERE `id` = :id
                ORDER BY `id` ASC;
        ';

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $results = $pdoStatement->execute();
        $results = $pdoStatement->fetchObject(self::class);
        return $results;
    }

    //FONCTION QUI PERMET D INSERER DES DONNEES DEPUIS LE FORMULAIRE EN BASE DE DONNEES
    public function create($Auteur_Status, $Titre_Status, $Content_Status)
    {
        $sql = 'INSERT INTO ' . self::TABLE_NAME . '
                (`Auteur_Status`,`Titre_Status`,`Content_Status`,`Date_Status`)
                VALUES
                (:Auteur_Status,:Titre_Status,:Content_Status,NOW())
        ';

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':Auteur_Status', $Auteur_Status, PDO::PARAM_STR);
        $pdoStatement->bindValue(':Titre_Status', $Titre_Status, PDO::PARAM_STR);
        $pdoStatement->bindValue(':Content_Status', $Content_Status, PDO::PARAM_STR);

        $results = $pdoStatement->execute();

        if (!$results) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }

    public function triTitre($Titre_Status)
    {
        $sql = 'SELECT
                `id`
                ,`Auteur_Status`
                ,`Titre_Status`
                ,`Content_Status`
                ,`Date_Status`
                FROM ' . self::TABLE_NAME . '
                WHERE `Titre_Status`=:Titre_Status;
        ';

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':Titre_Status', $Titre_Status, PDO::PARAM_STR);
        $results = $pdoStatement->execute();
        $results = $pdoStatement->fetchObject(self::class);
        return $results;
    }

    //GETTER ID 
    public function getId()
    {
        return $this->id;
    }

    //SETTER ID 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    //GETTER DE L AUTEUR DU STATUS 
    public function getAuteur_Status()
    {
        return $this->Auteur_Status;
    }

    //SETTER DE L AUTEUR DU STATUS
    public function setAuteur_Status(String $Auteur_Status)
    {
        $this->Auteur_Status = $Auteur_Status;
        return $this;
    }

    //GETTER DU TITRE DU STATUS 
    public function getTitre_Status()
    {
        return $this->Titre_Status;
    }

    //SETTER DE L AUTEUR DU STATUS
    public function setTitre_Status(String $Titre_Status)
    {
        $this->Titre_Status = $Titre_Status;
        return $this;
    }

    //GETTER DU CONTENU DU STATUS 
    public function getContent_Status()
    {
        return $this->Content_Status;
    }

    //SETTER DU CONTENU DU STATUS
    public function setContent_Status(String $Content_Status)
    {
        $this->Content_Status = $Content_Status;
        return $this;
    }

    //GETTER DE LA DATE DU STATUS 
    public function getDate_Status()
    {
        return $this->Date_Status;
    }
}
