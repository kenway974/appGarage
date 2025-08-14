<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250814192223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_car_id INT DEFAULT NULL, datetime DATETIME NOT NULL, status VARCHAR(25) NOT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FE38F844A76ED395 (user_id), INDEX IDX_FE38F844A694EDA2 (user_car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment_service_price (appointment_id INT NOT NULL, service_price_id INT NOT NULL, INDEX IDX_1DF27194E5B533F9 (appointment_id), INDEX IDX_1DF271942F629CDA (service_price_id), PRIMARY KEY(appointment_id, service_price_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(25) NOT NULL, brand_logo VARCHAR(255) DEFAULT NULL, model VARCHAR(25) NOT NULL, year INT NOT NULL, fuel VARCHAR(25) NOT NULL, transmission VARCHAR(25) NOT NULL, engine_displacement DOUBLE PRECISION DEFAULT NULL, horsepower INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, subject VARCHAR(25) NOT NULL, message LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, status VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4C62E638A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, reference VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, min_price DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, category VARCHAR(25) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece_car (piece_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_C420AA1BC40FCFA8 (piece_id), INDEX IDX_C420AA1BC3C6F69F (car_id), PRIMARY KEY(piece_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, items JSON NOT NULL COMMENT \'(DC2Type:json)\', price_ht DOUBLE PRECISION DEFAULT NULL, price_ttc DOUBLE PRECISION NOT NULL, prices_ht JSON NOT NULL COMMENT \'(DC2Type:json)\', prices_ttc JSON NOT NULL COMMENT \'(DC2Type:json)\', total_ht DOUBLE PRECISION NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, valid_until DATETIME NOT NULL, status VARCHAR(25) NOT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6B71CBF4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, min_price DOUBLE PRECISION NOT NULL, category VARCHAR(25) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_price (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_price_service (service_price_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_5A04E80C2F629CDA (service_price_id), INDEX IDX_5A04E80CED5CA9E6 (service_id), PRIMARY KEY(service_price_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_price_car (service_price_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_7AC0D7582F629CDA (service_price_id), INDEX IDX_7AC0D758C3C6F69F (car_id), PRIMARY KEY(service_price_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_price_piece (service_price_id INT NOT NULL, piece_id INT NOT NULL, INDEX IDX_A39925EF2F629CDA (service_price_id), INDEX IDX_A39925EFC40FCFA8 (piece_id), PRIMARY KEY(service_price_id, piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(25) NOT NULL, last_name VARCHAR(25) NOT NULL, phone_number VARCHAR(25) NOT NULL, postal_code VARCHAR(5) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_client TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_car (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, car_id INT NOT NULL, plate_number VARCHAR(25) NOT NULL, vin VARCHAR(255) DEFAULT NULL, mileage INT NOT NULL, purchase_date DATE DEFAULT NULL, last_service_date DATE DEFAULT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_9C2B8716A76ED395 (user_id), INDEX IDX_9C2B8716C3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844A694EDA2 FOREIGN KEY (user_car_id) REFERENCES user_car (id)');
        $this->addSql('ALTER TABLE appointment_service_price ADD CONSTRAINT FK_1DF27194E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_service_price ADD CONSTRAINT FK_1DF271942F629CDA FOREIGN KEY (service_price_id) REFERENCES service_price (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE piece_car ADD CONSTRAINT FK_C420AA1BC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_car ADD CONSTRAINT FK_C420AA1BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE service_price_service ADD CONSTRAINT FK_5A04E80C2F629CDA FOREIGN KEY (service_price_id) REFERENCES service_price (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_price_service ADD CONSTRAINT FK_5A04E80CED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_price_car ADD CONSTRAINT FK_7AC0D7582F629CDA FOREIGN KEY (service_price_id) REFERENCES service_price (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_price_car ADD CONSTRAINT FK_7AC0D758C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_price_piece ADD CONSTRAINT FK_A39925EF2F629CDA FOREIGN KEY (service_price_id) REFERENCES service_price (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_price_piece ADD CONSTRAINT FK_A39925EFC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_car ADD CONSTRAINT FK_9C2B8716A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_car ADD CONSTRAINT FK_9C2B8716C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844A76ED395');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844A694EDA2');
        $this->addSql('ALTER TABLE appointment_service_price DROP FOREIGN KEY FK_1DF27194E5B533F9');
        $this->addSql('ALTER TABLE appointment_service_price DROP FOREIGN KEY FK_1DF271942F629CDA');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A76ED395');
        $this->addSql('ALTER TABLE piece_car DROP FOREIGN KEY FK_C420AA1BC40FCFA8');
        $this->addSql('ALTER TABLE piece_car DROP FOREIGN KEY FK_C420AA1BC3C6F69F');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF4A76ED395');
        $this->addSql('ALTER TABLE service_price_service DROP FOREIGN KEY FK_5A04E80C2F629CDA');
        $this->addSql('ALTER TABLE service_price_service DROP FOREIGN KEY FK_5A04E80CED5CA9E6');
        $this->addSql('ALTER TABLE service_price_car DROP FOREIGN KEY FK_7AC0D7582F629CDA');
        $this->addSql('ALTER TABLE service_price_car DROP FOREIGN KEY FK_7AC0D758C3C6F69F');
        $this->addSql('ALTER TABLE service_price_piece DROP FOREIGN KEY FK_A39925EF2F629CDA');
        $this->addSql('ALTER TABLE service_price_piece DROP FOREIGN KEY FK_A39925EFC40FCFA8');
        $this->addSql('ALTER TABLE user_car DROP FOREIGN KEY FK_9C2B8716A76ED395');
        $this->addSql('ALTER TABLE user_car DROP FOREIGN KEY FK_9C2B8716C3C6F69F');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE appointment_service_price');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE piece_car');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_price');
        $this->addSql('DROP TABLE service_price_service');
        $this->addSql('DROP TABLE service_price_car');
        $this->addSql('DROP TABLE service_price_piece');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_car');
    }
}
