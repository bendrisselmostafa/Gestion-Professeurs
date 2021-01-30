<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613194658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom_depart VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, nom VARCHAR(10) NOT NULL, prenom VARCHAR(10) NOT NULL, cin VARCHAR(10) NOT NULL, adresse VARCHAR(30) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, email VARCHAR(30) DEFAULT NULL, date_recrutement DATE NOT NULL, INDEX IDX_17A55299CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur_cours (professeur_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_6C94E7E2BAB22EE9 (professeur_id), INDEX IDX_6C94E7E27ECF78B0 (cours_id), PRIMARY KEY(professeur_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE professeur_cours ADD CONSTRAINT FK_6C94E7E2BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_cours ADD CONSTRAINT FK_6C94E7E27ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE professeur_cours DROP FOREIGN KEY FK_6C94E7E27ECF78B0');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299CCF9E01E');
        $this->addSql('ALTER TABLE professeur_cours DROP FOREIGN KEY FK_6C94E7E2BAB22EE9');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE professeur_cours');
    }
}
