<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220127124016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liturgy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE song_liturgy (song_id INT NOT NULL, liturgy_id INT NOT NULL, INDEX IDX_F7492835A0BDB2F3 (song_id), INDEX IDX_F7492835AC142F32 (liturgy_id), PRIMARY KEY(song_id, liturgy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE song_liturgy ADD CONSTRAINT FK_F7492835A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE song_liturgy ADD CONSTRAINT FK_F7492835AC142F32 FOREIGN KEY (liturgy_id) REFERENCES liturgy (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE song_liturgy DROP FOREIGN KEY FK_F7492835AC142F32');
        $this->addSql('DROP TABLE liturgy');
        $this->addSql('DROP TABLE song_liturgy');
    }
}
