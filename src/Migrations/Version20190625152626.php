<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625152626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(75) NOT NULL, password VARCHAR(255) NOT NULL, mail VARCHAR(75) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, role VARCHAR(75) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, lastname VARCHAR(75) NOT NULL, firstname VARCHAR(75) NOT NULL, gender VARCHAR(1) NOT NULL, picture VARCHAR(255) NOT NULL, birth_day SMALLINT DEFAULT NULL, birth_month SMALLINT DEFAULT NULL, birth_year SMALLINT DEFAULT NULL, death_day SMALLINT DEFAULT NULL, death_month SMALLINT DEFAULT NULL, death_year SMALLINT DEFAULT NULL, background LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_3A29410EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EA76ED395');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE characters');
    }
}
