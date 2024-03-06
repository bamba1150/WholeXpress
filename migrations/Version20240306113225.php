<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306113225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE commercial_id commercial_id INT NOT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BBF396750 FOREIGN KEY (id) REFERENCES facturation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE commercial_id commercial_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BBF396750');
    }
}
