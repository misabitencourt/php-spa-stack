<?php

use Phinx\Migration\AbstractMigration;

class SalesmanTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('salesmen');
        $table
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('phone', 'string', ['limit' => 60, 'null' => false])
            ->addColumn('hire_date', 'datetime', ['null' => null])
            ->addTimestamps()
            ->create();
    }
}
