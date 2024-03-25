<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325152105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, ca_id INT NOT NULL, commande_id INT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, mode_expedition VARCHAR(25) NOT NULL, date_arrivee_estimee DATETIME NOT NULL, montant_ttc DOUBLE PRECISION NOT NULL, frais_transport DOUBLE PRECISION NOT NULL, frais_fournisseur DOUBLE PRECISION NOT NULL, etat_achat VARCHAR(15) NOT NULL, etat_communication VARCHAR(15) NOT NULL, INDEX IDX_26A9845622A76C4 (ca_id), UNIQUE INDEX UNIQ_26A9845682EA2E54 (commande_id), INDEX IDX_26A9845619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845622A76C4 FOREIGN KEY (ca_id) REFERENCES ca (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845622A76C4');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845682EA2E54');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845619EB6921');
        $this->addSql('DROP TABLE achat');
    }
}
