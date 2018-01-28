<?php

namespace app\modules\books\controllers;

use Yii;
use app\modules\books\models\Books;
use app\modules\books\models\BooksSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\modules\books\helpers\ImageHelper;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'post' ],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new BooksSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );
        // Запоминаем путь с учетом фильтров
        Url::remember();
        return $this->render( 'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('create')) {
            throw new ForbiddenHttpException('Доступ только для авторизированных пользователей.');
        }

        $model = new Books();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->softCreate(Yii::$app->request->post('authors'));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function actionUpdate( $id )
    {
        if (!\Yii::$app->user->can('update')) {
            throw new ForbiddenHttpException('Доступ только для авторизированных пользователей.');
        }

        $model = $this->findModel( $id );

        // Сохраняем ссылку на рисунок, если он уже существует
        $old_image = $model->image;

        if ($model->load( Yii::$app->request->post() )) {

            $model->beforeDelete();

            $model->softCreate(Yii::$app->request->post('authors'));

            if (isset( $model->image )) {
                $model->image = UploadedFile::getInstance( $model, 'image' );
            }
            if (isset( $model->image )) {
                $image_name = Yii::$app->getSecurity()->generateRandomString();
                $image_full_name = $image_name . '.' . $model->image->extension;
                $model->image->saveAs(  'images/' . $image_full_name );
                $model->image = '/images/' . $image_full_name;

                //Создаем картинку
                $path_from = Yii::getAlias( 'images/' . $image_full_name );
                $path_to   = Yii::getAlias( 'images/' ) . $image_full_name;
                ImageHelper::makeImage( $path_from, $path_to, $desired_width = 300 );
            } else {
                $model->image = $old_image;
            }
            if ($model->validate() && $model->save()) {
                // Переадресация на запомненую страницу
                return $this->redirect( Url::previous() );
            } else {
                throw new NotFoundHttpException( 'Не удалось загрузить данные' );
            }
        } else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete( $id )
    {
        if (!\Yii::$app->user->can('delete')) {
            throw new ForbiddenHttpException('Доступ только для авторизированных пользователей.');
        }

        $this->findModel( $id )->delete();

        return $this->redirect( Url::previous() );
    }

    /**
     *
     * @param integer $id
     *
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if (( $model = Books::findOne( $id ) ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
