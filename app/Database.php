<?php

namespace App;

use PDO;

/**
 * @author Robson Lucas
 * Classe responsavel pela conexao com o banco de dados
 * @package App\Model\Entiny
 */
abstract class Database
{
    /**
     * Retorna a instancia de PDO
     * @return PDO 
     */
    public static function get()
    {
        try {
            $pdo = new \PDO('mysql:host=localhost;dbname=argos', "root", "", [
                PDO::MYSQL_ATTR_INIT_COMMAND  => "SET NAMES 'utf8mb4'",
                PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
