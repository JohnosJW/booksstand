<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin( [
        'action' => [ 'index' ],
        'method' => 'get',
    ] ); ?>

    <label class="control-label" for="books-edition">Отчет - ТОП 10 авторов выпуствишие больше книг за какой-то год</label>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field( $model, 'date_min' )->textInput( [ 'maxlength' => 4 ] ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field( $model, 'date_max' )->textInput( [ 'maxlength' => 4 ] ) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">
            <div class="form-group">
                <?= Html::submitButton( 'Отчет', [ 'class' => 'btn btn-primary pull-right' ] ) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<br>
