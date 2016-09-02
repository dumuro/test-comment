<?php

/* @var $this yii\web\View
 * @var $model \app\models\Topic
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

$this->title = 'Тестовое задание';
?>
<div class="site-index">
    <h2 style="margin-left: 36px">Статьи</h2>
    <div class="body-content">
        <?=  \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'id'    => 'topic',
                'tag'   => 'ul',
                'class' => 'topic-list'
            ],
            'itemOptions' => [
                'tag' => false,
            ],
            'layout' => "{items}\n{pager}",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_list',['model' => $model]);
            },
        ]);
        ?>
    </div>
</div>
