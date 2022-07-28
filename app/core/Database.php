<?php

class Database
{
    private $host_em = DB_HOST_EM;
    private $dbem = DBEM;
    private $host_app = DB_HOST_APP;
    private $dbapp = DBAPP;

    private $conn_em;
    private $stmt_em;

    private $conn_app;
    private $stmt_app;

    public function __construct()
    {
        $datasource_em = 'mysql:host=' . $this->host_em . '; dbname=' . $this->dbem;
        $datasource_app = 'mysql:host=' . $this->host_app . '; dbname=' . $this->dbapp;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->conn_em = new PDO($datasource_em, DB_USER_EM, DB_PASS_EM, $options);
            $this->conn_app = new PDO($datasource_app, DB_USER_APP, DB_PASS_APP, $options);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function query_em($query)
    {
        $this->stmt_em = $this->conn_em->prepare($query);
    }

    public function query_app($query)
    {
        $this->stmt_app = $this->conn_app->prepare($query);
    }

    public function bind_data_em($key, $value, $type = null)
    {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->stmt_em->bindValue($key, $value, $type);
    }

    public function bind_data_app($key, $value, $type = null)
    {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->stmt_app->bindValue($key, $value, $type);
    }

    public function fetch_all_em()
    {
        $this->stmt_em->execute();
        return $this->stmt_em->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch_all_app()
    {
        $this->stmt_app->execute();
        return $this->stmt_app->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single_em()
    {
        $this->stmt_em->execute();
        return $this->stmt_em->fetch(PDO::FETCH_ASSOC);
    }

    public function single_app()
    {
        $this->stmt_app->execute();
        return $this->stmt_app->fetch(PDO::FETCH_ASSOC);
    }

    public function affected_em()
    {
        $this->stmt_em->execute();
        return $this->stmt_em->rowCount();
    }

    public function affected_app()
    {
        $this->stmt_app->execute();
        return $this->stmt_app->rowCount();
    }
}
