<?php
require_once(dirname(__FILE__) . '/../../../../loadYii.php');

if (!Yii::app()->user->isGuest)
{
        $_SESSION['tinymce.isLoggedIn'] = true;
        Yii::app()->request->redirect(Yii::app()->request->getQuery('return_url'));
}
else
{
        echo 'Your session has expired, please log in again.';
}