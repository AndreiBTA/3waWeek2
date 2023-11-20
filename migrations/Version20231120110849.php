<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120110849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add distributeur key to product';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_distributeur DROP CONSTRAINT fk_84da4a1a4584665a');
        $this->addSql('ALTER TABLE product_distributeur DROP CONSTRAINT fk_84da4a1a29eb7aca');
        $this->addSql('DROP TABLE product_distributeur');
        $this->addSql('ALTER TABLE product ADD reference_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD1645DEA9 ON product (reference_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE product_distributeur (product_id INT NOT NULL, distributeur_id INT NOT NULL, PRIMARY KEY(product_id, distributeur_id))');
        $this->addSql('CREATE INDEX idx_84da4a1a29eb7aca ON product_distributeur (distributeur_id)');
        $this->addSql('CREATE INDEX idx_84da4a1a4584665a ON product_distributeur (product_id)');
        $this->addSql('ALTER TABLE product_distributeur ADD CONSTRAINT fk_84da4a1a4584665a FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_distributeur ADD CONSTRAINT fk_84da4a1a29eb7aca FOREIGN KEY (distributeur_id) REFERENCES distributeur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD1645DEA9');
        $this->addSql('DROP INDEX UNIQ_D34A04AD1645DEA9');
        $this->addSql('ALTER TABLE product DROP reference_id');
    }
}
