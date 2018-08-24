<?php

use Phinx\Migration\AbstractMigration;

class AddResourceDescription extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('resources');
        $table->addColumn('description', 'string', ['limit' => 255, 'null' => false])
            ->update();
    }
}
