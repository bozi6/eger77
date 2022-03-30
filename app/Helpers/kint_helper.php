<?php
require APPATH . 'ThridParty/vendor/kint-php/kint/init.php';
require APPATH . 'ThridParty/vendor/kint-php/kint-js/init.php';

Kint::$enabled_mode == ENVIRONMENT === 'development';
