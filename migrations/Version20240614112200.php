<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240614112200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE pricing_plan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pricing_plan_benefit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pricing_plan_feature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pricing_plan (id INT NOT NULL, name VARCHAR(50) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pricing_plan_pricing_plan_feature (pricing_plan_id INT NOT NULL, pricing_plan_feature_id INT NOT NULL, PRIMARY KEY(pricing_plan_id, pricing_plan_feature_id))');
        $this->addSql('CREATE INDEX IDX_D19087D429628C71 ON pricing_plan_pricing_plan_feature (pricing_plan_id)');
        $this->addSql('CREATE INDEX IDX_D19087D46C9002D8 ON pricing_plan_pricing_plan_feature (pricing_plan_feature_id)');
        $this->addSql('CREATE TABLE pricing_plan_benefit (id INT NOT NULL, pricing_plan_id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E6A62C5F29628C71 ON pricing_plan_benefit (pricing_plan_id)');
        $this->addSql('CREATE TABLE pricing_plan_feature (id INT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature ADD CONSTRAINT FK_D19087D429628C71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature ADD CONSTRAINT FK_D19087D46C9002D8 FOREIGN KEY (pricing_plan_feature_id) REFERENCES pricing_plan_feature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pricing_plan_benefit ADD CONSTRAINT FK_E6A62C5F29628C71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql("INSERT INTO pricing_plan VALUES(nextval('pricing_plan_id_seq'), 'Free', 0)");
        $this->addSql("INSERT INTO pricing_plan VALUES(nextval('pricing_plan_id_seq'), 'ALL-STAR', 15)");
        $this->addSql("INSERT INTO pricing_plan VALUES(nextval('pricing_plan_id_seq'), 'GOAT', 29)");

        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 1, 'Teams')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 1, 'Players')");

        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 2, 'Teams')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 2, 'Players')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 2, 'Games')");

        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 3, 'Teams')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 3, 'Players')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 3, 'Games')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 3, 'Stats')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(nextval('pricing_plan_benefit_id_seq'), 3, 'Season Averages')");

        $this->addSql("INSERT INTO pricing_plan_feature VALUES(nextval('pricing_plan_feature_id_seq'), 'Public')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(nextval('pricing_plan_feature_id_seq'), 'Private')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(nextval('pricing_plan_feature_id_seq'), 'Permissions')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(nextval('pricing_plan_feature_id_seq'), 'Sharing')");

        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(1, 1)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(1, 3)");

        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 1)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 2)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 3)");

        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 1)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 2)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 3)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 4)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE pricing_plan_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pricing_plan_benefit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pricing_plan_feature_id_seq CASCADE');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature DROP CONSTRAINT FK_D19087D429628C71');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature DROP CONSTRAINT FK_D19087D46C9002D8');
        $this->addSql('ALTER TABLE pricing_plan_benefit DROP CONSTRAINT FK_E6A62C5F29628C71');
        $this->addSql('DROP TABLE pricing_plan');
        $this->addSql('DROP TABLE pricing_plan_pricing_plan_feature');
        $this->addSql('DROP TABLE pricing_plan_benefit');
        $this->addSql('DROP TABLE pricing_plan_feature');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
