<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219200944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dechets ADD reservation_dechets_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dechets ADD CONSTRAINT FK_56EF6EAF1F04AF4F FOREIGN KEY (reservation_dechets_id) REFERENCES reservation_dechets (id)');
        $this->addSql('CREATE INDEX IDX_56EF6EAF1F04AF4F ON dechets (reservation_dechets_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dechets DROP FOREIGN KEY FK_56EF6EAF1F04AF4F');
        $this->addSql('DROP INDEX IDX_56EF6EAF1F04AF4F ON dechets');
        $this->addSql('ALTER TABLE dechets DROP reservation_dechets_id');
    }
}
