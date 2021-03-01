<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301224647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publication_employeur (publication_id INT NOT NULL, employeur_id INT NOT NULL, INDEX IDX_9B04E75038B217A7 (publication_id), INDEX IDX_9B04E7505D7C53EC (employeur_id), PRIMARY KEY(publication_id, employeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication_employer (publication_id INT NOT NULL, employer_id INT NOT NULL, INDEX IDX_F12B053738B217A7 (publication_id), INDEX IDX_F12B053741CD9E7A (employer_id), PRIMARY KEY(publication_id, employer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication_employeur ADD CONSTRAINT FK_9B04E75038B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication_employeur ADD CONSTRAINT FK_9B04E7505D7C53EC FOREIGN KEY (employeur_id) REFERENCES employeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication_employer ADD CONSTRAINT FK_F12B053738B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication_employer ADD CONSTRAINT FK_F12B053741CD9E7A FOREIGN KEY (employer_id) REFERENCES employer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE publication_employeur');
        $this->addSql('DROP TABLE publication_employer');
    }
}
