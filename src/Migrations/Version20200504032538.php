<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504032538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6498F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('DROP TABLE role');
        $this->addSql('ALTER TABLE cours CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examen CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere ADD enseignant_id INT DEFAULT NULL, CHANGE classe_id classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574AE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9014574AE455FCC0 ON matiere (enseignant_id)');
        $this->addSql('ALTER TABLE question CHANGE examen_id examen_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponses_etudiant ADD etudiant_id INT DEFAULT NULL, CHANGE examen_id examen_id INT DEFAULT NULL, CHANGE question_id question_id INT DEFAULT NULL, CHANGE suggestions_id suggestions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponses_etudiant ADD CONSTRAINT FK_C4E1ECCDDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C4E1ECCDDDEAB1A3 ON reponses_etudiant (etudiant_id)');
        $this->addSql('ALTER TABLE suggestions CHANGE question_id question_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574AE455FCC0');
        $this->addSql('ALTER TABLE reponses_etudiant DROP FOREIGN KEY FK_C4E1ECCDDDEAB1A3');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE cours CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examen CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_9014574AE455FCC0 ON matiere');
        $this->addSql('ALTER TABLE matiere DROP enseignant_id, CHANGE classe_id classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE examen_id examen_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_C4E1ECCDDDEAB1A3 ON reponses_etudiant');
        $this->addSql('ALTER TABLE reponses_etudiant DROP etudiant_id, CHANGE examen_id examen_id INT DEFAULT NULL, CHANGE question_id question_id INT DEFAULT NULL, CHANGE suggestions_id suggestions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suggestions CHANGE question_id question_id INT DEFAULT NULL');
    }
}
