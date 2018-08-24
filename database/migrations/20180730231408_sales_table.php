<?php

use Phinx\Migration\AbstractMigration;

class SalesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('sales');
        $table
            ->addColumn('obs', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('customer_id', 'integer', ['null' => false])
            ->addColumn('salesman_id', 'integer', ['null' => false])
            ->addForeignKey(
                'customer_id',
                'customers',
                'id',
                [
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->addForeignKey(
                'salesman_id',
                'salesmen',
                'id',
                [
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->addTimestamps()
            ->create();
    }
}
