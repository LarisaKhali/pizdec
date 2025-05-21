<?php

use app\models\Card;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CardSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Card', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'binding_id',
            'name',
            'author',
            [
                    'attribute' => 'condition_name',
                    'value' => function ($model) {
                        return $model->getConditionName();
                    }
            ],
            //'sharing_status',
            //'publishing_name',
            //'year',
            //'condition_id',
            [
                    'content' => function ($model) {
                        if ($model->is_archive == 0 && $model->is_published == 0) {
                            return Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        }
                    },
                'label' => 'Публикация'
            ],
        ],
    ]); ?>


</div>
