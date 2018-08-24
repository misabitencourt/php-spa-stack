<?php

use Dotenv\Dotenv as Dotenv;
use Phinx\Migration\AbstractMigration;

class PermissionsTables extends AbstractMigration
{
    public function up()
    {
        $dotenv = new Dotenv(__DIR__.'/../../');
        $dotenv->load();

        $prefix = getenv('ENV') === 'test' ? 'test_' : '';

        $table = $this->table('permissions');
        $table
            ->addColumn('role_id', 'integer', ['null' => false])
            ->addColumn('resource_id', 'integer', ['null' => false])
            ->addColumn('create', 'boolean')
            ->addColumn('update', 'boolean')
            ->addColumn('read', 'boolean')
            ->addColumn('delete', 'boolean')
            ->addForeignKey(
                'role_id',
                $prefix.'roles',
                'id',
                [
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->addForeignKey('resource_id', $prefix.'resources', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();
    }

    public function down()
    {
        $table = $this->table('permissions');
        $table->dropForeignKey('role_id');
        $table->dropForeignKey('resource_id');
        $this->dropTable('permissions');
    }
}
