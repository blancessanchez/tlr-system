<?php
    if (!isset($params['escape']) || $params['escape'] !== false) {
        $message = h($message);
    }
?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <p><i class="icon fa fa-remove"></i><?= $message ?></p>
</div>
