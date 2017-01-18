<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_price')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'btn_add']) ?>
    </div>
    <!--<input type="button" id="btn_add" value="OK">-->
    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile('@web/js/socket.io/dist/socket.io.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$head = '$("document").ready(function(){';
$head.='
  var socket = io.connect("http://localhost:8080");
  $("#btn_add").click(function(){
    socket.emit("add","addOK");
  });
';
$head.='});';
$this->registerJs($head);
?>
