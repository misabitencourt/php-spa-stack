<?php

use Phinx\Migration\AbstractMigration;

class SaleItemsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('sale_items');
        $table->addColumn('qt', 'integer', ['null' => 1])
              ->addColumn('sale_id', 'integer', ['null' => false])
              ->addColumn('product_id', 'integer', ['null' => false])
            ->addForeignKey(
                'sale_id',
                'sales',
                'id',
                [
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->addForeignKey(
                'product_id',
                'products',
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
