<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319121836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DCD11A2CF');
        $this->addSql('DROP INDEX IDX_6EEAA67DCD11A2CF ON commande');
        $this->addSql('ALTER TABLE commande ADD achat_id INT NOT NULL, ADD moyen_paiement VARCHAR(15) NOT NULL, ADD nbre_versement VARCHAR(15) NOT NULL, CHANGE produits_id catalogue_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D4A7843DC ON commande (catalogue_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67DFE95D117 ON commande (achat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4A7843DC');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFE95D117');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D4A7843DC ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67DFE95D117 ON commande');
        $this->addSql('ALTER TABLE commande ADD produits_id INT NOT NULL, DROP catalogue_id, DROP achat_id, DROP moyen_paiement, DROP nbre_versement');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DCD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DCD11A2CF ON commande (produits_id)');
    }
}
