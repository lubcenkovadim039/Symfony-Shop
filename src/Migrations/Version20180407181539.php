<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180407181539 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, data DATE DEFAULT NULL, status_orders LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', status TINYINT(1) DEFAULT \'0\' NOT NULL, users VARCHAR(255) DEFAULT NULL, summa_orders NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orderItems (id INT AUTO_INCREMENT NOT NULL, orders_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL, quantity_of_order INT NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, total NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_300B8C45CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orderItems ADD CONSTRAINT FK_300B8C45CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderItems DROP FOREIGN KEY FK_300B8C45CFFE9AD6');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orderItems');
    }
}
