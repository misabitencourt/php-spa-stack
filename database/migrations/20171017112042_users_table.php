<?php

use Dotenv\Dotenv as Dotenv;
use Phinx\Migration\AbstractMigration;

class UsersTable extends AbstractMigration
{
    public function up()
    {
        $dotenv = new Dotenv(__DIR__.'/../../');
        $dotenv->load();

        $prefix = getenv('ENV') === 'test' ? 'test_' : '';

        $table = $this->table('users');
        $table
            ->addColumn('email', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('password', 'string', ['limit' => 60, 'null' => false])
            ->addColumn('role_id', 'integer', ['null' => false])
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addTimestamps()
            ->addForeignKey('role_id', $prefix.'roles', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();
    }

    public function down()
    {
        $table = $this->table('users');
        $table->dropForeignKey('role_id');
        $this->dropTable('users');
    }
}
