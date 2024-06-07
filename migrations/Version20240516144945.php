<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516144945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE producto_categoria (producto_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_B881A7077645698E (producto_id), INDEX IDX_B881A7073397707A (categoria_id), PRIMARY KEY(producto_id, categoria_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE producto_categoria ADD CONSTRAINT FK_B881A7077645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producto_categoria ADD CONSTRAINT FK_B881A7073397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto_categoria DROP FOREIGN KEY FK_B881A7077645698E');
        $this->addSql('ALTER TABLE producto_categoria DROP FOREIGN KEY FK_B881A7073397707A');
        $this->addSql('DROP TABLE producto_categoria');
    }
}
