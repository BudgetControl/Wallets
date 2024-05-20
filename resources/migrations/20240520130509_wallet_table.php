<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class WalletTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('wallets')
            ->addColumn('id', 'integer', ['identity' => true])
            ->addColumn('uuid', 'string', ['limit' => 36])
            ->addColumn('date_time', 'datetime')
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('color', 'string', ['limit' => 7])
            ->addColumn('date', 'date')
            ->addColumn('type', 'string', ['limit' => 255])
            ->addColumn('installement', 'integer', ['default' => 0])
            ->addColumn('installement_value', 'decimal', ['precision' => 10, 'scale' => 2, 'null' => true])
            ->addColumn('installement_from_Wallet', 'integer', ['null' => true])
            ->addColumn('currency', 'string', ['limit' => 3])
            ->addColumn('balance', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('exclude_from_stats', 'boolean', ['default' => false])
            ->addColumn('sorting', 'integer')
            ->addColumn('workspace_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->create();
    }
}
