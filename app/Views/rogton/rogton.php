<?php
declare(strict_types=1);
$formdata = '';
$labeldata = ['class' => 'control-label m-0 font-weight-bold'];
$inputdata = ['class' => 'form-control border-0 bg-info text-warning', 'readonly' => '']; ?>
<div class="bg-warning py-2 text-dark">
	<div class="ml-4 text-center"><?= lang('Rogton.infoHead'); ?></div>
	<div class="form-group col-md-4"><?= $kesz ?></div>
	<?php echo form_open('rogton/belepes', $formdata); ?>
	<div class="form-row ml-4">
		<div class="form-group col-md-4">
			<?php echo form_label(lang('Rogton.infoName'), 'label', $labeldata); ?>
			<input type="text" name="nev" class="form-control" id="name" aria-label="name"
				   placeholder="<?= lang('Rogton.infoNamePlace'); ?>">
		</div>

		<div class="form-group col-md-4">
			<?php echo form_label(lang('Rogton.infoKarNum'), 'label', $labeldata); ?>
			<input type="text" name="karsznum" class="form-control" id="karszalag" aria-label="karszalag"
				   placeholder="<?= lang('Rogton.infoKarNumPlace'); ?>">
		</div>
	</div>
	<div class="form-row ml-4">
		<div class="form-group col-md-4">
			<?php echo form_label(lang('Rogton.infoMelyikFellepo'), 'label', $labeldata); ?>
			<select class="form-control" id="csoportok" name="csoportok" aria-label="csoportok">
				<option id="1000" value="1000" selected></option>
				<?php
				foreach ($csoplist as $row) {
					echo '<option id="' . $row->sorsz . '" value="' . $row->sorsz . '">';
					echo $row->cegnev;
					echo "</option>\n";
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-row ml-4">
		<div class="form-group col-md-4">
			<?= form_label(lang('Karszalag.karszMegj'), 'megjegy', $labeldata); ?>
			<textarea class="form-control mt-2" name="megjegy" id="megjegy" aria-label="megjegyzes"
					  placeholder="<?= lang('Karszalag.karszMegj'); ?>"></textarea>
		</div>
	</div>
	<button type="submit" id="egybelep" class="btn btn-success"><?= lang('Karszalag.karszBelep'); ?>
	</button>
</div>
