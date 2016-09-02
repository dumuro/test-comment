<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $comment \app\models\Comments */
/* @var $comments array */
/* @var $maxLevel null|integer comments max level */
?>
<?php if (!empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>
        <li class="comment" id="comment-<?php echo $comment->id ?>" itemscope itemtype="http://schema.org/Comment">
            <div class="comment-content" data-comment-content-id="<?php echo $comment->id ?>">
                <div class="comment-author-avatar">
                    <?php echo Html::img($comment->getAvatar(), ['alt' => $comment->getAuthorsNames()]); ?>
                </div>
                <div class="comment-details">
                    <?php if ($comment->is_published): ?>
                        <div class="comment-action-buttons">
                            <?php if ($comment->level < $maxLevel || is_null($maxLevel)): ?>
                                <?php echo Html::a("<span class='glyphicon glyphicon-share-alt'></span> " . Yii::t('app', 'Reply'), '#', ['class' => 'comment-reply', 'data' => ['action' => 'reply', 'comment-id' => $comment->id]]); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php echo Html::tag('meta', null, ['content' => Yii::$app->formatter->asDatetime($comment->create_date, 'php:c'), 'itemprop' => 'dateCreated']); ?>
                    <?php echo Html::tag('meta', null, ['content' => Yii::$app->formatter->asDatetime($comment->update_date, 'php:c'), 'itemprop' => 'dateModified']); ?>
                    <div class="comment-author-name" itemprop="creator" itemscope itemtype="http://schema.org/Person">
                        <span itemprop="name"><?php echo $comment->getAuthorsNames(); ?></span>
                        <span class="comment-date">
                            <?php echo $comment->getPostedDate(); ?>
                        </span>
                    </div>
                    <div class="comment-body" itemprop="text">
                        <?php echo nl2br($comment->text); ?>
                    </div>
                </div>
            </div>
            <?php if ($comment->hasChildren()): ?>
                <ul class="children">
                    <?php echo $this->render('_list', ['comments' => $comment->children, 'maxLevel' => $maxLevel]) ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>