<?php

use App\Controllers\MainController;

require_once 'vendor/autoload.php';

(new MainController())->getIbanInfo();
