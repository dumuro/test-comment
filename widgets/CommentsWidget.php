<?php

namespace app\widgets;

use app\assets\AppAsset;
use app\models\Comments;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Class CommentsWidget
 * @package app\widgets
 */
class CommentsWidget extends Widget {

    /**
     * @var string comment form id
     */
    public $formId = 'comment-form';

    /**
     * @var string pjax container id
     */
    public $pjaxContainerId;

    /**
     * @var null|integer maximum comments level, level starts from 1, null - unlimited level;
     */
    public $maxLevel = 7;

    /**
     * @var string entity id attribute
     */
    public $entityIdAttribute = 'id';

    /**
     * @var array comment widget client options
     */
    public $clientOptions = [];

    /**
     * @var integer primary key value of the widget model
     */
    public $tId;

    /**
     * Initializes the widget params.
     */
    public function init()
    {
        if (empty($this->pjaxContainerId)) {
            $this->pjaxContainerId = 'comment-pjax-container-' . $this->getId();
        }

        if (empty($this->tId)) {
            throw new InvalidConfigException('The "tId" value for widget model cannot be empty.');
        }

        $this->registerAssets();
    }

    /**
     * Executes the widget.
     *
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        $commentModel = new Comments();
        $commentModel->tid = $this->tId;

        $comments = Comments::getTree($this->tId, $this->maxLevel);
        return $this->render('index', [
            'comments'            => $comments,
            'commentModel'        => $commentModel,
            'maxLevel'            => $this->maxLevel,
            'pjaxContainerId'     => $this->pjaxContainerId,
            'formId'              => $this->formId,
            'tid'                 => $this->tId
        ]);
    }

    /**
     * Register assets.
     *
     * @return void
     */
    protected function registerAssets()
    {
        $this->clientOptions['pjaxContainerId'] = '#' . $this->pjaxContainerId;
        $this->clientOptions['formSelector'] = '#' . $this->formId;
        $options = Json::encode($this->clientOptions);
        $view = $this->getView();
        AppAsset::register($view);
        $view->registerJs("jQuery('#{$this->formId}').comment({$options});");
    }

}