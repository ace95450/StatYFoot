<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190213121609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE matchdirect (id INT AUTO_INCREMENT NOT NULL, fixture_id INT NOT NULL, event_timestamp INT NOT NULL, event_date DATETIME NOT NULL, league_id INT NOT NULL, round VARCHAR(255) NOT NULL, home_team_id INT NOT NULL, away_team_id INT NOT NULL, home_team VARCHAR(255) NOT NULL, away_team VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, status_short VARCHAR(255) NOT NULL, goals_home_team INT NOT NULL, goals_away_team INT NOT NULL, halftime_score VARCHAR(255) NOT NULL, final_score VARCHAR(255) NOT NULL, penalty VARCHAR(255) NOT NULL, elapsed VARCHAR(255) NOT NULL, first_half_start INT NOT NULL, second_half_start INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE matchdirect');
    }
}
