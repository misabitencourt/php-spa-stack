<?php

use Phinx\Migration\AbstractMigration;

class RolesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('roles');
        $table->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addTimestamps()
            ->create();
    }
}
