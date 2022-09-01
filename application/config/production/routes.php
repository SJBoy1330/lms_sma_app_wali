<?php

defined('BASEPATH') or exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| URI ROUTING

| -------------------------------------------------------------------------

| This file lets you re-map URI requests to specific controller functions.

|

| Typically there is a one-to-one relationship between a URL string

| and its corresponding controller class/method. The segments in a

| URL normally follow this pattern:

|

|	example.com/class/method/id/

|

| In some instances, however, you may want to remap this relationship

| so that a different class/function is called than the one

| corresponding to the URL.

|

| Please see the user guide for complete details:

|

|	https://codeigniter.com/user_guide/general/routing.html

|

| -------------------------------------------------------------------------

| RESERVED ROUTES

| -------------------------------------------------------------------------

|

| There are three reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router which controller/method to use if those

| provided in the URL cannot be matched to a valid route.

|

|	$route['translate_uri_dashes'] = FALSE;

|

| This is not exactly a route, but allows you to automatically route

| controller and method names that contain dashes. '-' isn't a valid

| class or method name character, so it requires translation.

| When you set this option to TRUE, it will replace ALL dashes in the

| controller and method URI segments.

|

| Examples:	my-controller/index	-> my_controller/index

|		my-controller/my-method	-> my_controller/my_method

*/

$route['default_controller'] = 'auth/controller_ctl';

$route['auth']  = 'auth/controller_ctl';

$route['auth/(:any)'] = 'auth/controller_ctl/$1';

$route['auth/(:any)/(:any)'] = 'auth/controller_ctl/$1/$2';


$route['func_auth']  = 'auth/function_ctl';

$route['func_auth/(:any)'] = 'auth/function_ctl/$1';

$route['func_auth/(:any)/(:any)'] = 'auth/function_ctl/$1/$2';


$route['home']  = 'home/controller_ctl';

$route['home/(:any)'] = 'home/controller_ctl/$1';

$route['home/(:any)/(:any)'] = 'home/controller_ctl/$1/$2';


$route['notifikasi']  = 'notifikasi/controller_ctl';

$route['notifikasi/(:any)'] = 'notifikasi/controller_ctl/$1';

$route['notifikasi/(:any)/(:any)'] = 'notifikasi/controller_ctl/$1/$2';


$route['rapot']  = 'rapot/controller_ctl';

$route['rapot/(:any)'] = 'rapot/controller_ctl/index/$1';

$route['rapot/(:any)/(:any)'] = 'rapot/controller_ctl/$1/$2';



$route['spp']  = 'spp/controller_ctl';

$route['spp/(:any)'] = 'spp/controller_ctl/$1';

$route['spp/(:any)/(:any)'] = 'spp/controller_ctl/$1/$2';

$route['spp/(:any)/(:any)/(:any)'] = 'spp/controller_ctl/$1/$2/$3';



$route['toko']  = 'toko/controller_ctl';

$route['toko/(:any)'] = 'toko/controller_ctl/$1';

$route['toko/(:any)/(:any)'] = 'toko/controller_ctl/$1/$2';



$route['profil']  = 'profil/controller_ctl';

$route['profil/(:any)'] = 'profil/controller_ctl/$1';

$route['profil/(:any)/(:any)'] = 'profil/controller_ctl/$1/$2';


$route['func_profil']  = 'profil/function_ctl';

$route['func_profil/(:any)'] = 'profil/function_ctl/$1';

$route['func_profil/(:any)/(:any)'] = 'profil/function_ctl/$1/$2';


$route['surat']  = 'surat/controller_ctl';

$route['surat/(:any)'] = 'surat/controller_ctl/$1';

$route['surat/(:any)/(:any)'] = 'surat/controller_ctl/$1/$2';



$route['kontak']  = 'kontak/controller_ctl';

$route['kontak/(:any)'] = 'kontak/controller_ctl/$1';

$route['kontak/(:any)/(:any)'] = 'kontak/controller_ctl/$1/$2';




$route['func_rapot']  = 'rapot/function_ctl';

$route['func_rapot/(:any)'] = 'rapot/function_ctl/$1';

$route['func_rapot/(:any)/(:any)'] = 'rapot/function_ctl/$1/$2';



$route['linker']  = 'linker/controller_ctl';

$route['linker/(:any)'] = 'linker/controller_ctl/$1';

$route['linker/(:any)/(:any)'] = 'linker/controller_ctl/$1/$2';

$route['linker/(:any)/(:any)/(:any)'] = 'linker/controller_ctl/$1/$2/$3';

$route['linker/(:any)/(:any)/(:any)/(:any)'] = 'linker/controller_ctl/$1/$2/$3/$4';

$route['linker/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'linker/controller_ctl/$1/$2/$3/$4/$5';


$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;
