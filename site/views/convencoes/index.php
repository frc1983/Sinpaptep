<?php
/* @var $this yii\web\View */
?>
<h1>Convenções</h1>
<div class="row">
    <div class="col-sm-4">
        <?php
        echo "<h2>".$paineis["titulo"]."</h2>";
        foreach ($paineis["documentos"] as $key => $value) {
            echo "<a href='".$value->Url."'>".$value->Nome."</a>";
        }
        ?>
    </div>
    <div class="col-sm-4">
        <?php
        echo "<h2>".$agencias["titulo"]."</h2>";
        foreach ($agencias["documentos"] as $key => $value) {
            echo "<a href='".$value->Url."'>".$value->Nome."</a>";
        }
        ?>
    </div>
    <div class="col-sm-4">
        <?php
        echo "<h2>".$listas["titulo"]."</h2>";
        foreach ($listas["documentos"] as $key => $value) {
            echo "<a href='".$value->Url."'>".$value->Nome."</a>";
        }
        ?>
    </div>
  </div>
