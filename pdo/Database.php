<?php

namespace Zeroyukiy\Prova;

use PDO;
use PDOException;

class Database
{
    private string $dsn;

    public PDO $pdo;

    private string $host = 'localhost';
    private string $db = 'test';
    private string $user = 'root';
    private string $password = '';

    public function __construct(array $dsn)
    {
        foreach ($dsn as $key => $d) {
            if (!empty($d)) {
                $this->$key = $d;
            }
        }
    }

    public function init(): void
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=UTF8";
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to the $this->db database successfully!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function getDsn(): string
    {
        return $this->dsn;
    }
}