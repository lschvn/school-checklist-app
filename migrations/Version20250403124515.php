<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403124515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE projet_checklist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, checklist_template_id INTEGER DEFAULT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, client VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , CONSTRAINT FK_7F978AFB1316BF28 FOREIGN KEY (checklist_template_id) REFERENCES checklist_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7F978AFBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7F978AFB1316BF28 ON projet_checklist (checklist_template_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7F978AFBA76ED395 ON projet_checklist (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE projet_checklist_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_checklist_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, is_checked BOOLEAN NOT NULL, position INTEGER NOT NULL, CONSTRAINT FK_AFC5A95A9BCAECC4 FOREIGN KEY (project_checklist_id) REFERENCES projet_checklist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AFC5A95A9BCAECC4 ON projet_checklist_item (project_checklist_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE projet_checklist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE projet_checklist_item
        SQL);
    }
}
