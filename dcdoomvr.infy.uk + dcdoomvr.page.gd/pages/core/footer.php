<?php

if (!defined("ON_SITE")) {
    echo "You should not be here. Only follow links!";
    die();
}

$smarty->display('core/footer.tpl');
