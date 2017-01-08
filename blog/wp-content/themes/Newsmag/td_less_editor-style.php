<?php
//this is the less compiler used for the editor style


ob_start('ob_gzhandler');
header('Content-type: text/css');


require_once("includes/wp_booster/external/lessc.inc.php");
$less = new lessc;


//import the google fonts ra
echo '
@import url(//fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&subset=latin);
';

echo $less->compileFile("includes/less_files/editor-style.less");

