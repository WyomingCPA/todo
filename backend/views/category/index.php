<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="card-text">Последняя выкуренная: <b><?= $interval_smoking; ?></b></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $index, $widget, $grid){
            if ($model->parent_id != 0 || $model->parent_id != null)
            {
                return ['style' => 'visibility:collapse;'];
            }
            else 
            {
                return ['style' => 'visibility:visible;'];
            }
            
        },
        'columns' => [
            'id', 
            [
                'attribute' => 'title',
                'value' => function ($model) {
                    if ($model->parent_id == 0 || $model->parent_id == null)
                    {
                        return Html::a($model->title, ['category/sub-category', 'parent_id' => $model->id, []]);
                    }
                    else
                    {
                        return $model->title;
                    }    
                },                
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{create} {view} {recommended} {update} {delete}',
                'buttons' => [
                    'create' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-plus"></i>', $url);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url);
                    },
                    'recommended' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-star"></i>', $url);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-pen"></i>', $url);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-trash"></i>', $url);
                    }
                ],
            ], 'last_update', 'count'
        ],
    ]); ?>

</div>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h4 class="text-center">One Day</h4>
        </div>
        <div class="col-sm-4">
            <h4 class="text-center">One Month</h4>
        </div>
        <div class="col-sm-4">
            <h4 class="text-center">Three Month</h4>
        </div>
    </div>
    <div class="row">
        <?= $this->render('_one_day_pie', ['pie_data' => $pie_data_day]); ?>
        <?= $this->render('_one_month_pie', ['pie_data' => $pie_data_one]); ?>
        <?= $this->render('_three_month_pie', ['pie_data' => $pie_data_three]); ?>
    </div>
</div>