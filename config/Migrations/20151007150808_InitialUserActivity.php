<?php

use Migrations\AbstractMigration;

class InitialUserActivity
    extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('logs');
        $table
            ->addColumn('table_name', 'string', [
                'default' => null,
                'limit'   => 50,
                'null'    => false,
            ])
            ->addColumn('database_name', 'string', [
                'default' => null,
                'limit'   => 100,
                'null'    => false,
            ])
            ->addColumn('action', 'string', [
                'default' => null,
                'limit'   => 1,
                'null'    => false,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit'   => null,
                'null'    => true,
            ])
            ->addColumn('operation_type', 'string', [
                'default' => null,
                'limit'   => 8,
                'null'    => true,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit'   => 500,
                'null'    => false,
            ])
            ->addColumn('recycle', 'boolean', [
                'default' => null,
                'limit'   => null,
                'null'    => true,
            ])
            ->addColumn('primary_key', 'string', [
                'default' => null,
                'limit'   => 100,
                'null'    => false,
            ])
            ->create();

        $table = $this->table('logs_details', ['id' => false, 'primary_key' => ['id', 'log_id']]);
        $table
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default'       => null,
                'limit'         => 10,
                'null'          => false,
            ])
            ->addColumn('log_id', 'integer', [
                'default' => null,
                'limit'   => 11,
                'null'    => false,
            ])
            ->addColumn('object_file', 'string', [
                'default' => null,
                'limit'   => 64,
                'null'    => true,
            ])
            ->addColumn('field_name', 'string', [
                'default' => null,
                'limit'   => 64,
                'null'    => true,
            ])
            ->addColumn('new_value', 'text', [
                'default' => null,
                'null'    => true,
            ])
            ->addColumn('old_value', 'text', [
                'default' => null,
                'null'    => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit'   => null,
                'null'    => true,
            ])
            ->addIndex(
                [
                    'log_id',
                ]
            )
            ->create();
    }

    public function down()
    {
        $this->table('logs_details')
             ->dropForeignKey(
                 'log_id'
             );

        $this->dropTable('logs');
        $this->dropTable('logs_details');
    }
}
