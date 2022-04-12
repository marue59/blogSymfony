<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412120839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plateforme ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plateforme ADD CONSTRAINT FK_3C020C11EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C020C11EE45BDBF ON plateforme (picture_id)');
        $this->addSql('ALTER TABLE veille_techno ADD CONSTRAINT FK_3A52B8CE391E226B FOREIGN KEY (plateforme_id) REFERENCES plateforme (id)');
        $this->addSql('CREATE INDEX IDX_3A52B8CE391E226B ON veille_techno (plateforme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plateforme DROP FOREIGN KEY FK_3C020C11EE45BDBF');
        $this->addSql('DROP INDEX UNIQ_3C020C11EE45BDBF ON plateforme');
        $this->addSql('ALTER TABLE plateforme DROP picture_id');
        $this->addSql('ALTER TABLE veille_techno DROP FOREIGN KEY FK_3A52B8CE391E226B');
        $this->addSql('DROP INDEX IDX_3A52B8CE391E226B ON veille_techno');
    }
}
