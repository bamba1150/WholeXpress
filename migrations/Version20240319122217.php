<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319122217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP preuve_paiement');
        $this->addSql('ALTER TABLE commande ADD etat_commande VARCHAR(15) NOT NULL, ADD preuve_paiement VARCHAR(25) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat ADD preuve_paiement VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP etat_commande, DROP preuve_paiement');
    }
}
