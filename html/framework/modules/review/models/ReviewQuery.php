<?php

namespace app\modules\review\models;

/**
 * This is the ActiveQuery class for [[Review]].
 *
 * @see Review
 */
class ReviewQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Review[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Review|array|null
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
            [Review::tableName() . '.[[hidden]]' => Review::HIDDEN_NO]
        );
    }
}
