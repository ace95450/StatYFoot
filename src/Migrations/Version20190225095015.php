<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225095015 extends AbstractMigration
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
        $this->addSql('ALTER TABLE countries CHANGE name name VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE joueurs ADD number VARCHAR(255) NOT NULL, ADD player VARCHAR(255) NOT NULL, DROP nom, DROP prenom');
        $this->addSql('ALTER TABLE membre CHANGE avatar avatar VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE all_match_league');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('ALTER TABLE countries CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE joueurs ADD nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD prenom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP number, DROP player');
        $this->addSql('ALTER TABLE membre CHANGE avatar avatar VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
