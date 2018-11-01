<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 01.06.18
 * Time: 9:59
 */

namespace app\widgets\pagination;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager as BaseWidget;

/**
 * Class LinkPager
 * @package app\widgets\pagination
 */
class LinkPager extends BaseWidget
{
    /**
     * @var array HTML attributes for the pager container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'pagination-block'];

    /**
     * @var string
     */
    public $prevPageCssClass = 'prev pagination-arrow';

    /**
     * @var string
     */
    public $nextPageCssClass = 'next pagination-arrow';

    /**
     * @var string
     */
    public $prevPageLabel = '<i class="icon-arrow-left"></i>';

    /**
     * @var string
     */
    public $nextPageLabel = '<i class="icon-arrow-right"></i>';

    /**
     * @var string
     */
    public $disabledPageCssClass = 'hidden';
    /**
     * @var null|\Closure
     */
    public $renderFormatter;

    /**
     * Renders a page button.
     * You may override this method to customize the generation of page buttons.
     * @param string $label the text label for the button
     * @param int $page the page number
     * @param string $class the CSS class for the page button.
     * @param bool $disabled whether this page button is disabled
     * @param bool $active whether this page button is active
     * @return string the rendering result
     */
    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = $this->linkContainerOptions;
        if ($this->renderFormatter instanceof \Closure) {
            $label = call_user_func($this->renderFormatter, $label);
        }
        $linkWrapTag = ArrayHelper::remove($options, 'tag', 'li');
        Html::addCssClass($options, empty($class) ? $this->pageCssClass : $class);

        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $disabledItemOptions = $this->disabledListItemSubTagOptions;
            $tag = ArrayHelper::remove($disabledItemOptions, 'tag', 'span');

            return Html::tag($linkWrapTag, Html::tag($tag, $label, $disabledItemOptions), $options);
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        return Html::tag($linkWrapTag, Html::a($label, $this->pagination->createUrl($page), $linkOptions), $options);
    }
}