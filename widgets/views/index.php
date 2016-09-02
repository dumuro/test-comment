<?php
/**
 * @var $commentModel \app\models\Comments
 * @var $formId mixed
 * @var $pjaxContainerId mixed
 * @var $maxLevel int
 * @var $comments \app\models\Comments
 * @var $tid int
 */
?>
<?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout' => 20000, 'id' => $pjaxContainerId]); ?>
<div class="comments row">
    <div class="col-md-12 col-sm-12">
        <div class="title-block clearfix">
            <h3 class="h3-body-title">
            </h3>
            <div class="title-separator"></div>
        </div>
        <h3>Комментарии</h3>
        <ol class="comments-list">
            <?php echo $this->render('_list', ['comments' => $comments, 'maxLevel' => $maxLevel]) ?>
        </ol>
        <?php echo $this->render('_form', [
                'commentModel' => $commentModel,
                'formId' => $formId,
                'tid' => $tid
            ]);
        ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end(); ?>
