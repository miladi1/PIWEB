<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303171235 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_employer DROP FOREIGN KEY FK_98A019B671F7E88B');
        $this->addSql('DROP TABLE employer_ev');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_employer');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E317CAD3C');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E88939516');
        $this->addSql('DROP INDEX IDX_B26681E88939516 ON evenement');
        $this->addSql('DROP INDEX IDX_B26681E317CAD3C ON evenement');
        $this->addSql('ALTER TABLE evenement ADD date_start DATETIME NOT NULL, ADD date_end DATETIME NOT NULL, ADD description LONGTEXT NOT NULL, DROP type_evenement_id, DROP start, DROP end, CHANGE employeur_ev_id employeur_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E4EF28902 FOREIGN KEY (employeur_event_id) REFERENCES employeur (id)');
        $this->addSql('CREATE INDEX IDX_B26681E4EF28902 ON evenement (employeur_event_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employer_ev (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, titre_id INT NOT NULL, event_employeur_id INT NOT NULL, date DATE NOT NULL, heure TIME NOT NULL, dure INT NOT NULL, nomber_par INT NOT NULL, INDEX IDX_3BAE0AA7D54FAE5E (titre_id), INDEX IDX_3BAE0AA7B06F591F (event_employeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_employer (event_id INT NOT NULL, employer_id INT NOT NULL, INDEX IDX_98A019B641CD9E7A (employer_id), INDEX IDX_98A019B671F7E88B (event_id), PRIMARY KEY(event_id, employer_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B06F591F FOREIGN KEY (event_employeur_id) REFERENCES employeur (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D54FAE5E FOREIGN KEY (titre_id) REFERENCES type_event (id)');
        $this->addSql('ALTER TABLE event_employer ADD CONSTRAINT FK_98A019B641CD9E7A FOREIGN KEY (employer_id) REFERENCES employer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_employer ADD CONSTRAINT FK_98A019B671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E4EF28902');
        $this->addSql('DROP INDEX IDX_B26681E4EF28902 ON evenement');
        $this->addSql('ALTER TABLE evenement ADD type_evenement_id INT NOT NULL, ADD start DATETIME NOT NULL, ADD end DATETIME NOT NULL, DROP date_start, DROP date_end, DROP description, CHANGE employeur_event_id employeur_ev_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E317CAD3C FOREIGN KEY (employeur_ev_id) REFERENCES employeur (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E88939516 FOREIGN KEY (type_evenement_id) REFERENCES type_event (id)');
        $this->addSql('CREATE INDEX IDX_B26681E88939516 ON evenement (type_evenement_id)');
        $this->addSql('CREATE INDEX IDX_B26681E317CAD3C ON evenement (employeur_ev_id)');
    }
}
