<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 23.05.18
 * Time: 15:39
 */

namespace app\tests\fixtures;

use app\modules\review\models\Review;
use yii\test\ActiveFixture;

/**
 * Class MenuFixture
 *
 * @package elfuvo\menu\tests\fixtures
 */
class ReviewFixture extends ActiveFixture
{
    public $modelClass = Review::class;

    public $depends = [DbInitFixture::class];
}