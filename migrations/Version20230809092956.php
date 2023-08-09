<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809092956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE platform ADD COLUMN image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE platform ADD COLUMN image_size INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE platform ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN image_size INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__platform AS SELECT id, name FROM platform');
        $this->addSql('DROP TABLE platform');
        $this->addSql('CREATE TABLE platform (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO platform (id, name) SELECT id, name FROM __temp__platform');
        $this->addSql('DROP TABLE __temp__platform');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3952D0CB5E237E06 ON platform (name)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, released_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(5) NOT NULL, trailer VARCHAR(255) DEFAULT NULL, synopsis CLOB DEFAULT NULL, animation BOOLEAN NOT NULL, duration SMALLINT DEFAULT NULL, chronological SMALLINT NOT NULL, logical SMALLINT NOT NULL)');
        $this->addSql('INSERT INTO product (id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical) SELECT id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }
}
