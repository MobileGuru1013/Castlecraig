<?php
echo "<pre>";
putenv('PATH='. getenv('PATH') .':/home/castlecraig/webapps/castle_craig_wordpress/wp-content');
exec('git add plugins 2>&1', $output);
exec('git commit -m "Updated plugins on server" 2>&1', $output);
exec('git push origin master 2>&1', $output);
var_dump($output);