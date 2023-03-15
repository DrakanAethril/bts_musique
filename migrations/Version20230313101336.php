<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313101336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lessons_slots_users (lessons_slots_id INT NOT NULL, users_id INT NOT NULL, PRIMARY KEY(lessons_slots_id, users_id))');
        $this->addSql('CREATE INDEX IDX_7EFFD20C113CEEF ON lessons_slots_users (lessons_slots_id)');
        $this->addSql('CREATE INDEX IDX_7EFFD20C67B3B43D ON lessons_slots_users (users_id)');
        $this->addSql('ALTER TABLE lessons_slots_users ADD CONSTRAINT FK_7EFFD20C113CEEF FOREIGN KEY (lessons_slots_id) REFERENCES lessons_slots (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lessons_slots_users ADD CONSTRAINT FK_7EFFD20C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE lessons_slots_users DROP CONSTRAINT FK_7EFFD20C113CEEF');
        $this->addSql('ALTER TABLE lessons_slots_users DROP CONSTRAINT FK_7EFFD20C67B3B43D');
        $this->addSql('DROP TABLE lessons_slots_users');
    }
}
