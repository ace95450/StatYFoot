<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190224140802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, membre_id INT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, feature_image VARCHAR(255) NOT NULL, spotlight TINYINT(1) NOT NULL, special TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_F65593E5BCF5E72D (categorie_id), INDEX IDX_F65593E56A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, membre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E56A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE match_details CHANGE event_date event_date VARCHAR(255) NOT NULL, CHANGE goals_home_team goals_home_team INT DEFAULT NULL, CHANGE goals_away_team goals_away_team INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matchdirect CHANGE goals_home_team goals_home_team INT DEFAULT NULL, CHANGE goals_away_team goals_away_team INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD bio TEXT NOT NULL, ADD avatar VARCHAR(255) NOT NULL, ADD profile_file VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5BCF5E72D');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('ALTER TABLE match_details CHANGE event_date event_date DATETIME NOT NULL, CHANGE goals_home_team goals_home_team INT NOT NULL, CHANGE goals_away_team goals_away_team INT NOT NULL');
        $this->addSql('ALTER TABLE matchdirect CHANGE goals_home_team goals_home_team INT NOT NULL, CHANGE goals_away_team goals_away_team INT NOT NULL');
        $this->addSql('ALTER TABLE membre DROP bio, DROP avatar, DROP profile_file');
    }
}
