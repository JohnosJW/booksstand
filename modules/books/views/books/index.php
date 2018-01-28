<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\books\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
?>
<div class="books-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php echo $this->render( '_search', [ 'model' => $searchModel ] ); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'columns'      => [

//            'id',
            'name',
            [
                'attribute' => 'preview',
                'format'    => 'raw',
                'value'     => function ( $model ) {
                    return Html::a( Html::img( '@web' . $model->image, [ 'width' => '100px' ] ),
                        '@web' . $model->image,
                        [
                            'class'         => 'thumbnail',
                            'data-lightbox' => 'image-1',
                            'data-title'    => $model->name,
                        ] );
                }
            ],
            [
                'attribute' => 'Author',
                'format' => 'html',
                'value'     => function ( $model ) {
                    $data = '';
                    foreach ( $model->authors as $item ) {
                        $data .= $item['first_name'] . ' ' . $item['last_name'] . '. ';
                    }
                    return $data;
                }
            ],
            'edition',
            'description:ntext',
            'isbn',
            [
                'attribute' => 'date_create',
                'format'    => [ 'date', 'php:jS F Y' ]
            ],
            [
                'class'          => 'yii\grid\ActionColumn',
                'template'       => '{update} {view} {delete}',
                'buttons'        => [
                    'view'   => function ( $url, $model ) {
                        return Html::a( '<span class="glyphicon glyphicon-eye-open"</span>',
                            [ 'view', 'id' => $model->id ],
                            [
                                'title' => 'Просмотр книги',
                                'class' => 'showModalButton btn btn-sm btn-success'
                            ] );
                    },
                    'update' => function ( $url, $model ) {
                        return Html::a( '<span class="glyphicon glyphicon-pencil"</span>',
                            [ 'update', 'id' => $model->id ],
                            [
                                'title' => 'Редактировать',
                                'class' => 'btn btn-sm btn-success'
                            ] );
                    },
                    'delete' => function ( $url, $model ) {
                        return Html::a( '<span class="glyphicon glyphicon-trash"</span>',
                            [ 'delete', 'id' => $model->id ],
                            [
                                'title' => 'Удалить',
                                'class' => 'btn btn-sm btn-success',
                                'data'  => [
                                    'confirm' => 'Вы уверенны, что хотите удалить эту запись?',
                                    'method'  => 'post',
                                ],
                            ] );
                    },
                ],
                'contentOptions' => [ 'style' => 'width: 140px; max-width: 140px;' ],
            ],
        ],
    ] ); ?>

</div>
