<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120111234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_distributeur (product_id INT NOT NULL, distributeur_id INT NOT NULL, PRIMARY KEY(product_id, distributeur_id))');
        $this->addSql('CREATE INDEX IDX_84DA4A1A4584665A ON product_distributeur (product_id)');
        $this->addSql('CREATE INDEX IDX_84DA4A1A29EB7ACA ON product_distributeur (distributeur_id)');
        $this->addSql('ALTER TABLE product_distributeur ADD CONSTRAINT FK_84DA4A1A4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_distributeur ADD CONSTRAINT FK_84DA4A1A29EB7ACA FOREIGN KEY (distributeur_id) REFERENCES distributeur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_distributeur DROP CONSTRAINT FK_84DA4A1A4584665A');
        $this->addSql('ALTER TABLE product_distributeur DROP CONSTRAINT FK_84DA4A1A29EB7ACA');
        $this->addSql('DROP TABLE product_distributeur');
    }
}
