<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307113058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devis (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facturation (id INT AUTO_INCREMENT NOT NULL, commercial_id INT NOT NULL, numero_facture VARCHAR(100) NOT NULL, date_facture DATE NOT NULL, frais_service DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_17EB513A7854071C (commercial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BBF396750 FOREIGN KEY (id) REFERENCES facturation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facturation ADD CONSTRAINT FK_17EB513A7854071C FOREIGN KEY (commercial_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410BF396750 FOREIGN KEY (id) REFERENCES facturation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BBF396750');
        $this->addSql('ALTER TABLE facturation DROP FOREIGN KEY FK_17EB513A7854071C');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410BF396750');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE facturation');
        $this->addSql('DROP TABLE facture');
    }
}
