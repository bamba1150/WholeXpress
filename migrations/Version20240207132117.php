<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207132117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, mode_expedition VARCHAR(11) NOT NULL, code_sortie VARCHAR(11) NOT NULL, date_arrivee_est DATETIME NOT NULL, preuve_paiement VARCHAR(50) NOT NULL, montant_ttc DOUBLE PRECISION NOT NULL, frais_transport DOUBLE PRECISION NOT NULL, frais_fournisseur DOUBLE PRECISION NOT NULL, etat_achat VARCHAR(11) NOT NULL, etat_comm VARCHAR(11) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(15) NOT NULL, prenom_client VARCHAR(15) NOT NULL, email_client VARCHAR(15) NOT NULL, adresse_client VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, nbre_versement INT NOT NULL, mode_paiement VARCHAR(15) NOT NULL, date_paiement DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, code_produit VARCHAR(15) NOT NULL, description VARCHAR(25) NOT NULL, prix_usine_devise DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, qte DOUBLE PRECISION NOT NULL, qte_recue DOUBLE PRECISION NOT NULL, qte_manquante DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamations (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, type VARCHAR(50) NOT NULL, description VARCHAR(100) NOT NULL, etat VARCHAR(11) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reclamations');
    }
}
