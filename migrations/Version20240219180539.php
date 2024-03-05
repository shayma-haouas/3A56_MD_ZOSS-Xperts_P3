<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219180539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dechets DROP FOREIGN KEY FK_56EF6EAFFD02F13');
        $this->addSql('DROP INDEX IDX_56EF6EAFFD02F13 ON dechets');
        $this->addSql('ALTER TABLE dechets DROP evenement_id');
        $this->addSql('ALTER TABLE reservation_dechets ADD dechets_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_dechets ADD CONSTRAINT FK_317AD52A7FAE66FB FOREIGN KEY (dechets_id) REFERENCES dechets (id)');
        $this->addSql('CREATE INDEX IDX_317AD52A7FAE66FB ON reservation_dechets (dechets_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dechets ADD evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dechets ADD CONSTRAINT FK_56EF6EAFFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_56EF6EAFFD02F13 ON dechets (evenement_id)');
        $this->addSql('ALTER TABLE reservation_dechets DROP FOREIGN KEY FK_317AD52A7FAE66FB');
        $this->addSql('DROP INDEX IDX_317AD52A7FAE66FB ON reservation_dechets');
        $this->addSql('ALTER TABLE reservation_dechets DROP dechets_id');
    }
}
