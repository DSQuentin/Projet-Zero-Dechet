<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228200857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4C2885D7');
        $this->addSql('DROP INDEX IDX_9474526C4C2885D7 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE annonces_id annonce_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
        $this->addSql('CREATE INDEX IDX_9474526C8805AB2F ON comment (annonce_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C8805AB2F');
        $this->addSql('DROP INDEX IDX_9474526C8805AB2F ON comment');
        $this->addSql('ALTER TABLE comment CHANGE annonce_id annonces_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id)');
        $this->addSql('CREATE INDEX IDX_9474526C4C2885D7 ON comment (annonces_id)');
    }
}
