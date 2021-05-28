<?php 
namespace backend\models\enums;

use Yii;
use yii\helpers\Url;

class DirectoryTypes {
   const UPLOADS = 0;

    public static $folderName = array(
        self::UPLOADS => 'uploads',
       
    );

    public static function getOrganizationDirectory($is_relative=true)
    {


        if(!$is_relative){
            return Url::to(\Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR.Yii::$app->params['uploadDir'] . 'organizations' . DIRECTORY_SEPARATOR) ;
        }
        else {
            return Url::to(\Yii::getAlias('@web') . "/" . Yii::$app->params['uploadDir']  . 'organizations'  . '/', true);
        }
    }

    public static function getClientDirectory($is_relative=true)
    {

       if(!$is_relative){
            return Url::to(\Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR.Yii::$app->params['uploadDir'] . 'clients' . DIRECTORY_SEPARATOR) ;
        }
        else {
            return Url::to(\Yii::getAlias('@web') . "/" . Yii::$app->params['uploadDir']  . 'clients' . '/', true);
        }
    }

    public static function getCoachDirectory($is_relative=true)
    {

        if(!$is_relative){
            return Url::to(\Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR.Yii::$app->params['uploadDir'] . 'coaches' . DIRECTORY_SEPARATOR) ;
        }
        else {
            return Url::to(\Yii::getAlias('@web') . "/" . Yii::$app->params['uploadDir']  . 'coaches' . '/', true);
        }
    }

    public static function getParticipantDirectory($is_relative=true)
    {
		//echo "<pre>"; 		print_r(Url::to(\Yii::getAlias('@webroot')). "/" .Yii::$app->params['uploadDir']); exit; 
		if(!$is_relative){	
            //return Url::to(\Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR.Yii::$app->params['uploadDir'] . 'participants' . DIRECTORY_SEPARATOR) ;
            return Url::to(\Yii::getAlias('@webroot') . "/" .Yii::$app->params['uploadDir'] . 'participants' . "/" ) ;
        }
        else { //echo "test 3 "; exit; 
            return Url::to(\Yii::getAlias('@web') . "/" . Yii::$app->params['uploadDir']  . 'participants' . '/', true);
        }
    }

    public static function getFacultyDirectory($is_relative=true)
    {
		//echo "<pre>"; 		print_r(Url::to(\Yii::getAlias('@webroot')). "/" .Yii::$app->params['uploadDir']); exit; 
		if(!$is_relative){	
            //return Url::to(\Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR.Yii::$app->params['uploadDir'] . 'participants' . DIRECTORY_SEPARATOR) ;
            return Url::to(\Yii::getAlias('@webroot') . "/" .Yii::$app->params['uploadDir'] . 'faculty' . "/" ) ;
        }
        else { //echo "test 3 "; exit; 
            return Url::to(\Yii::getAlias('@web') . "/" . Yii::$app->params['uploadDir']  . 'faculty' . '/', true);
        }
    }
} 
?>