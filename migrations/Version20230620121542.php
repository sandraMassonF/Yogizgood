<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620121542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session ADD kind_id INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D430602CA9 FOREIGN KEY (kind_id) REFERENCES kind (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D430602CA9 ON session (kind_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D430602CA9');
        $this->addSql('DROP INDEX IDX_D044D5D430602CA9 ON session');
        $this->addSql('ALTER TABLE session DROP kind_id');
    }
}
