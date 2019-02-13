<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190213153736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matchdirect CHANGE halftime_score halftime_score VARCHAR(255) DEFAULT NULL, CHANGE final_score final_score VARCHAR(255) DEFAULT NULL, CHANGE penalty penalty VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matchdirect CHANGE halftime_score halftime_score VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE final_score final_score VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE penalty penalty VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
