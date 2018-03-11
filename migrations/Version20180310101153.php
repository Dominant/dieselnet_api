<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

class Version20180310101153 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $accounts = $schema->createTable('accounts');
        $accounts->addColumn('id', Type::STRING, ['length' => 36]);
        $accounts->addColumn('is_verified', Type::SMALLINT, ['default' => 0]);
        $accounts->addColumn('phone', Type::STRING);
        $accounts->addColumn('device_id', Type::STRING);
        $accounts->addColumn('verification_code', Type::INTEGER, ['length' => 4]);

        $accounts->setPrimaryKey(['id']);
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('accounts');
    }
}
