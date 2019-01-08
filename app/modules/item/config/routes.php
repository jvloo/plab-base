<?php
defined('BASEPATH') or exit('No direct script access allowed.');

$route['item/(:any)/import'] = 'item/index/$1/import';
$route['item/(:any)'] = 'item/index/$1';
