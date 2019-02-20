<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190220131208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE projet_categorie');
        $this->addSql('ALTER TABLE projets ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projets ADD CONSTRAINT FK_B454C1DBA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_B454C1DBA21214B7 ON projets (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE projet_categorie (projet_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_6A8331E0C18272 (projet_id), INDEX IDX_6A8331E0BCF5E72D (categorie_id), PRIMARY KEY(projet_id, categorie_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE projet_categorie ADD CONSTRAINT FK_6A8331E0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_categorie ADD CONSTRAINT FK_6A8331E0C18272 FOREIGN KEY (projet_id) REFERENCES projets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projets DROP FOREIGN KEY FK_B454C1DBA21214B7');
        $this->addSql('DROP INDEX IDX_B454C1DBA21214B7 ON projets');
        $this->addSql('ALTER TABLE projets DROP categories_id');
    }
}
