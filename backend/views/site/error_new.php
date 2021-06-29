<?php 
use yii\helpers\Html;

$this->title = 'Login_Error';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
  
<header>
        <h1 class="animation-slide-top">404</h1>
        <p>Page Not Found !</p>
      </header>
      <p class="error-advise">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
      <a class="btn btn-primary btn-round" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index")?>">GO TO HOME PAGE</a>

      <footer class="page-copyright">
        <p>WEBSITE BY Coach-to-Transformation</p>
        <p>© 2019. All RIGHT RESERVED.</p>
       
      </footer>
            
</div>
