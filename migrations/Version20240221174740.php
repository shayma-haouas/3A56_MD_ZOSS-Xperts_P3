<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221174740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_don DROP FOREIGN KEY FK_9D804C962EAB82C6');
        $this->addSql('DROP INDEX UNIQ_9D804C962EAB82C6 ON facture_don');
        $this->addSql('ALTER TABLE facture_don CHANGE facture_don_id don_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture_don ADD CONSTRAINT FK_9D804C967B3C9061 FOREIGN KEY (don_id) REFERENCES don (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D804C967B3C9061 ON facture_don (don_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_don DROP FOREIGN KEY FK_9D804C967B3C9061');
        $this->addSql('DROP INDEX UNIQ_9D804C967B3C9061 ON facture_don');
        $this->addSql('ALTER TABLE facture_don CHANGE don_id facture_don_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture_don ADD CONSTRAINT FK_9D804C962EAB82C6 FOREIGN KEY (facture_don_id) REFERENCES don (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D804C962EAB82C6 ON facture_don (facture_don_id)');
    }
}
