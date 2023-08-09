<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809100106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__platform AS SELECT id, name, image_name, image_size, updated_at FROM platform');
        $this->addSql('DROP TABLE platform');
        $this->addSql('CREATE TABLE platform (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INTEGER DEFAULT NULL, updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO platform (id, name, image_name, image_size, updated_at) SELECT id, name, image_name, image_size, updated_at FROM __temp__platform');
        $this->addSql('DROP TABLE __temp__platform');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3952D0CB5E237E06 ON platform (name)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical, image_name, image_size, updated_at FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, released_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(5) NOT NULL, trailer VARCHAR(255) DEFAULT NULL, synopsis CLOB DEFAULT NULL, animation BOOLEAN NOT NULL, duration SMALLINT DEFAULT NULL, chronological SMALLINT NOT NULL, logical SMALLINT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INTEGER DEFAULT NULL, updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO product (id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical, image_name, image_size, updated_at) SELECT id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical, image_name, image_size, updated_at FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('ALTER TABLE user ADD COLUMN is_verified BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__platform AS SELECT id, name, image_name, image_size, updated_at FROM platform');
        $this->addSql('DROP TABLE platform');
        $this->addSql('CREATE TABLE platform (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INTEGER DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO platform (id, name, image_name, image_size, updated_at) SELECT id, name, image_name, image_size, updated_at FROM __temp__platform');
        $this->addSql('DROP TABLE __temp__platform');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3952D0CB5E237E06 ON platform (name)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical, image_name, image_size, updated_at FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, released_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , type VARCHAR(5) NOT NULL, trailer VARCHAR(255) DEFAULT NULL, synopsis CLOB DEFAULT NULL, animation BOOLEAN NOT NULL, duration SMALLINT DEFAULT NULL, chronological SMALLINT NOT NULL, logical SMALLINT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INTEGER DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO product (id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical, image_name, image_size, updated_at) SELECT id, title, released_at, type, trailer, synopsis, animation, duration, chronological, logical, image_name, image_size, updated_at FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, created_at, last_login_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , last_login_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO user (id, email, roles, password, created_at, last_login_at) SELECT id, email, roles, password, created_at, last_login_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
