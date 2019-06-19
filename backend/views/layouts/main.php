<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>

    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags()?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head()?>

    <?php
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '57x57', 'href' => '/apple-icon-57x57.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '60x60', 'href' => '/apple-icon-60x60.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '72x72', 'href' => '/apple-icon-72x72.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '76x76', 'href' => '/apple-icon-76x76.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '114x114', 'href' => '/apple-icon-114x114.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '120x120', 'href' => '/apple-icon-120x120.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '144x144', 'href' => '/apple-icon-144x144.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '152x152', 'href' => '/apple-icon-152x152.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => '/apple-icon-180x180.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '192x192', 'href' => '/android-icon-192x192.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => '/favicon-32x32.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '96x96', 'href' => '/favicon-96x96.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => '/favicon-16x16.png']);
$this->registerLinkTag(['rel' => 'manifest', 'href' => '/manifest.json']);
?>
</head>
<body>
<?php $this->beginBody()?>

<div class="wrap">
    <?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'Inicio', 'url' => ['/site/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = ['label' => 'Usuarios', 'items' => [
        ['label' => 'Empleados', 'url' => ['/user']],
        ['label' => 'Clientes', 'url' => ['/face-user']],
    ]];
    $menuItems[] = ['label' => 'Peliculas', 'url' => ['/pelicula']];
    $menuItems[] = ['label' => 'Estrenos', 'url' => ['/estreno']];
    $menuItems[] = ['label' => 'Funciones', 'url' => ['/funcion/planner']];
    $menuItems[] = ['label' => 'Promociones', 'url' => ['/promocion']];
    $menuItems[] = ['label' => 'Boletos', 'url' => ['/boleto']];
    $menuItems[] = ['label' => 'Utilidades', 'items' => [
        ['label' => 'Distribuidoras', 'url' => ['/distribuidora']],
        ['label' => 'Clasificaciones', 'url' => ['/clasificacion']],
        ['label' => 'Salas', 'url' => ['/sala']],
        ['label' => 'Precios', 'url' => ['/precio']],
        ['label' => 'Cines', 'url' => ['/cine']],
    ]];
    $menuItems[] = '<li>'
    . Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton(
        'Logout (' . Yii::$app->user->identity->username . ')',
        ['class' => 'btn btn-link logout']
    )
    . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>

    <div class="container">
        <?php echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
        <?php echo Alert::widget() ?>
        <?php echo $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?php echo Html::encode(Yii::$app->name) ?> <?php echo date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
