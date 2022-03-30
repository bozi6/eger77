<div class="bg-info">
	<div class="d-print-none text-center m-4"><small>
			<?= $okos; ?></small></div>
	<div class="d-print-none bg-dark row">
		<div class="col m-1">
			<p><?= lang('Footer.infoPageRender', [timer()->getElapsedTime('render view')], $nyelv) ?></p>
		</div>
		<?php if (ENVIRONMENT === 'development'): ?>
			<div class="col">
				<p class="text-center">PHP verzió: <?= phpversion() ?></p>
			</div>
			<div class="col">
				<p class="text-right">CodeIgniter verzió: <strong><?= CodeIgniter\CodeIgniter::CI_VERSION ?></strong>
					<br>Környezet: <strong> <?= ENVIRONMENT ?></strong></p>
			</div>
		<?php endif; ?>

	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo base_url('/assets/jquery/jquery.js'); ?>"></script>
<script src="<?php echo base_url('/assets/jquery-ui/jquery-ui.js'); ?>"></script>
<script src="<?php echo base_url('/assets/popper/popper.js'); ?>"></script>
<script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('/assets/tablesorter/js/jquery.tablesorter.js'); ?>"></script>
<script src="<?php echo base_url('/assets/tablesorter/js/jquery.tablesorter.widgets.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/' . $jsoldal . '.js'); ?>"></script>
</body>
</html>
