<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201125230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation_unit_version ADD text TEXT NOT NULL');
        $this->addSql('ALTER TABLE translation_unit_version ADD language_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE translation_unit_version ADD dest_language_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE translation_unit_version ADD translated_text TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE translation_unit_version ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN translation_unit_version.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE translation_unit_version DROP text');
        $this->addSql('ALTER TABLE translation_unit_version DROP language_code');
        $this->addSql('ALTER TABLE translation_unit_version DROP dest_language_code');
        $this->addSql('ALTER TABLE translation_unit_version DROP translated_text');
        $this->addSql('ALTER TABLE translation_unit_version DROP created_at');
    }
}
