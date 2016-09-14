<?php

use yii\helpers\Html;

?>
<!--div class="risk-create"-->

<?=
$this->render('_form', [
    'model' => $model,
    'initialPreview' => [],
    'initialPreviewConfig' => [],
])
?>

<!--/div-->