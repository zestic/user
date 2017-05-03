<?php

declare(strict_types=1);

namespace Zestic\User\Projection;

use PDO;
use Prooph\EventStore\Projection\AbstractReadModel;

final class UserReadModel extends AbstractReadModel
{
    const TABLE_NAME = 'users';

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function init(): void
    {
        $tableName = self::TABLE_NAME;

        $sql = <<<SQL
CREATE TABLE `$tableName` (
  `id` binary(16) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` json,
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_username_canonical` (`username_canonical`),
  UNIQUE KEY `UNIQ_email_canonical` (`email_canonical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SQL;

        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    public function isInitialized(): bool
    {
        $tableName = self::TABLE_NAME;

        $sql = "SHOW TABLES LIKE '$tableName';";

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
        $tableName = self::TABLE_NAME;

        $sql = "TRUNCATE TABLE '$tableName';";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    public function delete(): void
    {
        $tableName = self::TABLE_NAME;

        $sql = "DROP TABLE $tableName;";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    protected function insert(array $data): void
    {
        $columnList = [];
        $paramPlaceholders = [];
        $paramValues = [];

        foreach ($data as $columnName => $value) {
            $columnList[] = $columnName;
            $paramPlaceholders[] = '?';
            $paramValues[] = $value;
        }

        $query = 'INSERT INTO ' . self::TABLE_NAME . ' (' . implode(', ', $columnList) . ')' .
            ' VALUES (' . implode(', ', $paramPlaceholders) . ')';

        $statement = $this->connection->prepare($query);
        $statement->execute($paramValues);
    }
}
