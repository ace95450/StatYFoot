<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225193422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE all_match_league (id INT AUTO_INCREMENT NOT NULL, fixture_id INT NOT NULL, event_date DATETIME NOT NULL, league_id INT NOT NULL, round VARCHAR(255) NOT NULL, home_team_id INT NOT NULL, away_team_id INT NOT NULL, home_team VARCHAR(255) NOT NULL, away_team VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, status_short VARCHAR(255) DEFAULT NULL, goals_home_team INT NOT NULL, goals_away_team INT NOT NULL, halftime_score VARCHAR(255) DEFAULT NULL, final_score VARCHAR(255) DEFAULT NULL, penalty VARCHAR(255) DEFAULT NULL, elapsed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, membre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce CHANGE titre titre VARCHAR(255) DEFAULT NULL, CHANGE contenu contenu LONGTEXT DEFAULT NULL, CHANGE feature_image feature_image VARCHAR(255) DEFAULT NULL, CHANGE spotlight spotlight TINYINT(1) DEFAULT NULL, CHANGE special special TINYINT(1) DEFAULT NULL, CHANGE date_creation date_creation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E56A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE joueurs CHANGE number number VARCHAR(255) NOT NULL, CHANGE player player VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE matchdirect CHANGE goals_home_team goals_home_team INT DEFAULT NULL, CHANGE goals_away_team goals_away_team INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre CHANGE avatar avatar VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE all_match_league');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5BCF5E72D');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E56A99F74A');
        $this->addSql('ALTER TABLE annonce CHANGE titre titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE contenu contenu LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE feature_image feature_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE spotlight spotlight TINYINT(1) NOT NULL, CHANGE special special TINYINT(1) NOT NULL, CHANGE date_creation date_creation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE joueurs CHANGE number number VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE player player VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE matchdirect CHANGE goals_home_team goals_home_team INT NOT NULL, CHANGE goals_away_team goals_away_team INT NOT NULL');
        $this->addSql('ALTER TABLE membre CHANGE avatar avatar VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
