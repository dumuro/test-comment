<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $commentModel \app\models\Comments */
/* @var $encryptedEntity string */
/* @var $formId string comment form id */
/* @var $tid int */
?>
<div class="comment-form-container">
    <br />
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => $formId,
            'class' => 'comment-box'
        ],
        'action' => Url::to(['site/create']),
        'validateOnChange' => false,
        'validateOnBlur'   => false
    ]); ?>

    <?php echo $form->field($commentModel, 'name', ['template' => '{input}{error}'])->textInput([
        'placeholder' => Yii::t('app', 'Имя'),
        'rows'        => 2,
        'data'        => ['name' => 'content']])
    ?>
    <?php echo $form->field($commentModel, 'email', ['template' => '{input}{error}'])->textInput(['placeholder' => Yii::t('app', 'E-mail'), 'rows' => 3, 'data' => ['email' => 'content']]) ?>
    <?php echo $form->field($commentModel, 'text', ['template' => '{input}{error}'])->textarea(['placeholder' => Yii::t('app', 'Add a comment...'), 'rows' => 4, 'data' => ['comment' => 'content']]) ?>
    <?php echo $form->field($commentModel, 'pid', ['template' => '{input}'])->hiddenInput(['data' => ['comment' => 'parent-id']]); ?>
    <?php echo $form->field($commentModel, 'tid', ['template' => '{input}'])->hiddenInput(['data' => ['comment' => 'topic-id']]); ?>
    <div class="login-captcha">
        <?= $form->field($commentModel, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())->label(false); ?>
    </div>
    <div class="comment-box-partial">
        <div class="button-container show">
            <?php echo Html::a(Yii::t('app', 'Нажмите здесь, чтобы отменить ответ.'), '#', ['id' => 'cancel-reply', 'class' => 'pull-right', 'data' => ['action' => 'cancel-reply']]); ?>
            <?php echo Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary comment-submit']); ?>
        </div>
    </div>
    <?php $form->end(); ?>
    <div class="clearfix"></div>
</div>
<br />
<br />
