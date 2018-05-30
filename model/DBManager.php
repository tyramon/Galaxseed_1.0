<?php
declare(strict_types=1);

namespace dndcompany\galaxseed\model;

<<<<<<< HEAD
use PDO, Exception, PDOStatement;

=======
use PDO, PDOException, PDOStatement, Exception;
>>>>>>> Celine

class DBManager
{
    protected $pdo;
    private static $instance;

    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8', DBUSER, DBPSW, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Singleton pour récuperer l'instance de ma propre classe
     *
     * @return DBManager
     */
    public static function getInstance(): DBManager {
        if(self::$instance == null) {
            self::$instance = new DBManager();
        }

        return self::$instance;
    }


    //Generates a PDOStatement using query or prepare, depending on $params composition
    //$sql is your query
    //$params is an associative array with the form 'placeholderName'=>value. Defaults to empty
    //May return false or throw on error
    public function makeStatement(string $sql, array $params = array()) : PDOStatement {

        if(!$params) {
            $statement = $this->pdo->query($sql);

            if($statement === false) {
                $message = "query n'a pas marché";

                if(DEBUG == 'DEV') {
                    $message .= ' query : '.$sql;
                }

                throw new Exception($message);
            }
        } elseif(($statement = $this->pdo->prepare($sql)) !== false) {
            foreach ($params as $placeholder => $value) {
                if($statement->bindValue($placeholder, $value=='' ? null : $value) === false) {
                    $message = "bindValue n'a pas marché";
                    if(DEBUG == 'DEV') {
                        $message .= ' query : '.$sql.' --- Param : '.implode('->', $params);
                    }

                    throw new Exception($message);
                }
            }

            if(!$statement->execute()) {
                $message = "execute n'a pas marché";

                if(DEBUG == 'DEV') {
                    $message .= ' query : '.$sql.' --- Param : '.implode('->', $params);
                }

                throw new Exception($message);
            }
        }

        return $statement;
    }



    //Specialisation of MakeStatement for SELECT queries
    //$sql is your query
    //$params is an associative array with the form 'placeholderName'=>value. Defaults to empty
    //$fetchStyle is the PDO option passed to fetchAll. Defaults to PDO::FETCH_ASSOC
    //$fetchArg is needed for some values of $fetchStyle
    //Returns an array of all the results. Format of the results depends on $fetchStyle
    //May return false or throw on error
    public function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL)
    {

        $statement = $this->makeStatement($sql, $params);

        $data = isset($fetchArg) ? $statement->fetchAll($fetchStyle, $fetchArg) : $statement->fetchAll($fetchStyle);
        $statement->closeCursor();

        return $data;

    }

    public function getRowCount($sql, $params = array()):int
    {

        $statement = $this->makeStatement($sql, $params);

        $data =  $statement->rowCount();
        $statement->closeCursor();

        return $data;
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }


    /**
     * @param string $sql
     * @param array $params
     */
    public function makeUpdate(string $sql, array $params = array())
    {
        if (!$params) {
            $stm = $this->pdo->query($sql);
            $stm -> execute();

            if ($stm === false) {

                $message = "query n'a pas marché";
                throw new Exception($message);
            }
        } else {
            $stm = $this->pdo->prepare($sql);

            foreach($params as $placeholder => $variable)
            {
                $stm->bindValue($placeholder, $variable);
            }

            $stm->execute();
        }
    }
}