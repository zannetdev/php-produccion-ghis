<?php
require 'core/config.php';
require 'core/app.config.php';
require 'core/app.functions.php';
require 'core/fpdf_helpers.php';
require 'core/selectors.php';
require 'core/components.php';
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/Database.php';
require 'libs/Session.php';
require 'libs/Hash.php';
require 'vendor/autoload.php';
require 'server/sunat/all.php';

// spl_autoload_register ("banshee_autoload");
$bootstrap = new Bootstrap();
$bootstrap->init();
