<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="event-index">

    <?=
    yii2fullcalendar\yii2fullcalendar::widget([
        'events' => $events,
        'options' => [
        'lang' => 'th',
        //... more options to be defined here!
        ],
            //'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
        ]);
        ?>

    </div>
