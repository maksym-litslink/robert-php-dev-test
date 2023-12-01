<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201121336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE translation_unit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE translation_unit_version_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE translation_unit (id INT NOT NULL, text TEXT NOT NULL, language_code VARCHAR(255) NOT NULL, dest_language_code VARCHAR(255) NOT NULL, translated_text TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN translation_unit.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN translation_unit.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE translation_unit_version (id INT NOT NULL, translation_unit_id INT NOT NULL, version INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9CC9F3DD59B189FF ON translation_unit_version (translation_unit_id)');
        $this->addSql('ALTER TABLE translation_unit_version ADD CONSTRAINT FK_9CC9F3DD59B189FF FOREIGN KEY (translation_unit_id) REFERENCES translation_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE translation_unit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE translation_unit_version_id_seq CASCADE');
        $this->addSql('ALTER TABLE translation_unit_version DROP CONSTRAINT FK_9CC9F3DD59B189FF');
        $this->addSql('DROP TABLE translation_unit');
        $this->addSql('DROP TABLE translation_unit_version');
    }
}
