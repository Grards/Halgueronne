<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904111057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, races_id INT NOT NULL, classes_id INT NOT NULL, lastname VARCHAR(75) NOT NULL, firstname VARCHAR(75) NOT NULL, gender VARCHAR(1) NOT NULL, picture VARCHAR(255) NOT NULL, birth_day SMALLINT DEFAULT NULL, birth_month SMALLINT DEFAULT NULL, birth_year SMALLINT DEFAULT NULL, death_day SMALLINT DEFAULT NULL, death_month SMALLINT DEFAULT NULL, death_year SMALLINT DEFAULT NULL, background LONGTEXT NOT NULL, slug VARCHAR(255) DEFAULT NULL, INDEX IDX_3A29410EA76ED395 (user_id), INDEX IDX_3A29410E99AE984C (races_id), INDEX IDX_3A29410E9E225B24 (classes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encyclopedia_categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, cover VARCHAR(255) NOT NULL, order_number SMALLINT NOT NULL, visible TINYINT(1) NOT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encyclopedia_posts (id INT AUTO_INCREMENT NOT NULL, encyclopedia_topic_id INT NOT NULL, author_id INT NOT NULL, title VARCHAR(100) NOT NULL, creation_date DATETIME NOT NULL, update_date DATETIME NOT NULL, visible TINYINT(1) NOT NULL, slug VARCHAR(255) DEFAULT NULL, post LONGTEXT NOT NULL, INDEX IDX_91DE4191D82EEE09 (encyclopedia_topic_id), INDEX IDX_91DE4191F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encyclopedia_topics (id INT AUTO_INCREMENT NOT NULL, encyclopedia_category_id INT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, order_number SMALLINT NOT NULL, visible TINYINT(1) NOT NULL, slug VARCHAR(255) DEFAULT NULL, INDEX IDX_4B8F7D12A38A821D (encyclopedia_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE injuries (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE injuries_characters (injuries_id INT NOT NULL, characters_id INT NOT NULL, INDEX IDX_8B6BD3884799CDA1 (injuries_id), INDEX IDX_8B6BD388C70F0E28 (characters_id), PRIMARY KEY(injuries_id, characters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE races (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills_characters (skills_id INT NOT NULL, characters_id INT NOT NULL, INDEX IDX_FA47BEC37FF61858 (skills_id), INDEX IDX_FA47BEC3C70F0E28 (characters_id), PRIMARY KEY(skills_id, characters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spells (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spells_characters (spells_id INT NOT NULL, characters_id INT NOT NULL, INDEX IDX_34E020499875F51 (spells_id), INDEX IDX_34E0204C70F0E28 (characters_id), PRIMARY KEY(spells_id, characters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(75) NOT NULL, password VARCHAR(255) NOT NULL, mail VARCHAR(75) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, role VARCHAR(75) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, posts INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E99AE984C FOREIGN KEY (races_id) REFERENCES races (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E9E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE encyclopedia_posts ADD CONSTRAINT FK_91DE4191D82EEE09 FOREIGN KEY (encyclopedia_topic_id) REFERENCES encyclopedia_topics (id)');
        $this->addSql('ALTER TABLE encyclopedia_posts ADD CONSTRAINT FK_91DE4191F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE encyclopedia_topics ADD CONSTRAINT FK_4B8F7D12A38A821D FOREIGN KEY (encyclopedia_category_id) REFERENCES encyclopedia_categories (id)');
        $this->addSql('ALTER TABLE injuries_characters ADD CONSTRAINT FK_8B6BD3884799CDA1 FOREIGN KEY (injuries_id) REFERENCES injuries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE injuries_characters ADD CONSTRAINT FK_8B6BD388C70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skills_characters ADD CONSTRAINT FK_FA47BEC37FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skills_characters ADD CONSTRAINT FK_FA47BEC3C70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spells_characters ADD CONSTRAINT FK_34E020499875F51 FOREIGN KEY (spells_id) REFERENCES spells (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spells_characters ADD CONSTRAINT FK_34E0204C70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE injuries_characters DROP FOREIGN KEY FK_8B6BD388C70F0E28');
        $this->addSql('ALTER TABLE skills_characters DROP FOREIGN KEY FK_FA47BEC3C70F0E28');
        $this->addSql('ALTER TABLE spells_characters DROP FOREIGN KEY FK_34E0204C70F0E28');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E9E225B24');
        $this->addSql('ALTER TABLE encyclopedia_topics DROP FOREIGN KEY FK_4B8F7D12A38A821D');
        $this->addSql('ALTER TABLE encyclopedia_posts DROP FOREIGN KEY FK_91DE4191D82EEE09');
        $this->addSql('ALTER TABLE injuries_characters DROP FOREIGN KEY FK_8B6BD3884799CDA1');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E99AE984C');
        $this->addSql('ALTER TABLE skills_characters DROP FOREIGN KEY FK_FA47BEC37FF61858');
        $this->addSql('ALTER TABLE spells_characters DROP FOREIGN KEY FK_34E020499875F51');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EA76ED395');
        $this->addSql('ALTER TABLE encyclopedia_posts DROP FOREIGN KEY FK_91DE4191F675F31B');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE encyclopedia_categories');
        $this->addSql('DROP TABLE encyclopedia_posts');
        $this->addSql('DROP TABLE encyclopedia_topics');
        $this->addSql('DROP TABLE injuries');
        $this->addSql('DROP TABLE injuries_characters');
        $this->addSql('DROP TABLE races');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE skills_characters');
        $this->addSql('DROP TABLE spells');
        $this->addSql('DROP TABLE spells_characters');
        $this->addSql('DROP TABLE users');
    }
}
