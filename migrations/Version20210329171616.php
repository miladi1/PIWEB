<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329171616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commantaire DROP FOREIGN KEY FK_93BF4CAFF6CCF490');
        $this->addSql('DROP INDEX IDX_93BF4CAFF6CCF490 ON commantaire');
        $this->addSql('ALTER TABLE commantaire CHANGE com_pub_id com_pub INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commantaire CHANGE com_pub com_pub_id INT NOT NULL');
        $this->addSql('ALTER TABLE commantaire ADD CONSTRAINT FK_93BF4CAFF6CCF490 FOREIGN KEY (com_pub_id) REFERENCES publication (id)');
        $this->addSql('CREATE INDEX IDX_93BF4CAFF6CCF490 ON commantaire (com_pub_id)');
    }
}
