<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424213245 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $accounts = $schema->getTable('accounts');
        $accounts->addColumn('portal_account_id', Type::INTEGER, ['default' => null]);
    }

    public function down(Schema $schema)
    {
        $accounts = $schema->getTable('accounts');
        $accounts->dropColumn('portal_account_id');
    }
}
