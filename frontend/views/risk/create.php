<?php

use yii\helpers\Html;

/* $this->title = 'เขียนใบความเสี่ยง';
  $this->params['breadcrumbs'][] = ['label' => 'จัดการความเสี่ยง', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $this->title; */
?>
<!--div class="risk-create"-->

<?=
$this->render('_form', [
    'model' => $model,
])
?>

<!--/div-->
