
<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Grid';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-grid">
<h1><?=Html::encode($this->title)?></h1>
<?=GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'datum',
        'name',
        'inhalt:text:Nachricht',
// ...
    ],
])?>
<p>
Test
</p>

</div>
