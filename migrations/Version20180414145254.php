<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180414145254 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $machines = $schema->createTable('machines');
        $machines->addColumn('id', Type::INTEGER, [
            'autoincrement' => true
        ]);
        $machines->addColumn('reference', Type::STRING, ['length' => 36]);
        $machines->addColumn('machine_id', Type::INTEGER);

        $machines->setPrimaryKey(['id']);
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('machines');
    }
}
