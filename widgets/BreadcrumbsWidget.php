<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/**
 * Class BreadcrumbsWidget
 * @package app\widgets
 */
class BreadcrumbsWidget extends Breadcrumbs
{
    public function run()
    {
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => \Yii::t('yii', 'Home'),
                'url' => \Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $links), $this->options);
    }
}