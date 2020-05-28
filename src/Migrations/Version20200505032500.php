<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505032500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examen CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere CHANGE classe_id classe_id INT DEFAULT NULL, CHANGE enseignant_id enseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE examen_id examen_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponses_etudiant CHANGE examen_id examen_id INT DEFAULT NULL, CHANGE question_id question_id INT DEFAULT NULL, CHANGE suggestions_id suggestions_id INT DEFAULT NULL, CHANGE etudiant_id etudiant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suggestions CHANGE question_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE classe_id classe_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examen CHANGE matiere_id matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere CHANGE classe_id classe_id INT DEFAULT NULL, CHANGE enseignant_id enseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE examen_id examen_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponses_etudiant CHANGE examen_id examen_id INT DEFAULT NULL, CHANGE question_id question_id INT DEFAULT NULL, CHANGE suggestions_id suggestions_id INT DEFAULT NULL, CHANGE etudiant_id etudiant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suggestions CHANGE question_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE classe_id classe_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
