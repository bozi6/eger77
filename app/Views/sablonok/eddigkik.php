<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row m-3 d-print-none" id="eddigkik">
	<div class="col-sm-4"><?= $this->lang->line('osszbel'); ?>
		<?= $stat['ossz'] ?>
	</div>
	<div class="col-sm-4"><?= $this->lang->line('belepett'); ?>
		<?= $stat['benne'] ?>
	</div>
	<div class="col-sm-4"><?= $this->lang->line('hatravan'); ?>
		<?= $stat['ossz'] - $stat['benne'] ?>
	</div>
</div>
