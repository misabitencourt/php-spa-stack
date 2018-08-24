<?php

use Phinx\Migration\AbstractMigration;

class CustomersTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('customers');
        $table
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addTimestamps()
            ->create();
    }
}
