<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211015434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `add` (id INT AUTO_INCREMENT NOT NULL, localisation_id_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, creation_date DATETIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, place_number INT DEFAULT NULL, activate TINYINT(1) DEFAULT NULL, INDEX IDX_FD1A73E7B65C2D26 (localisation_id_id), INDEX IDX_FD1A73E79D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, localisation_id_id INT DEFAULT NULL, title_event VARCHAR(255) DEFAULT NULL, date_event DATETIME DEFAULT NULL, desc_event LONGTEXT DEFAULT NULL, img_event VARCHAR(255) DEFAULT NULL, INDEX IDX_3BAE0AA7B65C2D26 (localisation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participate (id INT AUTO_INCREMENT NOT NULL, add_id_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, rdv_date DATETIME DEFAULT NULL, message LONGTEXT DEFAULT NULL, confirm TINYINT(1) DEFAULT NULL, INDEX IDX_D02B138C2F79496 (add_id_id), INDEX IDX_D02B1389D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `add` ADD CONSTRAINT FK_FD1A73E7B65C2D26 FOREIGN KEY (localisation_id_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE `add` ADD CONSTRAINT FK_FD1A73E79D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B65C2D26 FOREIGN KEY (localisation_id_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE participate ADD CONSTRAINT FK_D02B138C2F79496 FOREIGN KEY (add_id_id) REFERENCES `add` (id)');
        $this->addSql('ALTER TABLE participate ADD CONSTRAINT FK_D02B1389D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `add` DROP FOREIGN KEY FK_FD1A73E7B65C2D26');
        $this->addSql('ALTER TABLE `add` DROP FOREIGN KEY FK_FD1A73E79D86650F');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7B65C2D26');
        $this->addSql('ALTER TABLE participate DROP FOREIGN KEY FK_D02B138C2F79496');
        $this->addSql('ALTER TABLE participate DROP FOREIGN KEY FK_D02B1389D86650F');
        $this->addSql('DROP TABLE `add`');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE participate');
    }
}
