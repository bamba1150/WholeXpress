<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307111224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tc (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tc ADD CONSTRAINT FK_DE319EEFBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845622A76C4');
        $this->addSql('DROP INDEX IDX_26A9845622A76C4 ON achat');
        $this->addSql('ALTER TABLE achat DROP ca_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tc DROP FOREIGN KEY FK_DE319EEFBF396750');
        $this->addSql('DROP TABLE tc');
        $this->addSql('ALTER TABLE achat ADD ca_id INT NOT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845622A76C4 FOREIGN KEY (ca_id) REFERENCES ca (id)');
        $this->addSql('CREATE INDEX IDX_26A9845622A76C4 ON achat (ca_id)');
    }
}
