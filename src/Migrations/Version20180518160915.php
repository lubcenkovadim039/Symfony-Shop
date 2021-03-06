<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180518160915 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderitem DROP FOREIGN KEY FK_112B7384CFFE9AD6');
        $this->addSql('ALTER TABLE orderitem ADD CONSTRAINT FK_112B7384CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderitem DROP FOREIGN KEY FK_112B7384CFFE9AD6');
        $this->addSql('ALTER TABLE orderitem ADD CONSTRAINT FK_112B7384CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
    }
}
