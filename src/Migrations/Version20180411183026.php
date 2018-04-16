<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411183026 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD first_name VARCHAR(100) NOT NULL, ADD last_name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE orderitem RENAME INDEX idx_112b7384cffe9ad6 TO IDX_B119DCBACFFE9AD6');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderItem RENAME INDEX idx_b119dcbacffe9ad6 TO IDX_112B7384CFFE9AD6');
        $this->addSql('ALTER TABLE users DROP first_name, DROP last_name');
    }
}
