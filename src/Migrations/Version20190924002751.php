<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190924002751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE timelines (id INT AUTO_INCREMENT NOT NULL, timeline_category_id INT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, year INT NOT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_BF99F5A06185C660 (timeline_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timelines_categories (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(100) NOT NULL, picture VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE timelines ADD CONSTRAINT FK_BF99F5A06185C660 FOREIGN KEY (timeline_category_id) REFERENCES timelines_categories (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE timelines DROP FOREIGN KEY FK_BF99F5A06185C660');
        $this->addSql('DROP TABLE timelines');
        $this->addSql('DROP TABLE timelines_categories');
    }
}
