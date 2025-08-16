<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250815173627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, country VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, car_id INT NOT NULL, name VARCHAR(255) NOT NULL, release_year INT NOT NULL, discontinued_year INT NOT NULL, category VARCHAR(25) NOT NULL, fuel VARCHAR(25) NOT NULL, horsepower INT DEFAULT NULL, transmission VARCHAR(25) DEFAULT NULL, drive_type VARCHAR(25) NOT NULL, INDEX IDX_D79572D944F5D008 (brand_id), INDEX IDX_D79572D9C3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE car DROP brand, DROP brand_logo, DROP fuel, DROP transmission, DROP engine_displacement, DROP years, DROP generation, CHANGE horsepower brand_id INT DEFAULT NULL, CHANGE model name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_773DE69D44F5D008 ON car (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D44F5D008');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9C3C6F69F');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP INDEX IDX_773DE69D44F5D008 ON car');
        $this->addSql('ALTER TABLE car ADD brand VARCHAR(25) NOT NULL, ADD brand_logo VARCHAR(255) DEFAULT NULL, ADD fuel VARCHAR(25) NOT NULL, ADD transmission VARCHAR(25) NOT NULL, ADD engine_displacement DOUBLE PRECISION DEFAULT NULL, ADD years VARCHAR(10) NOT NULL, ADD generation JSON NOT NULL COMMENT \'(DC2Type:json)\', CHANGE name model VARCHAR(255) NOT NULL, CHANGE brand_id horsepower INT DEFAULT NULL');
    }
}
