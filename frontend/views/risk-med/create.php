<?php

use yii\helpers\Html;


?>
<div class="risk-med-create">

<!--h1><?= Html::encode($this->title) ?></h1-->

	<?= $this->render('_form', [
		'model' => $model,
		'initialPreview' => [],
		'initialPreviewConfig' => [],
		]) ?>

	</div>
