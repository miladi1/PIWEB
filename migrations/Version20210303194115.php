<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303194115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_publication (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_reunion (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commantaire (id INT AUTO_INCREMENT NOT NULL, com_pub_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, likes VARCHAR(255) NOT NULL, INDEX IDX_93BF4CAFF6CCF490 (com_pub_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, titre_id INT NOT NULL, fonction VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) NOT NULL, horaires VARCHAR(255) NOT NULL, devise VARCHAR(255) NOT NULL, mode_salaire VARCHAR(255) NOT NULL, periode VARCHAR(255) NOT NULL, annuel_moins INT NOT NULL, INDEX IDX_60349993D54FAE5E (titre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employer (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, email VARCHAR(255) NOT NULL, numero INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, titre_id INT NOT NULL, event_employeur_id INT NOT NULL, date DATE NOT NULL, heure TIME NOT NULL, dure INT NOT NULL, nomber_par INT NOT NULL, INDEX IDX_3BAE0AA7D54FAE5E (titre_id), INDEX IDX_3BAE0AA7B06F591F (event_employeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_employer (event_id INT NOT NULL, employer_id INT NOT NULL, INDEX IDX_98A019B671F7E88B (event_id), INDEX IDX_98A019B641CD9E7A (employer_id), PRIMARY KEY(event_id, employer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opportunite (id INT AUTO_INCREMENT NOT NULL, op_employeur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_97889F982359411B (op_employeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, vus VARCHAR(255) NOT NULL, likes VARCHAR(255) NOT NULL, nombre_com INT NOT NULL, INDEX IDX_AF3C6779BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication_employeur (publication_id INT NOT NULL, employeur_id INT NOT NULL, INDEX IDX_9B04E75038B217A7 (publication_id), INDEX IDX_9B04E7505D7C53EC (employeur_id), PRIMARY KEY(publication_id, employeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication_employer (publication_id INT NOT NULL, employer_id INT NOT NULL, INDEX IDX_F12B053738B217A7 (publication_id), INDEX IDX_F12B053741CD9E7A (employer_id), PRIMARY KEY(publication_id, employer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reunion (id INT AUTO_INCREMENT NOT NULL, titre_id INT NOT NULL, rn_employeur_id INT NOT NULL, rn_employer_id INT NOT NULL, date VARCHAR(255) NOT NULL, heure VARCHAR(255) NOT NULL, lien_meet VARCHAR(255) NOT NULL, INDEX IDX_5B00A482D54FAE5E (titre_id), INDEX IDX_5B00A482361CC5B4 (rn_employeur_id), INDEX IDX_5B00A4824A0A322A (rn_employer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_event (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commantaire ADD CONSTRAINT FK_93BF4CAFF6CCF490 FOREIGN KEY (com_pub_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993D54FAE5E FOREIGN KEY (titre_id) REFERENCES opportunite (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D54FAE5E FOREIGN KEY (titre_id) REFERENCES type_event (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B06F591F FOREIGN KEY (event_employeur_id) REFERENCES employeur (id)');
        $this->addSql('ALTER TABLE event_employer ADD CONSTRAINT FK_98A019B671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_employer ADD CONSTRAINT FK_98A019B641CD9E7A FOREIGN KEY (employer_id) REFERENCES employer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F982359411B FOREIGN KEY (op_employeur_id) REFERENCES employeur (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779BCF5E72D FOREIGN KEY (categorie_id) REFERENCES category_publication (id)');
        $this->addSql('ALTER TABLE publication_employeur ADD CONSTRAINT FK_9B04E75038B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication_employeur ADD CONSTRAINT FK_9B04E7505D7C53EC FOREIGN KEY (employeur_id) REFERENCES employeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication_employer ADD CONSTRAINT FK_F12B053738B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication_employer ADD CONSTRAINT FK_F12B053741CD9E7A FOREIGN KEY (employer_id) REFERENCES employer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reunion ADD CONSTRAINT FK_5B00A482D54FAE5E FOREIGN KEY (titre_id) REFERENCES category_reunion (id)');
        $this->addSql('ALTER TABLE reunion ADD CONSTRAINT FK_5B00A482361CC5B4 FOREIGN KEY (rn_employeur_id) REFERENCES employeur (id)');
        $this->addSql('ALTER TABLE reunion ADD CONSTRAINT FK_5B00A4824A0A322A FOREIGN KEY (rn_employer_id) REFERENCES employer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779BCF5E72D');
        $this->addSql('ALTER TABLE reunion DROP FOREIGN KEY FK_5B00A482D54FAE5E');
        $this->addSql('ALTER TABLE event_employer DROP FOREIGN KEY FK_98A019B641CD9E7A');
        $this->addSql('ALTER TABLE publication_employer DROP FOREIGN KEY FK_F12B053741CD9E7A');
        $this->addSql('ALTER TABLE reunion DROP FOREIGN KEY FK_5B00A4824A0A322A');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7B06F591F');
        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F982359411B');
        $this->addSql('ALTER TABLE publication_employeur DROP FOREIGN KEY FK_9B04E7505D7C53EC');
        $this->addSql('ALTER TABLE reunion DROP FOREIGN KEY FK_5B00A482361CC5B4');
        $this->addSql('ALTER TABLE event_employer DROP FOREIGN KEY FK_98A019B671F7E88B');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993D54FAE5E');
        $this->addSql('ALTER TABLE commantaire DROP FOREIGN KEY FK_93BF4CAFF6CCF490');
        $this->addSql('ALTER TABLE publication_employeur DROP FOREIGN KEY FK_9B04E75038B217A7');
        $this->addSql('ALTER TABLE publication_employer DROP FOREIGN KEY FK_F12B053738B217A7');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7D54FAE5E');
        $this->addSql('DROP TABLE category_publication');
        $this->addSql('DROP TABLE category_reunion');
        $this->addSql('DROP TABLE commantaire');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE employer');
        $this->addSql('DROP TABLE employeur');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_employer');
        $this->addSql('DROP TABLE opportunite');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE publication_employeur');
        $this->addSql('DROP TABLE publication_employer');
        $this->addSql('DROP TABLE reunion');
        $this->addSql('DROP TABLE type_event');
    }
}
