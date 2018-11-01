<?php

namespace app\tests;

use app\modules\review\models\Review;
use app\tests\fixtures\ReviewFixture;

/**
 * Class ReviewPageCest
 *
 * @package app\tests
 */
class ReviewPageCest
{
    public function _before(FunctionalTester $I)
    {
        \Yii::setAlias('@webroot', '@root/web');
    }

    public function _after(FunctionalTester $I)
    {
        /** @var ReviewFixture $fixture */
        // this command drops ALL data
        $fixture = $I->grabFixture('review');
        $fixture->unload();
    }

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'review' => [
                'class' => ReviewFixture::class,
                // fixture data located in tests/_data/review.php
                'dataFile' => codecept_data_dir() . 'review.php',
            ],
        ];
    }

    // tests
    public function seePageTest(FunctionalTester $I)
    {
        $I->seeRecord(Review::class, ['id' => 1000]);

        $I->amOnPage('/review/default/index');
        $I->seeResponseCodeIs(200);

        $I->seeElement('.catd-maind__autor');

    }

    public function seeWidgetTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);

        $I->seeElement('.slider-maind__ell');
    }

}
