<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620122150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase ADD user_id INT NOT NULL, ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_6117D13BA76ED395 ON purchase (user_id)');
        $this->addSql('CREATE INDEX IDX_6117D13B4584665A ON purchase (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BA76ED395');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B4584665A');
        $this->addSql('DROP INDEX IDX_6117D13BA76ED395 ON purchase');
        $this->addSql('DROP INDEX IDX_6117D13B4584665A ON purchase');
        $this->addSql('ALTER TABLE purchase DROP user_id, DROP product_id');
    }
}
