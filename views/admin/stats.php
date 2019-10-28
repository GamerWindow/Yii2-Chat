
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Admin-Statistik';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-stats">
    <h1><?=Html::encode($this->title)?></h1>

    <p> Es sind bereits
<?php
print_r(implode(",", $count));
?> Nachrichten.</p>

<p>Die älteste Nachricht ist vom:
<?php
print_r(implode(",", $alt));
?></p>

<p>Die neueste Nachricht ist vom:
<?php
print_r(implode(",", $neu));
?></p>

<?=Html::a('Zurück', ['/admin'], ['class' => 'btn btn-primary'])?>

</div>
