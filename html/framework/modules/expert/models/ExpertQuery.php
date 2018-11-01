<?php

namespace app\modules\expert\models;

/**
 * This is the ActiveQuery class for [[Expert]].
 *
 * @see Expert
 */
class ExpertQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Expert[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Expert|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere(
            [Expert::tableName() . '.[[hidden]]' => Expert::HIDDEN_NO]
        );
    }
}
