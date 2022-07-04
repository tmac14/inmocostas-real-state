<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704202138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE attachments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE configuration_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "features_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "properties_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE property_class_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE property_feature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE temporary_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "users_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE attachment_property_photo (id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CF3E6D10549213EC ON attachment_property_photo (property_id)');
        $this->addSql('CREATE TABLE attachments (id INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, original_name VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size INT NOT NULL, dimensions TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN attachments.dimensions IS \'(DC2Type:simple_array)\'');
        $this->addSql('CREATE TABLE configuration (id INT NOT NULL, name VARCHAR(255) NOT NULL, value TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "features" (id INT NOT NULL, name VARCHAR(255) NOT NULL, value_type VARCHAR(12) NOT NULL, value_format TEXT DEFAULT NULL, icon VARCHAR(45) DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "properties" (id INT NOT NULL, property_class_id INT NOT NULL, title VARCHAR(45) NOT NULL, description TEXT NOT NULL, surface_util NUMERIC(5, 2) DEFAULT NULL, surface_built NUMERIC(5, 2) DEFAULT NULL, surface_simple_note NUMERIC(5, 2) DEFAULT NULL, rooms SMALLINT NOT NULL, bathrooms SMALLINT NOT NULL, latitude NUMERIC(10, 7) DEFAULT NULL, longitude NUMERIC(10, 7) DEFAULT NULL, price INT NOT NULL, internal_ref VARCHAR(15) NOT NULL, external_ref VARCHAR(30) DEFAULT NULL, year_built SMALLINT DEFAULT NULL, internal_agency_status SMALLINT DEFAULT NULL, external_agency_status SMALLINT DEFAULT NULL, transaction_type SMALLINT DEFAULT NULL, conservation_status SMALLINT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_87C331C7B4873F54 ON "properties" (property_class_id)');
        $this->addSql('CREATE TABLE property_class (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2B58D892727ACA70 ON property_class (parent_id)');
        $this->addSql('CREATE TABLE property_feature (id INT NOT NULL, property_id INT NOT NULL, feature_id INT NOT NULL, value TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_461A3F1E549213EC ON property_feature (property_id)');
        $this->addSql('CREATE INDEX IDX_461A3F1E60E4B879 ON property_feature (feature_id)');
        $this->addSql('CREATE TABLE temporary_file (id INT NOT NULL, name VARCHAR(255) NOT NULL, date_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN temporary_file.date_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "users" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON "users" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE attachment_property_photo ADD CONSTRAINT FK_CF3E6D10549213EC FOREIGN KEY (property_id) REFERENCES "properties" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attachment_property_photo ADD CONSTRAINT FK_CF3E6D10BF396750 FOREIGN KEY (id) REFERENCES attachments (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "properties" ADD CONSTRAINT FK_87C331C7B4873F54 FOREIGN KEY (property_class_id) REFERENCES property_class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE property_class ADD CONSTRAINT FK_2B58D892727ACA70 FOREIGN KEY (parent_id) REFERENCES property_class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE property_feature ADD CONSTRAINT FK_461A3F1E549213EC FOREIGN KEY (property_id) REFERENCES "properties" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE property_feature ADD CONSTRAINT FK_461A3F1E60E4B879 FOREIGN KEY (feature_id) REFERENCES "features" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE attachment_property_photo DROP CONSTRAINT FK_CF3E6D10BF396750');
        $this->addSql('ALTER TABLE property_feature DROP CONSTRAINT FK_461A3F1E60E4B879');
        $this->addSql('ALTER TABLE attachment_property_photo DROP CONSTRAINT FK_CF3E6D10549213EC');
        $this->addSql('ALTER TABLE property_feature DROP CONSTRAINT FK_461A3F1E549213EC');
        $this->addSql('ALTER TABLE "properties" DROP CONSTRAINT FK_87C331C7B4873F54');
        $this->addSql('ALTER TABLE property_class DROP CONSTRAINT FK_2B58D892727ACA70');
        $this->addSql('DROP SEQUENCE attachments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE configuration_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "features_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "properties_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE property_class_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE property_feature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE temporary_file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "users_id_seq" CASCADE');
        $this->addSql('DROP TABLE attachment_property_photo');
        $this->addSql('DROP TABLE attachments');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE "features"');
        $this->addSql('DROP TABLE "properties"');
        $this->addSql('DROP TABLE property_class');
        $this->addSql('DROP TABLE property_feature');
        $this->addSql('DROP TABLE temporary_file');
        $this->addSql('DROP TABLE "users"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
