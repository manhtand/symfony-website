<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617131605 extends AbstractMigration
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
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE season_average ALTER pts TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER ast TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER turnover TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER pf TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER fga TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER fgm TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER fta TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER ftm TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER reb TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER stl TYPE FLOAT');
        $this->addSql('ALTER TABLE season_average ALTER blk TYPE FLOAT');
    }
}
