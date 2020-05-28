<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504025238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours ADD matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CF46CD258 ON cours (matiere_id)');
        $this->addSql('ALTER TABLE examen ADD matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FECF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_514C8FECF46CD258 ON examen (matiere_id)');
        $this->addSql('ALTER TABLE matiere ADD classe_id INT DEFAULT NULL, ADD enseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574AE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9014574A8F5EA509 ON matiere (classe_id)');
        $this->addSql('CREATE INDEX IDX_9014574AE455FCC0 ON matiere (enseignant_id)');
        $this->addSql('ALTER TABLE question ADD examen_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E5C8659A FOREIGN KEY (examen_id) REFERENCES examen (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E5C8659A ON question (examen_id)');
        $this->addSql('ALTER TABLE reponses_etudiant ADD etudiant_id INT DEFAULT NULL, ADD examen_id INT DEFAULT NULL, ADD question_id INT DEFAULT NULL, ADD suggestions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponses_etudiant ADD CONSTRAINT FK_C4E1ECCDDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reponses_etudiant ADD CONSTRAINT FK_C4E1ECCD5C8659A FOREIGN KEY (examen_id) REFERENCES examen (id)');
        $this->addSql('ALTER TABLE reponses_etudiant ADD CONSTRAINT FK_C4E1ECCD1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reponses_etudiant ADD CONSTRAINT FK_C4E1ECCD32B5E779 FOREIGN KEY (suggestions_id) REFERENCES suggestions (id)');
        $this->addSql('CREATE INDEX IDX_C4E1ECCDDDEAB1A3 ON reponses_etudiant (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_C4E1ECCD5C8659A ON reponses_etudiant (examen_id)');
        $this->addSql('CREATE INDEX IDX_C4E1ECCD1E27F6BF ON reponses_etudiant (question_id)');
        $this->addSql('CREATE INDEX IDX_C4E1ECCD32B5E779 ON reponses_etudiant (suggestions_id)');
        $this->addSql('ALTER TABLE suggestions ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suggestions ADD CONSTRAINT FK_91B686141E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_91B686141E27F6BF ON suggestions (question_id)');
        $this->addSql('ALTER TABLE user ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498F5EA509 ON user (classe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF46CD258');
        $this->addSql('DROP INDEX IDX_FDCA8C9CF46CD258 ON cours');
        $this->addSql('ALTER TABLE cours DROP matiere_id');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FECF46CD258');
        $this->addSql('DROP INDEX IDX_514C8FECF46CD258 ON examen');
        $this->addSql('ALTER TABLE examen DROP matiere_id');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A8F5EA509');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574AE455FCC0');
        $this->addSql('DROP INDEX IDX_9014574A8F5EA509 ON matiere');
        $this->addSql('DROP INDEX IDX_9014574AE455FCC0 ON matiere');
        $this->addSql('ALTER TABLE matiere DROP classe_id, DROP enseignant_id');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E5C8659A');
        $this->addSql('DROP INDEX IDX_B6F7494E5C8659A ON question');
        $this->addSql('ALTER TABLE question DROP examen_id');
        $this->addSql('ALTER TABLE reponses_etudiant DROP FOREIGN KEY FK_C4E1ECCDDDEAB1A3');
        $this->addSql('ALTER TABLE reponses_etudiant DROP FOREIGN KEY FK_C4E1ECCD5C8659A');
        $this->addSql('ALTER TABLE reponses_etudiant DROP FOREIGN KEY FK_C4E1ECCD1E27F6BF');
        $this->addSql('ALTER TABLE reponses_etudiant DROP FOREIGN KEY FK_C4E1ECCD32B5E779');
        $this->addSql('DROP INDEX IDX_C4E1ECCDDDEAB1A3 ON reponses_etudiant');
        $this->addSql('DROP INDEX IDX_C4E1ECCD5C8659A ON reponses_etudiant');
        $this->addSql('DROP INDEX IDX_C4E1ECCD1E27F6BF ON reponses_etudiant');
        $this->addSql('DROP INDEX IDX_C4E1ECCD32B5E779 ON reponses_etudiant');
        $this->addSql('ALTER TABLE reponses_etudiant DROP etudiant_id, DROP examen_id, DROP question_id, DROP suggestions_id');
        $this->addSql('ALTER TABLE suggestions DROP FOREIGN KEY FK_91B686141E27F6BF');
        $this->addSql('DROP INDEX IDX_91B686141E27F6BF ON suggestions');
        $this->addSql('ALTER TABLE suggestions DROP question_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498F5EA509');
        $this->addSql('DROP INDEX IDX_8D93D6498F5EA509 ON user');
        $this->addSql('ALTER TABLE user DROP classe_id');
    }
}
