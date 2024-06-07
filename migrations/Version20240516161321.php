<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516161321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entrada (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, fecha_entrada DATETIME NOT NULL, ocurrencia LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE entrada_item (id INT AUTO_INCREMENT NOT NULL, cantidad INT NOT NULL, entrada_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_CC7D18CCA688222A (entrada_id), INDEX IDX_CC7D18CC7645698E (producto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE entrada_item ADD CONSTRAINT FK_CC7D18CCA688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id)');
        $this->addSql('ALTER TABLE entrada_item ADD CONSTRAINT FK_CC7D18CC7645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrada_item DROP FOREIGN KEY FK_CC7D18CCA688222A');
        $this->addSql('ALTER TABLE entrada_item DROP FOREIGN KEY FK_CC7D18CC7645698E');
        $this->addSql('DROP TABLE entrada');
        $this->addSql('DROP TABLE entrada_item');
    }
}
