<?php

if(( $_GET['info'] ?? '' ) === 'xdebug' ) {
    xdebug_info();
    exit;
}

phpinfo();
exit;
