<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

/**
 * CreateUsers migration
 */
class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        
        $table->addColumn('name', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        
        $table->addColumn('email', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        
        $table->addIndex(['email'], [
            'unique' => true,
            'name' => 'idx_users_email',
        ]);
        
        $table->create();
    }
}
