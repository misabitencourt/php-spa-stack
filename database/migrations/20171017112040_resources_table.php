<?php

use Phinx\Migration\AbstractMigration;

class ResourcesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('resources');
        $table->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addTimestamps()
            ->create();
    }
}
