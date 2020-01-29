<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129162521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE price_event (price_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_106702C7D614C7E7 (price_id), INDEX IDX_106702C771F7E88B (event_id), PRIMARY KEY(price_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE price_event ADD CONSTRAINT FK_106702C7D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE price_event ADD CONSTRAINT FK_106702C771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE event_price');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event_price (event_id INT NOT NULL, price_id INT NOT NULL, INDEX IDX_8BD393F571F7E88B (event_id), INDEX IDX_8BD393F5D614C7E7 (price_id), PRIMARY KEY(event_id, price_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_price ADD CONSTRAINT FK_8BD393F571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_price ADD CONSTRAINT FK_8BD393F5D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE price_event');
    }
}
