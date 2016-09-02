<?php

/**
 * @var $model \app\models\Topic
 */
?>
<li class="topic-short" data-key="<?= $model->id ?>">
    <div class="title">
        <a href="<?= \yii\helpers\Url::to(['site/view', 'id' => $model->id]) ?>">
            <?= \yii\helpers\Html::encode($model->name) ?>
        </a>
    </div>
    <br />
    <time datetime="<?= Yii::$app->getFormatter()->asDatetime($model->create_date, 'php:c') ?>" title="<?= Yii::$app->getFormatter()->asDatetime($model->create_date, 'php:j F Y, H:i') ?>">
        <?= Yii::$app->getFormatter()->asDatetime($model->create_date, 'php:j F Y, H:i') ?>
    </time>
    <br />    <br />
    <div class="desc">
        <?php echo $model->text ?>
    </div>
    <div>
        <a href="#" class="btn btn-default">Читать далее</a>
    </div>
</li>