<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        // create the table
        $table = $this->table('users');
        $table
            ->addColumn('created_at', 'datetime')
            ->addColumn('email', 'string')
            ->addColumn('identity', 'string')
            ->addColumn('password', 'string')
            ->addColumn('password_reset_token', 'string', ['null' => true])
            ->addColumn('password_reset_token_created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime')
            ->addIndex(['email', 'identity'], ['type' => 'fulltext', 'unique' => true])
            ->create();
    }

    /**
     * Migrate Up.
     */
    public function up()
    {

    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}