<?php


namespace app\builder;


use Aigletter\Interfaces\Builder\DbInterface;
use Aigletter\Interfaces\Builder\QueryInterface;
use PDO;


class Db implements DbInterface
{
    private PDO $pdo;

    public function getConnect(string $host, string $dbName, string $user, string $pass, string $charset)
    {
        $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param QueryInterface $query
     * @return object
     */
    public function one(QueryInterface $query): object
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return new QueryResult($data);
    }

    /**
     * @param QueryInterface $query
     * @return object[]
     */
    public function all(QueryInterface $query): array
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}