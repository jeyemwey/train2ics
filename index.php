<?php

namespace jeyemwey\Train2ICS;

include "vendor/autoload.php";

$fn = H::In("fn");
$fn = H::v($fn, "frontpage");

if (!method_exists(new App, $fn)) {
	$fn = "frontpage";
}
call_user_func_array([new App, $fn], []);
