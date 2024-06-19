<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617104237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season_average ADD player_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE season_average ADD CONSTRAINT FK_863A8627C036E511 FOREIGN KEY (player_id_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_863A8627C036E511 ON season_average (player_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE season_average DROP CONSTRAINT FK_863A8627C036E511');
        $this->addSql('DROP INDEX UNIQ_863A8627C036E511');
        $this->addSql('ALTER TABLE season_average DROP player_id_id');
    }
}
