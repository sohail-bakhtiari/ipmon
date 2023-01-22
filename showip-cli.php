<?php
// https://stackoverflow.com/a/22146339/1119611

for ($n = 1; $n < $argc; $n++) {
    list($k, $v) = explode('=', $argv[$n], 2);
    $_GET[$k] = $v;
    print("$k:$v\n");
}

require_once('showip.php');
