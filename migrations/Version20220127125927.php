<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220127125927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, held DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_song (id INT AUTO_INCREMENT NOT NULL, song_id INT NOT NULL, liturgy_id INT DEFAULT NULL, sequence INT NOT NULL, INDEX IDX_FDAE5A4DA0BDB2F3 (song_id), INDEX IDX_FDAE5A4DAC142F32 (liturgy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_song ADD CONSTRAINT FK_FDAE5A4DA0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('ALTER TABLE service_song ADD CONSTRAINT FK_FDAE5A4DAC142F32 FOREIGN KEY (liturgy_id) REFERENCES liturgy (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_song');
    }
}
