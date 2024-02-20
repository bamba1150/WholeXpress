<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207170544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_produit (client_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_7B98A85A19EB6921 (client_id), INDEX IDX_7B98A85AF347EFB (produit_id), PRIMARY KEY(client_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_produit ADD CONSTRAINT FK_7B98A85A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_produit ADD CONSTRAINT FK_7B98A85AF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalogue ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE catalogue ADD CONSTRAINT FK_59A699F519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_59A699F519EB6921 ON catalogue (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_produit DROP FOREIGN KEY FK_7B98A85A19EB6921');
        $this->addSql('ALTER TABLE client_produit DROP FOREIGN KEY FK_7B98A85AF347EFB');
        $this->addSql('DROP TABLE client_produit');
        $this->addSql('ALTER TABLE catalogue DROP FOREIGN KEY FK_59A699F519EB6921');
        $this->addSql('DROP INDEX IDX_59A699F519EB6921 ON catalogue');
        $this->addSql('ALTER TABLE catalogue DROP client_id');
    }
}
