<?php
/**
 * @var $model \app\models\Topic
 * @var $this \yii\web\View
 */
$this->title = $model->name;
?>
<div class="site-view">
    <div class="title">
        <?= \yii\helpers\Html::encode($model->name) ?>
    </div>
    <br />
    <time datetime="<?= Yii::$app->getFormatter()->asDatetime($model->create_date, 'php:c') ?>" title="<?= Yii::$app->getFormatter()->asDatetime($model->create_date, 'php:j F Y, H:i') ?>">
        <?= Yii::$app->getFormatter()->asDatetime($model->create_date, 'php:j F Y, H:i') ?>
    </time>
    <br /><br />
    <div class="desc">
        <?php echo $model->text ?>
    </div>
</div>
<?= \app\widgets\CommentsWidget::widget(['tId' => $model->id]) ?>