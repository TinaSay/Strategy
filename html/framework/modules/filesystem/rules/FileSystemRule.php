<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 04.06.18
 * Time: 14:26
 */

namespace app\modules\filesystem\rules;


use yii\web\UrlRule;

/**
 * Class FileSystemRule
 * @package app\modules\filesystem\rules
 */
class FileSystemRule extends UrlRule
{

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        if (!preg_match($this->pattern, $pathInfo, $matches)) {
            return false;
        }

        $matches = $this->substitutePlaceholderNames($matches);

        return [
            $this->route,
            [
                'path' => 'editor/' .
                    $matches['h1'] . '/' . $matches['h2'] . '/' . $matches['path']
            ]
        ];
    }
}