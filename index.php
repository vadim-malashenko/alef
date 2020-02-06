<?php

function d () {echo '<pre>' . print_r (func_get_args(), true) . '</pre>';}

require __DIR__ . '/src/App.php';

spl_autoload_register(['\Alef\App', 'autoload']);

$app = new \Alef\App ();
$app->start ();
