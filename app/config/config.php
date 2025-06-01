<?php
/**
 * De database verbindingsgegevens
 */
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_NAME')) define('DB_NAME', 'be_examtraining');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');


/**
 * De naam van de virtualhost
 */
if (!defined('URLROOT')) define('URLROOT', 'http://beexamtraining.local');


/**
 * Het pad naar de folder app
 */
if (!defined('APPROOT')) define('APPROOT', dirname(dirname(__FILE__)));

