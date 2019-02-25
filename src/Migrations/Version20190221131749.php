<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221131749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE all_match_league CHANGE event_date event_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE countries CHANGE name name VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE match_details CHANGE event_date event_date VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE matchdirect CHANGE event_date event_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE all_match_league CHANGE event_date event_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE countries CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE match_details CHANGE event_date event_date VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE matchdirect CHANGE event_date event_date VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
