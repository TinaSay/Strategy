<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 29.12.17
 * Time: 11:11
 */

namespace app\modules\menu\widgets;

use elfuvo\menu\models\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs as BaseWidget;

/**
 * Class BreadcrumbsWidget
 *
 * @package app\extensions\menu\widgets
 */
class BreadcrumbsWidget extends BaseWidget
{

    /**
     * @var bool
     */
    public $homeLink = false;

    /**
     * how to render last link - as link or simple text
     *
     * @var bool
     */
    public $skipLastLink = true;

    /**
     * do not show last link from breadcrumb
     *
     * @var bool
     */
    public $hideLastLink = false;

    /**
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->links = ArrayHelper::merge($this->generate(), $this->links);
        if (!$this->links && $this->homeLink) {
            $this->links = [$this->homeLink];
            $this->homeLink = false;
        }
    }

    /**
     * @return array
     */
    protected function generate()
    {
        $links = [];
        $list = Menu::find()
            ->language()
            ->active()
            ->asNavChain();
        foreach ($list as $key => $item) {
            // dynamic url, skip it for breadcrumb, must be set manually from view
            if (Menu::TYPE_BREADCRUMB && preg_match('#\<([^>]+)\>#', $item['url'])) {
                continue;
            }

            if ($this->hideLastLink && ($key + 1) >= count($list)) {
                continue;
            } elseif ($this->skipLastLink && ($key + 1) >= count($list)) {
                $links[] = $item['title'];
            } else {
                $links[] = [
                    'label' => $item['title'],
                    'url' => $item['type'] == Menu::TYPE_VOID ? 'javascript:void(0)' : Url::to(['/' . $item['url']]),
                ];
            }
        }

        // add breadcrumbs items from view
        $viewLinks = ArrayHelper::getValue($this->getView()->params, 'breadcrumbs');
        if ($viewLinks) {
            $links = ArrayHelper::merge($links, $viewLinks);
        }

        return $links;
    }
}