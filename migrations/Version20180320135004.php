<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320135004 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $tokens = $schema->createTable('tokens');
        $tokens->addColumn('reference', Type::STRING, ['length' => 36]);
        $tokens->addColumn('token', Type::STRING, ['length' => 64]);

        $tokens->addForeignKeyConstraint('accounts', ['reference'], ['id']);
        $tokens->setPrimaryKey(['token']);
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('tokens');
    }
}
