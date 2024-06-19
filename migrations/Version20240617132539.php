<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617132539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season_average ALTER pts TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER ast TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER turnover TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER pf TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER fga TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER fgm TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER fta TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER ftm TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER reb TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER stl TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE season_average ALTER blk TYPE DOUBLE PRECISION');

        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65AB5D7D80 FOREIGN KEY (season_average_id_id) REFERENCES season_average (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE season_average ALTER pts TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER ast TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER turnover TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER pf TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER fga TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER fgm TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER fta TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER ftm TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER reb TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER stl TYPE INT');
        $this->addSql('ALTER TABLE season_average ALTER blk TYPE INT');
    }
}
