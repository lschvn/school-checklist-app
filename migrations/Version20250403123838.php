<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403123838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE checklist_item_template (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, checklist_template_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, is_required BOOLEAN NOT NULL, position INTEGER NOT NULL, CONSTRAINT FK_414DF8121316BF28 FOREIGN KEY (checklist_template_id) REFERENCES checklist_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_414DF8121316BF28 ON checklist_item_template (checklist_template_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE checklist_template (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(500) DEFAULT NULL)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE checklist_item_template
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE checklist_template
        SQL);
    }
}
