<?php

use yii\db\Migration;

/**
 * Class m180607_053351_expert_menu
 */
class m180607_053351_expert_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('{{%menu}}',
            [
                'route' => 'expert/expert/index',
                'queryParams' => '',
            ],
            ['alias' => 'experts']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->update('{{%menu}}',
            ['route' => 'content/default/index'],
            ['alias' => 'experts']);
    }
}
