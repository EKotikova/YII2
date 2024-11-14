<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends  Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "CreatePost"
        $createPost = $auth->createPermission('Create');
        $createPost->description = 'Create';
        $auth->add($createPost);

        // добавляем разрешение "Update"
        $updatePost = $auth->createPermission('Update');
        $updatePost->description = 'Update';
        $auth->add($updatePost);

        // добавляем роль "user" и даём роли разрешение "createPost"
        $author = $auth->createRole('user');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }

}