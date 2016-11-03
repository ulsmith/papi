<?php

/**
 * Routes
 * Load all system routes from a single location
 */

// Base route
$this->group("/", function () {
    $this->get("", Papi\Controllers\Index::class.':index')->setArgument('access', 'public');
});

// Account route
$this->group("/account", function () {
   $this->get("/login", Papi\Controllers\Account::class.':login')->setArgument('access', 'public');
   $this->post("/login", Papi\Controllers\Account::class.':login')->setArgument('access', 'public');
   $this->get("/logout", Papi\Controllers\Account::class.':logout')->setArgument('access', 'public');
});
