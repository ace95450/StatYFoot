<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225162900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce CHANGE titre titre VARCHAR(255) DEFAULT NULL, CHANGE contenu contenu LONGTEXT DEFAULT NULL, CHANGE feature_image feature_image VARCHAR(255) DEFAULT NULL, CHANGE spotlight spotlight TINYINT(1) DEFAULT NULL, CHANGE special special TINYINT(1) DEFAULT NULL, CHANGE date_creation date_creation DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce CHANGE titre titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE contenu contenu LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE feature_image feature_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE spotlight spotlight TINYINT(1) NOT NULL, CHANGE special special TINYINT(1) NOT NULL, CHANGE date_creation date_creation DATETIME NOT NULL');
    }
}
