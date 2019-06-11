<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190611005832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE badges (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_78F6539AC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blessures (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, effet LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encyclopedie_categories (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT DEFAULT NULL, couverture VARCHAR(255) NOT NULL, ordre SMALLINT NOT NULL, date_creation DATETIME NOT NULL, droit_acces VARCHAR(75) NOT NULL, slug VARCHAR(255) NOT NULL, visible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encyclopedie_posts (id INT AUTO_INCREMENT NOT NULL, id_encyclopedie_sujet_id INT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT DEFAULT NULL, ordre SMALLINT NOT NULL, date_creation DATETIME NOT NULL, visible TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_65916582636AB030 (id_encyclopedie_sujet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encyclopedie_sujets (id INT AUTO_INCREMENT NOT NULL, id_enclyclopedie_categorie_id INT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT DEFAULT NULL, ordre SMALLINT NOT NULL, date_creation DATETIME NOT NULL, visible TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_CBAD067A6522E0BE (id_enclyclopedie_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forums_categories (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT DEFAULT NULL, ordre SMALLINT NOT NULL, date_creation DATETIME NOT NULL, droit_acces VARCHAR(75) NOT NULL, slug VARCHAR(255) NOT NULL, visible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forums_historiques (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, description VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forums_posts (id INT AUTO_INCREMENT NOT NULL, id_forum_sujet_id INT NOT NULL, titre VARCHAR(75) NOT NULL, message LONGTEXT NOT NULL, ordre SMALLINT NOT NULL, date_creation DATETIME NOT NULL, derniere_edition DATETIME DEFAULT NULL, visible TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_12D7365F66D8799F (id_forum_sujet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forums_sujets (id INT AUTO_INCREMENT NOT NULL, id_forum_categorie_id INT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT DEFAULT NULL, ordre SMALLINT NOT NULL, date_creation DATETIME NOT NULL, droit_acces VARCHAR(75) NOT NULL, visible TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_33B8EE40709A3C5 (id_forum_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnages (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, races_id INT NOT NULL, classes_id INT NOT NULL, blessures_id INT NOT NULL, competences_id INT NOT NULL, sorts_id INT NOT NULL, nom VARCHAR(75) NOT NULL, prenom VARCHAR(75) NOT NULL, sexe SMALLINT NOT NULL, image VARCHAR(255) DEFAULT NULL, portrait VARCHAR(255) DEFAULT NULL, biographie LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_286738A6C6EE5C49 (id_utilisateur_id), INDEX IDX_286738A699AE984C (races_id), INDEX IDX_286738A69E225B24 (classes_id), INDEX IDX_286738A670AF2E7B (blessures_id), INDEX IDX_286738A6A660B158 (competences_id), INDEX IDX_286738A690318C83 (sorts_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE races (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sorts (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(75) NOT NULL, prenom VARCHAR(75) NOT NULL, pseudo VARCHAR(75) NOT NULL, mdp VARCHAR(255) NOT NULL, email VARCHAR(75) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, rang VARCHAR(75) NOT NULL, naissance DATE NOT NULL, messages INT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE badges ADD CONSTRAINT FK_78F6539AC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE encyclopedie_posts ADD CONSTRAINT FK_65916582636AB030 FOREIGN KEY (id_encyclopedie_sujet_id) REFERENCES encyclopedie_sujets (id)');
        $this->addSql('ALTER TABLE encyclopedie_sujets ADD CONSTRAINT FK_CBAD067A6522E0BE FOREIGN KEY (id_enclyclopedie_categorie_id) REFERENCES encyclopedie_categories (id)');
        $this->addSql('ALTER TABLE forums_posts ADD CONSTRAINT FK_12D7365F66D8799F FOREIGN KEY (id_forum_sujet_id) REFERENCES forums_sujets (id)');
        $this->addSql('ALTER TABLE forums_sujets ADD CONSTRAINT FK_33B8EE40709A3C5 FOREIGN KEY (id_forum_categorie_id) REFERENCES forums_categories (id)');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A6C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A699AE984C FOREIGN KEY (races_id) REFERENCES races (id)');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A69E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A670AF2E7B FOREIGN KEY (blessures_id) REFERENCES blessures (id)');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A6A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id)');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A690318C83 FOREIGN KEY (sorts_id) REFERENCES sorts (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A670AF2E7B');
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A69E225B24');
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A6A660B158');
        $this->addSql('ALTER TABLE encyclopedie_sujets DROP FOREIGN KEY FK_CBAD067A6522E0BE');
        $this->addSql('ALTER TABLE encyclopedie_posts DROP FOREIGN KEY FK_65916582636AB030');
        $this->addSql('ALTER TABLE forums_sujets DROP FOREIGN KEY FK_33B8EE40709A3C5');
        $this->addSql('ALTER TABLE forums_posts DROP FOREIGN KEY FK_12D7365F66D8799F');
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A699AE984C');
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A690318C83');
        $this->addSql('ALTER TABLE badges DROP FOREIGN KEY FK_78F6539AC6EE5C49');
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A6C6EE5C49');
        $this->addSql('DROP TABLE badges');
        $this->addSql('DROP TABLE blessures');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE encyclopedie_categories');
        $this->addSql('DROP TABLE encyclopedie_posts');
        $this->addSql('DROP TABLE encyclopedie_sujets');
        $this->addSql('DROP TABLE forums_categories');
        $this->addSql('DROP TABLE forums_historiques');
        $this->addSql('DROP TABLE forums_posts');
        $this->addSql('DROP TABLE forums_sujets');
        $this->addSql('DROP TABLE personnages');
        $this->addSql('DROP TABLE races');
        $this->addSql('DROP TABLE sorts');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
