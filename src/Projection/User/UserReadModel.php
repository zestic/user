<?php
declare(strict_types=1);

namespace Zestic\User\Projection\User;

use Exception;
use PDO;
use Prooph\EventStore\Projection\AbstractReadModel;

final class UserReadModel extends AbstractReadModel
{
    /** @var PDO */
    private $connection;
    /** @var string */
    private $tableName;

    public function __construct(PDO $pdo, string $tableName)
    {
        $this->connection = $pdo;
        $this->tableName = $tableName;
    }

    public function init(): void
    {
        $sql = <<<EOT
CREATE TABLE `$this->tableName` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `identity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `personId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)jkl7
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
EOT;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    public function isInitialized(): bool
    {
        $sql = "SHOW TABLES LIKE '$this->tableName';";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch();
        if (false === $result) {
            return false;
        }

        return true;
    }

    public function reset(): void
    {
        $sql = "TRUNCATE TABLE `$this->tableName`;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    public function delete(): void
    {
        $sql = "DROP TABLE `$this->tableName`;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    protected function insert(array $data): void
    {
        try {
            $sql = <<<SQL
INSERT INTO `$this->tableName` 
(`id`,`identity`,`password`,) VALUES (?, ?, ?);
SQL;
            $statement = $this->connection->prepare($sql);
            $statement->execute($data);
        } catch (Exception $e) {
            // its expected to happen twice. it gets hit in the graphql processing,
            // then again in the normal read model processing
        }
    }
}
