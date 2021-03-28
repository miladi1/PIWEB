<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326192752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employer ADD employeur_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD mdp VARCHAR(255) NOT NULL, ADD mail VARCHAR(255) NOT NULL, ADD num INT NOT NULL, ADD localisation VARCHAR(255) NOT NULL, ADD categorie VARCHAR(255) NOT NULL, ADD img VARCHAR(255) NOT NULL, DROP nom, DROP prenom, DROP age, DROP email, DROP numero');
        $this->addSql('ALTER TABLE employer ADD CONSTRAINT FK_DE4CF0665D7C53EC FOREIGN KEY (employeur_id) REFERENCES employeur (id)');
        $this->addSql('CREATE INDEX IDX_DE4CF0665D7C53EC ON employer (employeur_id)');
        $this->addSql('ALTER TABLE employeur ADD pass VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD loca VARCHAR(255) NOT NULL, ADD logo VARCHAR(255) NOT NULL, DROP prenom, DROP email');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employer DROP FOREIGN KEY FK_DE4CF0665D7C53EC');
        $this->addSql('DROP INDEX IDX_DE4CF0665D7C53EC ON employer');
        $this->addSql('ALTER TABLE employer ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD numero INT NOT NULL, DROP employeur_id, DROP name, DROP mdp, DROP mail, DROP localisation, DROP categorie, DROP img, CHANGE num age INT NOT NULL');
        $this->addSql('ALTER TABLE employeur ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP pass, DROP adresse, DROP loca, DROP logo');
    }
}
