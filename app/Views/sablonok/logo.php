<div class="container pt-4  bg-info">
    <div class="shadow d-print-none row bg-dark text-light p-2" id="logo">
        <div class="col-sm-2" id="block">
            <a href="<?php echo base_url(); ?>">
                <img width="91" height="79" id="thtlogo" alt="thtlog19"
                     src="<?php echo base_url('images/tht_logo.svg'); ?>">
            </a>
        </div>
        <div class="col-sm-10" id="cim">
            <h4>
                <?= lang("Logo.logoCim", [], $nyelv); ?>
            </h4>
            <?= lang("Logo.logoDatum", [], $nyelv) . date("Y-m-d H:i"); ?>
        </div>
    </div>
    <div class="row d-print-none">
        <ul class="nav">
            <li class="nav-item">
                <a class="btn nav-link p-0" id="hungarian" href="<?php echo base_url(); ?>/langsw/switchlang/hu"><img
                            alt="hunflag" width="32" height="16" src="<?php echo base_url('images/hun.png') ?>"></a>
            </li>
            <li class="nav-item">
                <a class="btn nav-link p-0" id="english" href="<?php echo base_url(); ?>/langsw/switchlang/en"><img
                            alt="enusflag" width="32" height="16" src="<?php echo base_url('images/ukusa.jpg') ?>"></a>
            </li>
            <li class="nav-item">
                <a class="btn nav-link p-0" id="deutsch" href="<?php echo base_url(); ?>/langsw/switchlang/de"><img
                            alt="germanyflag" width="32" height="16" src="<?php echo base_url('images/germany.png') ?>"></a>
            </li>
            <li class="nav-item">
                <a class="btn nav-link p-0" id="arabic" href="<?php echo base_url(); ?>/langsw/switchlang/ar"><img
                            alt="arabicflag" width="32" height="16"
                            src="<?php echo base_url('images/arabic.png') ?>"></a>
            </li>
        </ul>
    </div>
    <?= $menu; ?>
