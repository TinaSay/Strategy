<?php

use yii\db\Migration;

/**
 * Class m180605_090101_review
 */
class m180605_090101_review extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'post' => $this->string(256)->notNull()->defaultValue(''),
            'text' => $this->text()->notNull(),
            'hidden' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'language' => $this->string(8)->notNull()->defaultValue('ru-RU'),
            'createdBy' => $this->integer(11),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('hidden', '{{%review}}', ['hidden']);
        $this->createIndex('language', '{{%review}}', ['language']);

        $this->addForeignKey(
            'fk-review-auth',
            '{{%review}}',
            'createdBy',
            '{{%auth}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-review-auth', '{{%review}}');
        $this->dropTable('{{%review}}');
    }
}
