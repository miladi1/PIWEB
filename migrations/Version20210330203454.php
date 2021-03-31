<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330203454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publication_employeur (publication_id INT NOT NULL, employeur_id INT NOT NULL, INDEX IDX_9B04E75038B217A7 (publication_id), INDEX IDX_9B04E7505D7C53EC (employeur_id), PRIMARY KEY(publication_id, employeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication_employeur ADD CONSTRAINT FK_9B04E75038B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication_employeur ADD CONSTRAINT FK_9B04E7505D7C53EC FOREIGN KEY (employeur_id) REFERENCES employeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commantaire DROP FOREIGN KEY FK_93BF4CAFF6CCF490');
        $this->addSql('DROP INDEX IDX_93BF4CAFF6CCF490 ON commantaire');
        $this->addSql('ALTER TABLE commantaire DROP likes, CHANGE com_pub_id com_pub INT NOT NULL');
        $this->addSql('ALTER TABLE publication ADD img VARCHAR(255) NOT NULL, CHANGE vus vus INT NOT NULL, CHANGE likes likes INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE publication_employeur');
        $this->addSql('ALTER TABLE commantaire ADD likes VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE com_pub com_pub_id INT NOT NULL');
        $this->addSql('ALTER TABLE commantaire ADD CONSTRAINT FK_93BF4CAFF6CCF490 FOREIGN KEY (com_pub_id) REFERENCES publication (id)');
        $this->addSql('CREATE INDEX IDX_93BF4CAFF6CCF490 ON commantaire (com_pub_id)');
        $this->addSql('ALTER TABLE publication DROP img, CHANGE vus vus VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE likes likes VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
