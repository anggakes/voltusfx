<?php 

/* Setting for production environtment */

$development = array(
	"BASE_URL"		=> "http://localhost/voltusfx/",
	"DB_HOST"		=> "localhost",
	"DB_NAME"		=> "voltus",
	"DB_USERNAME"	=> "root",
	"DB_PASSWORD"	=> ""
);

/* Setting for development environtment */

$production = array(
	"BASE_URL"		=> "",
	"DB_HOST"		=> "localhost",
	"DB_NAME"		=> "voltus",
	"DB_USERNAME"	=> "angga",
	"DB_PASSWORD"	=> "xeWKUdZMe23CAxAX"
);


/* select the array variable that suit your environment */

$env = $development;


