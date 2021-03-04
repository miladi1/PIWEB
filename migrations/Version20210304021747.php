<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304021747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participation_employer');
        $this->addSql('ALTER TABLE participation ADD id_employer INT NOT NULL, CHANGE date date VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation_employer (participation_id INT NOT NULL, employer_id INT NOT NULL, INDEX IDX_32647CF141CD9E7A (employer_id), INDEX IDX_32647CF16ACE3B73 (participation_id), PRIMARY KEY(participation_id, employer_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participation_employer ADD CONSTRAINT FK_32647CF141CD9E7A FOREIGN KEY (employer_id) REFERENCES employer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_employer ADD CONSTRAINT FK_32647CF16ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation DROP id_employer, CHANGE date date DATETIME NOT NULL');
    }
}
