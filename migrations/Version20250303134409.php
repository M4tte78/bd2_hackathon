<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303134409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affectation ADD chantier_id INT NOT NULL');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3D0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id)');
        $this->addSql('CREATE INDEX IDX_F4DD61D3D0C0049D ON affectation (chantier_id)');
        $this->addSql('ALTER TABLE chantier ADD statut_id INT NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD date_debut DATE NOT NULL, ADD date_fin DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE chantier ADD CONSTRAINT FK_636F27F6F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_636F27F6F6203804 ON chantier (statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3D0C0049D');
        $this->addSql('DROP INDEX IDX_F4DD61D3D0C0049D ON affectation');
        $this->addSql('ALTER TABLE affectation DROP chantier_id');
        $this->addSql('ALTER TABLE chantier DROP FOREIGN KEY FK_636F27F6F6203804');
        $this->addSql('DROP INDEX IDX_636F27F6F6203804 ON chantier');
        $this->addSql('ALTER TABLE chantier DROP statut_id, DROP nom, DROP adresse, DROP date_debut, DROP date_fin');
    }
}
