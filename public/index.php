<?php

require_once("../bootstrap.php");

$application = new Papi\Application();
$application->loadDependencies();
$application->loadRoutes();
$application->run();
