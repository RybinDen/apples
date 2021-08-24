<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Apple', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'color',
            'date_create:RelativeTime',
            'date_down:relativeTime',
            'statusName',
            'conditionName',
            'size',

            [
'class' => 'yii\grid\ActionColumn',
    'template' => '{down} {eat}',
    'buttons' => [
        'down' => function ($url) {
            return Html::a('Сорвать', $url, ['title' => 'Сорвать яблоко', 'data-pjax' => '0']);
        },
        'eat' => function ($url) {
            return Html::a('Откусить', $url, ['title' => 'Откусить яблоко', 'data-pjax' => '0']);
        },
    ],
],
        ],
    ]); ?>


</div>
