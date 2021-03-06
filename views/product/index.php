<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['options' => ['data-pjax' => true ], 'id'=>'countries']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'จัดการประเภทสมาชิก'],
        'responsive'=>true,
        'hover'=>true,
        //'pjax'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_code',
            'product_name',
            'product_price',
            'created_at',

            [
            'class' => 'yii\grid\ActionColumn',
            'buttonOptions'  => ['class' => 'btn btn-default'],
            'header'         => '<font size=2>จัดการ</font>',
            'headerOptions'  => ['class' => 'text-center skip-export'],
            'contentOptions' => ['class' => 'text-center skip-export', 'noWrap' => true],
            'template'       => '{update} {delete1}',
            'buttons'        => [
                    'delete1' => function($url, $model){
                        $btn_del =  Html::a('<span class="glyphicon glyphicon-trash"></span>', $url = null, ['title'=>'Delete', 'data-pjax'=>'0','class'=>'btn btn-danger','onclick'=>'
                                $.post("index.php?r=product/delete&id='.$model->id.'",function(data){
                                    console.log(data);
                                    var socket = io.connect("http://localhost:8080");
                                   if(data){
                                     socket.emit("delete","DeleteOK");
                                   }
                                    
                                });
                            ']);
                        return $btn_del;
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
<!--<ul class="list-group"></ul>-->
<?php
$this->registerJsFile('@web/js/socket.io/dist/socket.io.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$head = '$("document").ready(function(){';
$head.='
   var socket = io.connect("http://localhost:8080");

  //Add
  socket.on("addOK",function(data){
     $.pjax.reload({container:"#countries",async:false});  //Reload GridView
  });

  //Delete
  socket.on("deleteOK",function(data){
     $.pjax.reload({container:"#countries",async:false});  //Reload GridView
  });
';
$head.='});';
$this->registerJs($head);
?>
