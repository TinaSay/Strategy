<?php

use elfuvo\menu\models\Menu;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m180531_133920_menu
 */
class m180531_133920_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $list = [
            [
                'title' => 'Стратегия',
                'alias' => 'about',
                'type' => Menu::TYPE_MODULE,
                'route' => 'content/default/index',
                'queryParams' => 'alias=about',
            ],
            [
                'title' => 'Новости',
                'alias' => 'news',
                'type' => Menu::TYPE_MODULE,
                'route' => 'news/default/index',
                'queryParams' => '',
                'children' => [
                    [
                        'title' => 'Карточка новости',
                        'alias' => '<id:\d+>',
                        'type' => Menu::TYPE_BREADCRUMB,
                        'route' => 'news/default/view',
                        'queryParams' => '',
                    ],
                ],
            ],
            [
                'title' => 'Эксперты',
                'alias' => 'experts',
                'type' => Menu::TYPE_MODULE,
                'route' => 'content/default/index',
                'queryParams' => 'alias=experts',
            ],
        ];
        $pos = 0;
        foreach ($list as $item) {
            $item['pos'] = ++$pos;
            $item['depth'] = 0;
            $item['url'] = $item['alias'];
            if (($item['id'] = $this->insertMenu($item, null)) && isset($item['children'])) {
                foreach ($item['children'] as $child) {
                    $child['pos'] = ++$pos;
                    $child['depth'] = 1;
                    $child['url'] = $item['alias'] . '/' . $child['alias'];
                    if (($child['id'] = $this->insertMenu($child, $item)) && isset($child['children'])) {
                        foreach ($child['children'] as $child2) {
                            $child2['pos'] = ++$pos;
                            $child2['depth'] = 2;
                            $child2['url'] = $item['alias'] . '/' . $child['alias'] . '/' . $child2['alias'];
                            if (($child2['id'] = $this->insertMenu($child2, $child)) && isset($child2['children'])) {
                                foreach ($child2['children'] as $child3) {
                                    $child3['pos'] = ++$pos;
                                    $child3['depth'] = 3;
                                    $child3['url'] = $item['alias'] . '/' . $child['alias'] . '/' . $child2['alias'] . '/' . $child3['alias'];
                                    $this->insertMenu($child3, $child2);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param array $menu
     * @param array|null $parent
     *
     * @return int|bool
     */
    protected function insertMenu(array $menu, ?array $parent)
    {
        $this->insert('{{%menu}}', [
            'parentId' => $parent ? $parent['id'] : null,
            'title' => $menu['title'],
            'alias' => $menu['alias'],
            'route' => $menu['route'],
            'depth' => $menu['depth'],
            'queryParams' => $menu['queryParams'] ?? '',
            'url' => $menu['url'],
            'type' => $menu['type'],
            'section' => Menu::SECTION_DEFAULT,
            'language' => Yii::$app->language,
            'hidden' => Menu::HIDDEN_NO,
            'position' => $menu['pos'],
            'createdAt' => new Expression('NOW()'),
            'updatedAt' => new Expression('NOW()'),
        ]);
        $id = $this->db->getLastInsertID();

        return $id;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Menu::deleteAll();
    }
}
