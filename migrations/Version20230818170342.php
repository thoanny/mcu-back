<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230818170342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_937AB0345E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, title VARCHAR(255) NOT NULL, duration SMALLINT NOT NULL, number SMALLINT NOT NULL, INDEX IDX_DDAA1CDA4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_3952D0CB5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, released_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', type VARCHAR(5) NOT NULL, trailer VARCHAR(255) DEFAULT NULL, synopsis LONGTEXT DEFAULT NULL, animation TINYINT(1) NOT NULL, duration SMALLINT DEFAULT NULL, chronological SMALLINT NOT NULL, logical SMALLINT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_character (product_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_FDDA06B94584665A (product_id), INDEX IDX_FDDA06B91136BE75 (character_id), PRIMARY KEY(product_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_login_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vod (id INT AUTO_INCREMENT NOT NULL, platform_id INT NOT NULL, product_id INT NOT NULL, url VARCHAR(255) NOT NULL, type VARCHAR(3) NOT NULL, INDEX IDX_7871FD9FFE6496F (platform_id), INDEX IDX_7871FD94584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_character ADD CONSTRAINT FK_FDDA06B94584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_character ADD CONSTRAINT FK_FDDA06B91136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vod ADD CONSTRAINT FK_7871FD9FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE vod ADD CONSTRAINT FK_7871FD94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA4584665A');
        $this->addSql('ALTER TABLE product_character DROP FOREIGN KEY FK_FDDA06B94584665A');
        $this->addSql('ALTER TABLE product_character DROP FOREIGN KEY FK_FDDA06B91136BE75');
        $this->addSql('ALTER TABLE vod DROP FOREIGN KEY FK_7871FD9FFE6496F');
        $this->addSql('ALTER TABLE vod DROP FOREIGN KEY FK_7871FD94584665A');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_character');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vod');
    }
}
