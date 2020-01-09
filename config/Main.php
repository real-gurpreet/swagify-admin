<?php
$fileLocation = '/etc/config/config.json';
$config = json_decode(file_get_contents($fileLocation), true);
return [
    	'config' => $config
];
