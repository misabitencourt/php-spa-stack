<?php

use Phinx\Migration\AbstractMigration;

class AddPermissionsTimestamps extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('permissions');
        $table->addTimestamps()
            ->update();
    }
}
