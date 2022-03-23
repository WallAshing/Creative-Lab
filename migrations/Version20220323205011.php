<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323205011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, personal_email VARCHAR(255) DEFAULT NULL, discord_tag VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, UNIQUE INDEX UNIQ_4C62E638FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE form_imprimante (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, imprimante_id INT NOT NULL, impression_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, stl_file VARCHAR(255) NOT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, INDEX IDX_44358F3EFB88E14F (utilisateur_id), INDEX IDX_44358F3E1CA0A76 (imprimante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imprimante (id INT AUTO_INCREMENT NOT NULL, time DATE NOT NULL, working TINYINT(1) NOT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, quantity INT NOT NULL, created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, stl_file VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, code LONGTEXT DEFAULT NULL, INDEX IDX_5A8A6C8DFB88E14F (utilisateur_id), INDEX IDX_5A8A6C8D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_cateogies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE form_imprimante ADD CONSTRAINT FK_44358F3EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE form_imprimante ADD CONSTRAINT FK_44358F3E1CA0A76 FOREIGN KEY (imprimante_id) REFERENCES imprimante (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES post_cateogies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_imprimante DROP FOREIGN KEY FK_44358F3E1CA0A76');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638FB88E14F');
        $this->addSql('ALTER TABLE form_imprimante DROP FOREIGN KEY FK_44358F3EFB88E14F');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DFB88E14F');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE form_imprimante');
        $this->addSql('DROP TABLE imprimante');
        $this->addSql('DROP TABLE materiaux');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_cateogies');
        $this->addSql('DROP TABLE `user`');
    }
}
