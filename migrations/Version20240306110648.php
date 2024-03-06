<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306110648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BBF396750');
        $this->addSql('DROP TABLE devis');
        $this->addSql('ALTER TABLE client CHANGE commercial_id commercial_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devis (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BBF396750 FOREIGN KEY (id) REFERENCES facturation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client CHANGE commercial_id commercial_id INT DEFAULT NULL');
    }
}
