<?php

use krok\content\models\Content;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m180531_112334_content_expert
 */
class m180531_112334_content_expert extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert(Content::tableName(), [
            'alias' => 'experts',
            'title' => 'Эксперты',
            'text' => '<p>Эксперты</p>',
            'layout' => '//common',
            'view' => 'experts',
            'description' => '',
            'keywords' => '',
            'hidden' => Content::HIDDEN_NO,
            'language' => Yii::$app->language,
            'createdAt' => new Expression('NOW()'),
            'updatedAt' => new Expression('NOW()')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Content::deleteAll(['alias' => 'experts']);
    }

}
