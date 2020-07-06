<?php

require_once "pdo.php";


/**
 *
 */
class DataBaseManager
{
    private $pdo;

    function __construct()
    {
        $option = [
            'host=' . DB_HOST,
            'dbname' . DB_NAME,
            'port=' . DB_PORT
        ];

        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', '' . DB_USER . '', '' . DB_PASSWORD . '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (\Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }


    }

    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    public function getAll(string $sql, array $params = []): array {
        $statement = $this->internalExec($sql, $params);
        if($statement === null) {
            return [];
        }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(string $sql, array $params = []): ?array {
        $statement = $this->internalExec($sql, $params);
        if($statement === null) {
            return null;
        }
        $line = $statement->fetch(PDO::FETCH_ASSOC);
        if($line === false) {
            return null;
        }
        return $line;
    }

    public function exec(string $sql, array $params = []): int {
        $statement = $this->internalExec($sql, $params);
        if($statement === null) {
            return 0;
        }
        return $statement->rowCount();
    }

    private function internalExec(string $sql, array $params): ?PDOStatement {
        $statement = $this->pdo->prepare($sql);
        if($statement === false) {
            return null;
        }
        $res = $statement->execute($params);
        if($res === false) {
            return null;
        }
        return $statement;
    }

    public function getLastInsertId(): int {
            return $this->pdo->lastInsertId();
    }

    // Prepare statement with query
    public function query($query) {
        $this->stmt = $this->pdo->prepare($query);
    }

    // Bind values
    public function bind($param, $value, $type = null) {
        if (is_null ($type)) {
            switch (true) {
                case is_int ($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool ($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null ($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

?>
