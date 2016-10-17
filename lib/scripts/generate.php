<?php
$cwd = dirname(__FILE__);
chdir($cwd);

passthru('/usr/bin/env php create-domain-lite.php');
passthru('/usr/bin/env php create-battleaxe-lite.php');
