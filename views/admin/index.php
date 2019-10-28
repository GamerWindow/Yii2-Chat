<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Administration';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-index">
    <h1><?=Html::encode($this->title)?></h1>

    <?=Html::a('Chat Statistik', ['admin/stats'], ['class' => 'btn btn-primary'])?>


<?=Html::a('Chat leeren', ['admin/delete'], ['class' => 'btn btn-primary'])?>

</div>
