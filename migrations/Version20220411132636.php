<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411132636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE veille_techno (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veille_techno_category (veille_techno_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_4C31953C54096A28 (veille_techno_id), INDEX IDX_4C31953C12469DE2 (category_id), PRIMARY KEY(veille_techno_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE veille_techno_category ADD CONSTRAINT FK_4C31953C54096A28 FOREIGN KEY (veille_techno_id) REFERENCES veille_techno (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE veille_techno_category ADD CONSTRAINT FK_4C31953C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture ADD veille_techno_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8954096A28 FOREIGN KEY (veille_techno_id) REFERENCES veille_techno (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F8954096A28 ON picture (veille_techno_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8954096A28');
        $this->addSql('ALTER TABLE veille_techno_category DROP FOREIGN KEY FK_4C31953C54096A28');
        $this->addSql('DROP TABLE veille_techno');
        $this->addSql('DROP TABLE veille_techno_category');
        $this->addSql('DROP INDEX IDX_16DB4F8954096A28 ON picture');
        $this->addSql('ALTER TABLE picture DROP veille_techno_id');
    }
}
