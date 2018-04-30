<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425184309 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders ADD is_paid TINYINT(1) DEFAULT \'0\' NOT NULL, DROP status_orders, CHANGE status status VARCHAR(255) DEFAULT NULL, CHANGE data create_at DATE DEFAULT NULL, CHANGE summa_orders amout NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE orderitem ADD product_id INT DEFAULT NULL, DROP product');
        $this->addSql('ALTER TABLE orderitem ADD CONSTRAINT FK_B119DCBA4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_B119DCBA4584665A ON orderitem (product_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderItem DROP FOREIGN KEY FK_B119DCBA4584665A');
        $this->addSql('DROP INDEX IDX_B119DCBA4584665A ON orderItem');
        $this->addSql('ALTER TABLE orderItem ADD product VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP product_id');
        $this->addSql('ALTER TABLE orders ADD status_orders VARCHAR(255) DEFAULT \'new\' COLLATE utf8mb4_unicode_ci, DROP is_paid, CHANGE status status TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE create_at data DATE DEFAULT NULL, CHANGE amout summa_orders NUMERIC(10, 2) DEFAULT NULL');
    }
}
