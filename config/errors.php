<?php

$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
// Set Whoops as the default error and exception handler used by PHP:
$whoops->register();