<?php

declare (strict_types = 1);

namespace App\Repository;

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use PDO;
use PDOException;

abstract class Repository
{
    protected $pdo;
    protected static $config;
    protected static $user_id;
    protected $table;

    public static function initConfiguration($config)
    {
        self::$config = $config;
    }

    public function __construct()
    {
        try {
            $this->validateConfig(self::$config);
            $this->createConnection(self::$config);
        } catch (PDOException $e) {
            throw new StorageException('Connection error');
        }
    }

    private function createConnection(array $config): void
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $this->pdo = new PDO($dsn, $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    private function validateConfig(array $config): void
    {
        if (
            empty($config['database']) ||
            empty($config['host']) ||
            empty($config['user']) ||
            !isset($config['password'])
        ) {
            throw new ConfigurationException('Storage configuration error');
        }
    }

    // ===== ===== ===== //

    public function get(array $input, $options)
    {
        $conditions = "";

        foreach ($input as $key => $value) {
            $conditions .= $conditions . " " . $key . "=:" . $key . " AND";
        }

        $conditions .= " 1";

        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE $conditions $options");
        $stmt->execute($input);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAll($value, $column, $options): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE $column=:$column $options");
        $stmt->execute([$column => $value]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
