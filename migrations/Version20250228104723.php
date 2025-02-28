<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250228104723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, film_id INT DEFAULT NULL, date_ajout DATETIME NOT NULL, INDEX IDX_8933C432A76ED395 (user_id), INDEX IDX_8933C432567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE utilisateur_film DROP FOREIGN KEY FK_4BC5D218567F5183');
        $this->addSql('ALTER TABLE utilisateur_film DROP FOREIGN KEY FK_4BC5D218FB88E14F');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_film');
        $this->addSql('ALTER TABLE film CHANGE titre_unique titre_unique VARCHAR(255) NOT NULL, CHANGE genre genre VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur_film (utilisateur_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_4BC5D218FB88E14F (utilisateur_id), INDEX IDX_4BC5D218567F5183 (film_id), PRIMARY KEY(utilisateur_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur_film ADD CONSTRAINT FK_4BC5D218567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_film ADD CONSTRAINT FK_4BC5D218FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432A76ED395');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432567F5183');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE film CHANGE titre_unique titre_unique VARCHAR(50) NOT NULL, CHANGE genre genre VARCHAR(50) NOT NULL');
    }
}
