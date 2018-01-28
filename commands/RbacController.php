<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "viewBook"
        $viewBook = $auth->createPermission('viewBook');
        $viewBook->description = 'View a Book';
        $auth->add($viewBook);

        // добавляем разрешение "create"
        $create = $auth->createPermission('create');
        $create->description = 'Create';
        $auth->add($create);

        // добавляем разрешение "update"
        $update = $auth->createPermission('update');
        $update->description = 'Update';
        $auth->add($update);

        // добавляем разрешение "delete"
        $delete = $auth->createPermission('delete');
        $delete->description = 'Delete';
        $auth->add($delete);

        // добавляем разрешение "subscription"
        $subscription = $auth->createPermission('subscription');
        $subscription->description = 'Subscription';
        $auth->add($subscription);

        // добавляем разрешение "report"
        $report = $auth->createPermission('report');
        $report->description = 'Report';
        $auth->add($report);

        // добавляем роль "guest" и даём роли разрешение "viewBook" и "subscription"
        $guest = $auth->createRole('guest');
        $auth->add($guest);
        $auth->addChild($guest, $viewBook);
        $auth->addChild($guest, $subscription);

        // добавляем роль "user" и даём роли разрешение "viewBook", "create", "update", "delete" и "report"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $viewBook);
        $auth->addChild($user, $create);
        $auth->addChild($user, $update);
        $auth->addChild($user, $delete);
        $auth->addChild($user, $report);
    }
}