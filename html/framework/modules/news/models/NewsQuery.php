<?php

namespace app\modules\news\models;

use Yii;
use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[News]].
 *
 * @see News
 */
class NewsQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return News[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return News|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param null $language
     *
     * @return $this
     */
    public function language($language = null)
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        return $this->andWhere([News::tableName() . '.[[language]]' => $language]);
    }

    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere([
            'AND',
            [News::tableName() . '.[[hidden]]' => News::HIDDEN_NO],
            ['<=', News::tableName() . '.[[date]]', new Expression('CURDATE()')],
        ]);
    }
}
