<?php
putenv('PATH='. getenv('PATH') .':/home/castlecraig/webapps/castle_craig_wordpress/wp-content');
exec('git pull 2>&1', $output);
var_dump($output); 