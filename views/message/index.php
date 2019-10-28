<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Chat';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="message-index">
    <h1><?=Html::encode($this->title)?></h1>

 <?php
foreach ($messages as $message) {

    echo $message->datum . " " . $message->name . " " . $message->inhalt . "<br />";
}
?>
</div>
