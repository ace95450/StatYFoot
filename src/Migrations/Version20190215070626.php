<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215070626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fixtures_date (id INT AUTO_INCREMENT NOT NULL, fixture_id INT NOT NULL, event_date DATETIME NOT NULL, league_id INT NOT NULL, round VARCHAR(80) NOT NULL, home_team_id INT NOT NULL, away_team_id INT NOT NULL, home_team VARCHAR(80) NOT NULL, away_team VARCHAR(80) NOT NULL, status VARCHAR(80) NOT NULL, status_short VARCHAR(50) NOT NULL, goals_home_team INT NOT NULL, goals_away_team INT NOT NULL, halftime_score VARCHAR(50) DEFAULT NULL, final_score VARCHAR(50) DEFAULT NULL, penalty VARCHAR(50) DEFAULT NULL, elapsed INT NOT NULL, first_half_start INT NOT NULL, second_half_start INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_details CHANGE event_date event_date VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE fixtures_date');
        $this->addSql('ALTER TABLE match_details CHANGE event_date event_date DATETIME NOT NULL');
    }
}
