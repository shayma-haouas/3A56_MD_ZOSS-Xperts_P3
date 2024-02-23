<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214014828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE don ADD facture_don_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D92EAB82C6 FOREIGN KEY (facture_don_id) REFERENCES facture_don (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F8F081D92EAB82C6 ON don (facture_don_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D92EAB82C6');
        $this->addSql('DROP INDEX UNIQ_F8F081D92EAB82C6 ON don');
        $this->addSql('ALTER TABLE don DROP facture_don_id');
    }
}
