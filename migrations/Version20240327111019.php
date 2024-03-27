<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327111019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, ca_id INT NOT NULL, commande_id INT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, mode_expedition VARCHAR(25) NOT NULL, date_arrivee_estimee DATETIME NOT NULL, montant_ttc DOUBLE PRECISION NOT NULL, frais_transport DOUBLE PRECISION NOT NULL, frais_fournisseur DOUBLE PRECISION NOT NULL, etat_achat VARCHAR(15) NOT NULL, etat_communication VARCHAR(15) NOT NULL, INDEX IDX_26A9845622A76C4 (ca_id), UNIQUE INDEX UNIQ_26A9845682EA2E54 (commande_id), INDEX IDX_26A9845619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ca (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, libelle_catalogue VARCHAR(15) NOT NULL, INDEX IDX_59A699F519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cc (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, commercial_id INT NOT NULL, reclamations_id INT DEFAULT NULL, email_client VARCHAR(25) NOT NULL, adresse_client VARCHAR(25) NOT NULL, nom_complet_client VARCHAR(25) NOT NULL, code_client VARCHAR(25) NOT NULL, typeClient VARCHAR(255) NOT NULL, INDEX IDX_C74404557854071C (commercial_id), INDEX IDX_C74404551853BCF7 (reclamations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, catalogue_id INT NOT NULL, ref_emballage VARCHAR(15) NOT NULL, moyen_paiement VARCHAR(15) NOT NULL, nbre_versement VARCHAR(15) NOT NULL, etat_commande VARCHAR(15) NOT NULL, preuve_paiement VARCHAR(25) NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), UNIQUE INDEX UNIQ_6EEAA67D4A7843DC (catalogue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commercant (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE particulier (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, catalogue_id INT NOT NULL, code_produit VARCHAR(15) NOT NULL, description VARCHAR(25) NOT NULL, prix_usine_devise DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, qte DOUBLE PRECISION NOT NULL, qte_recue DOUBLE PRECISION NOT NULL, qte_manquante DOUBLE PRECISION NOT NULL, INDEX IDX_29A5EC274A7843DC (catalogue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamations (id INT AUTO_INCREMENT NOT NULL, commercial_id INT DEFAULT NULL, date DATETIME NOT NULL, type VARCHAR(50) NOT NULL, description VARCHAR(100) NOT NULL, etat VARCHAR(11) NOT NULL, ref_reclamation VARCHAR(15) NOT NULL, INDEX IDX_1CAD6B767854071C (commercial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tc (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(200) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, nom_complet VARCHAR(15) NOT NULL, typeUser VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845622A76C4 FOREIGN KEY (ca_id) REFERENCES ca (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalogue ADD CONSTRAINT FK_59A699F519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404557854071C FOREIGN KEY (commercial_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404551853BCF7 FOREIGN KEY (reclamations_id) REFERENCES reclamations (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('ALTER TABLE commercant ADD CONSTRAINT FK_ECB4268FBF396750 FOREIGN KEY (id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE particulier ADD CONSTRAINT FK_6CC4D4F3BF396750 FOREIGN KEY (id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('ALTER TABLE reclamations ADD CONSTRAINT FK_1CAD6B767854071C FOREIGN KEY (commercial_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tc ADD CONSTRAINT FK_DE319EEFBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845622A76C4');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845682EA2E54');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845619EB6921');
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55BF396750');
        $this->addSql('ALTER TABLE catalogue DROP FOREIGN KEY FK_59A699F519EB6921');
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79BF396750');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404557854071C');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404551853BCF7');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4A7843DC');
        $this->addSql('ALTER TABLE commercant DROP FOREIGN KEY FK_ECB4268FBF396750');
        $this->addSql('ALTER TABLE particulier DROP FOREIGN KEY FK_6CC4D4F3BF396750');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274A7843DC');
        $this->addSql('ALTER TABLE reclamations DROP FOREIGN KEY FK_1CAD6B767854071C');
        $this->addSql('ALTER TABLE tc DROP FOREIGN KEY FK_DE319EEFBF396750');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE ca');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE cc');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commercant');
        $this->addSql('DROP TABLE particulier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reclamations');
        $this->addSql('DROP TABLE tc');
        $this->addSql('DROP TABLE user');
    }
}
