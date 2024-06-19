<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240616144041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP CONSTRAINT fk_98197a65296cd8ae');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT fk_98197a65f09673ac');
        $this->addSql('DROP INDEX uniq_98197a65f09673ac');
        $this->addSql('DROP INDEX uniq_98197a65296cd8ae');
        $this->addSql('ALTER TABLE player ADD team_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE player ADD season_average_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player DROP team_id');
        $this->addSql('ALTER TABLE player DROP season_average_id');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65AB5D7D80 FOREIGN KEY (season_average_id_id) REFERENCES season_average (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A65B842D717 ON player (team_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A65AB5D7D80 ON player (season_average_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65B842D717');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65AB5D7D80');
        $this->addSql('DROP INDEX UNIQ_98197A65B842D717');
        $this->addSql('DROP INDEX UNIQ_98197A65AB5D7D80');
        $this->addSql('ALTER TABLE player ADD season_average_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player DROP team_id_id');
        $this->addSql('ALTER TABLE player RENAME COLUMN season_average_id_id TO team_id');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT fk_98197a65296cd8ae FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT fk_98197a65f09673ac FOREIGN KEY (season_average_id) REFERENCES season_average (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_98197a65f09673ac ON player (season_average_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_98197a65296cd8ae ON player (team_id)');
    }
}
