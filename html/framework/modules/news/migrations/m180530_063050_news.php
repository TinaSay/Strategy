<?php

use yii\db\Migration;

/**
 * Class m180530_063050_news
 */
class m180530_063050_news extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(256)->notNull()->defaultValue(''),
            'announce' => $this->text()->notNull(),
            'text' => $this->text()->notNull(),
            'date' => $this->dateTime()->null()->defaultValue(null),
            'hidden' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'language' => $this->string(8)->notNull()->defaultValue('ru-RU'),
            'createdBy' => $this->integer(11),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('title', '{{%news}}', ['title']);
        $this->createIndex('date', '{{%news}}', ['date']);
        $this->createIndex('hidden', '{{%news}}', ['hidden']);
        $this->createIndex('language', '{{%news}}', ['language']);

        $this->addForeignKey(
            'fk-news-auth',
            '{{%news}}',
            'createdBy',
            '{{%auth}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-news-auth', '{{%news}}');
        $this->dropTable('{{%news}}');
    }
}
