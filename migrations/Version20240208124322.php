<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208124322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat ADD ca_id INT NOT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845622A76C4 FOREIGN KEY (ca_id) REFERENCES ca (id)');
        $this->addSql('CREATE INDEX IDX_26A9845622A76C4 ON achat (ca_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845622A76C4');
        $this->addSql('DROP INDEX IDX_26A9845622A76C4 ON achat');
        $this->addSql('ALTER TABLE achat DROP ca_id');
    }
}
