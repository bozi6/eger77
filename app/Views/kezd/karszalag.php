<?php
$formdata = '';
$labeldata = array('class' => 'control-label m-0 font-weight-bold');
$inputdata = array('class' => 'form-control border-0 bg-info text-warning', 'readonly' => ''); ?>
<?php echo form_open('kezd/belepes', $formdata); ?>
<?php echo form_hidden('sorsz', 'sorsz'); ?>
<?php echo form_hidden('belepett', 'bel'); ?>
<form>
    <div class="form-row">
        <div class="form-group col-md-4">
            <?php echo form_label(lang('Karszalag.karszNev', [], $nyelv), 'label', $labeldata); ?>
            <input type="text" name="nev" class="form-control" id="title"
                   placeholder="<?= lang('Karszalag.karszBelnev', [], $nyelv) ?>">
        </div>
        <div class="form-group col-md-4">
            <?php echo form_label(lang('Karszalag.karszHkarsz', [], $nyelv), 'karsz', $labeldata); ?>
            <input type="text" name="befiz" class="form-control" disabled="disabled" id="karsz"
                   placeholder="<?= lang('Karszalag.karszsz') ?>">
        </div>
        <div class="form-group col-md-4">
            <?= form_label(lang('Karszalag.karszGykarsz', [], $nyelv), 'gykarsz', $labeldata); ?>
            <input type="text" name="gybefiz" class="form-control" disabled="disabled" id="gykarsz"
                   placeholder="<?= lang('Karszalag.karszsz') ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <?= form_label(lang('Karszalag.karszSzido', [], $nyelv), 'szul_datum', $labeldata);
            $inputdata['id'] = 'szul_datum';
            echo form_input('szul_datum', '', $inputdata); ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <?= form_label(lang('Karszalag.karszTnev', [], $nyelv), 'cegnev', $labeldata);
            $inputdata['id'] = 'cegnev';
            echo form_input('cegnev', '', $inputdata); ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <?= form_label(lang('Karszalag.karszBes', [], $nyelv), 'besorolas', $labeldata);
            $inputdata['id'] = 'besorolas';
            echo form_input('besorolas', '', $inputdata); ?>
        </div>
        <div class="form-group col-md-6">
            <?= form_label(lang('Karszalag.karszProg', [], $nyelv), 'programresz', $labeldata);
            $inputdata['id'] = 'programresz';
            echo form_input('programresz', '', $inputdata); ?>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <?= form_label(lang('Karszalag.karszMegj', [], $nyelv), 'megjegy', $labeldata); ?>
            <input type="text" name="megjegy" class="form-control mt-2" id="megjegy"
                   placeholder="<?= lang('Karszalag.karszMegj', [], $nyelv); ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" id="egybelep" class="btn btn-success"
                    disabled="disabled"><?= lang('Karszalag.karszBelep', [], $nyelv); ?></button>
            <?= lang('Karszalag.karszBeleptet', [$stat], $nyelv); ?>
        </div>
    </div>
</form>
