<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin();?>

    <?=$form->field($message, 'name')?>

    <?=$form->field($message, 'inhalt')?>

    <div class="form-group">
        <?=Html::submitButton('Abschicken', ['class' => 'btn btn-primary'])?>
    </div>

<?php ActiveForm::end();?>