<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214023321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_dechets ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_dechets ADD CONSTRAINT FK_317AD52AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_317AD52AA76ED395 ON reservation_dechets (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_dechets DROP FOREIGN KEY FK_317AD52AA76ED395');
        $this->addSql('DROP INDEX IDX_317AD52AA76ED395 ON reservation_dechets');
        $this->addSql('ALTER TABLE reservation_dechets DROP user_id');
    }
}
