<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329115153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, titre_id INT NOT NULL, fonction VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) NOT NULL, horaires VARCHAR(255) NOT NULL, mode_salaire VARCHAR(255) NOT NULL, periode VARCHAR(255) NOT NULL, annuel_mois VARCHAR(255) NOT NULL, INDEX IDX_E33BD3B8D54FAE5E (titre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mailing (id INT AUTO_INCREMENT NOT NULL, numero_id INT DEFAULT NULL, sujet VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, ref VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_3ED9315E5D172A78 (numero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8D54FAE5E FOREIGN KEY (titre_id) REFERENCES opportunite (id)');
        $this->addSql('ALTER TABLE mailing ADD CONSTRAINT FK_3ED9315E5D172A78 FOREIGN KEY (numero_id) REFERENCES employer (id)');
        $this->addSql('ALTER TABLE evenement CHANGE employeur_event_id employeur_event_id INT NOT NULL');
        $this->addSql('ALTER TABLE opportunite ADD nom_entreprise VARCHAR(255) NOT NULL, ADD taille_entreprise VARCHAR(110) NOT NULL, ADD poste VARCHAR(255) NOT NULL, ADD media VARCHAR(255) NOT NULL, ADD nombre_recrutement INT NOT NULL, ADD logo VARCHAR(255) NOT NULL, ADD fonction VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE mailing');
        $this->addSql('ALTER TABLE evenement CHANGE employeur_event_id employeur_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opportunite DROP nom_entreprise, DROP taille_entreprise, DROP poste, DROP media, DROP nombre_recrutement, DROP logo, DROP fonction');
    }
}
