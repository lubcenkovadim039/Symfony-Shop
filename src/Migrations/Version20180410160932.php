<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180410160932 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, orders_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL, quantity_of_order INT NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, total NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_52EA1F09CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('DROP TABLE orderItems');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE orderItems (id INT AUTO_INCREMENT NOT NULL, orders_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantity_of_order INT NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, total NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_300B8C45CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orderItems ADD CONSTRAINT FK_300B8C45CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('DROP TABLE order_item');
    }
}
