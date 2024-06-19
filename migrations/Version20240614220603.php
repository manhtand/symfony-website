<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240614220603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE season_average_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE season_average (id INT NOT NULL, pts INT NOT NULL, ast INT NOT NULL, turnover INT NOT NULL, pf INT NOT NULL, fga INT NOT NULL, fgm INT NOT NULL, fta INT NOT NULL, ftm INT NOT NULL, reb INT NOT NULL, stl INT NOT NULL, blk INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, name VARCHAR(50) NOT NULL, full_name VARCHAR(50) NOT NULL, abbreviation VARCHAR(10) NOT NULL, city VARCHAR(50) NOT NULL, division VARCHAR(50) DEFAULT NULL, conference VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE season_average_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP TABLE season_average');
        $this->addSql('DROP TABLE team');
    }
}
