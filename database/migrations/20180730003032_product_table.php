<?php

use Phinx\Migration\AbstractMigration;

class ProductTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('products');
        $table
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('description', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('type', 'integer', ['null' => 0])
            ->addColumn('price', 'float', ['null' => 0.0])
            ->addTimestamps()
            ->create();
    }
}
