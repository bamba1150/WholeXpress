<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306095124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devis (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facturation (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(50) NOT NULL, date DATE NOT NULL, frais_service DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, type_facturation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BBF396750 FOREIGN KEY (id) REFERENCES facturation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410BF396750 FOREIGN KEY (id) REFERENCES facturation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BBF396750');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410BF396750');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE facturation');
        $this->addSql('DROP TABLE facture');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL');
    }
}
