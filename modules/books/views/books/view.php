<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\books\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'edition',
            'description:ntext',
            'isbn',
            [
                'attribute' => 'date_create',
                'format'    => [ 'date', 'php:jS F Y' ]
            ],
            [
                'attribute' => 'image',
                'format'    => 'html',
                'value'     => Html::img( '@web' . $model->image, [ 'width' => '100px' ] )
            ],
            [
                'attribute' => 'Authors',
                'value'     => Authors::getAuthorById($model->authors)
            ],
        ],
    ]) ?>

</div>
