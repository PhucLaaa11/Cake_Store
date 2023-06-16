<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616040147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_detail (id INT AUTO_INCREMENT NOT NULL, quantity VARCHAR(255) NOT NULL, discount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_detail_customer (cart_detail_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_E91E12222E2424 (cart_detail_id), INDEX IDX_E91E1229395C3F3 (customer_id), PRIMARY KEY(cart_detail_id, customer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, cart_detail_id INT NOT NULL, name VARCHAR(255) NOT NULL, maintaste VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, quantity VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD2ADD6D8C (supplier_id), INDEX IDX_D34A04AD22E2424 (cart_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_detail_customer ADD CONSTRAINT FK_E91E12222E2424 FOREIGN KEY (cart_detail_id) REFERENCES cart_detail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_detail_customer ADD CONSTRAINT FK_E91E1229395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD22E2424 FOREIGN KEY (cart_detail_id) REFERENCES cart_detail (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_detail_customer DROP FOREIGN KEY FK_E91E12222E2424');
        $this->addSql('ALTER TABLE cart_detail_customer DROP FOREIGN KEY FK_E91E1229395C3F3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD2ADD6D8C');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD22E2424');
        $this->addSql('DROP TABLE cart_detail');
        $this->addSql('DROP TABLE cart_detail_customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE supplier');
    }
}
