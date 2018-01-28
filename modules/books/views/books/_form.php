<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ]
    ] ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edition')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label class="control-label" for="books-edition">Authors</label>
        <?= MultiSelect::widget([
            'id'=>"multiXX",
            "options" => ['multiple'=>"multiple"],
            'data' => \app\modules\books\models\Authors::getAuthorsArray(),
            'value' => $model->getAuthors()->select('id')->asArray()->column(),
            'name' => 'authors',
            "clientOptions" =>
                [
                    "includeSelectAllOption" => true,
                    'numberDisplayed' => 2
                ],
        ]) ?>
    </div>

    <? if ( ! empty( $model->image )) {
        echo Html::a( Html::img( '@web' .  $model->image, [ 'width' => '100px' ] ),
            '@web' .  $model->image,
            [
                'class'         => 'thumbnail',
                'data-lightbox' => 'image-1',
                'data-title'    => $model->name,
            ] );
    } ?>

    <?= !$model->isNewRecord ? $form->field( $model, 'image' )->fileInput() : '' ?>

    <div class="form-group">
        <?= Html::submitButton( 'Обновить',
            [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
