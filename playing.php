<?php

require('../../THEMES/TemplateProcessor.php');

$fp = fopen('../../CACHE/testing.txt', 'w+');
fwrite($fp, 'test');

?>