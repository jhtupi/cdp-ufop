<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Usuários - Front
$route['usuario/(:num)'] = 'usuarios/usuario/$1/$2'; // Controlador usuarios no método usuario
$route['usuarios/(:num)'] = 'usuarios/index/$1'; 
$route['meu_perfil/(:num)'] = 'usuarios/meu_perfil/$1'; // Rota para meu perfil
$route['meu_perfil/(:num)/(:num)'] = 'usuarios/meu_perfil/$1/$2'; // Rota para meu perfil
// Usuários - Back
$route['admin/usuarios/(:num)'] = 'admin/usuarios/index/$1'; // Rota para visualizar reuniões passadas do usuário
								

// Login								
$route['login'] = 'usuarios/pag_login'; // Rota para login
$route['criar_usuario'] = 'usuarios/criar_usuario'; // Rota para criar usuário
$route['criar_usuario/(:num)'] = 'usuarios/criar_usuario/$1'; // Rota para criar usuário

// Reuniões - Front
$route['criar_reuniao/(:num)/(:num)/(:num)'] = 'reunioes/criar_reuniao/$1/$2/$3'; // Rota para criar reunião
$route['criar_reuniao/(:num)/(:num)'] = 'reunioes/criar_reuniao/$1/$2'; // Rota para criar reunião
$route['reuniao/(:num)'] = 'reunioes/reuniao/$1'; // Rota para visualizar reunião
$route['reuniao/(:num)/(:num)'] = 'reunioes/reuniao/$1/$2'; // Rota para visualizar reunião
$route['participar_reuniao/(:num)/(:num)'] = 'reunioes/participar_reuniao/$1/$2'; // Rota para participar da reunião
$route['sair_reuniao/(:num)/(:num)'] = 'reunioes/sair_reuniao/$1/$2'; // Rota para sair da reunião
$route['editar_reuniao/(:num)'] = 'reunioes/editar_reuniao/$1'; // Rota para editar a reunião
$route['excluir_reuniao/(:num)'] = 'reunioes/excluir_reuniao/$1'; // Rota para editar a reunião
$route['proximas_reunioes/(:num)'] = 'reunioes/proximas_reunioes/$1'; // Paginação
$route['proximas_reunioes'] = 'reunioes/proximas_reunioes'; // Rota para visualizar próximas reuniões do usuário
$route['reunioes_passadas'] = 'reunioes/reunioes_passadas'; // Rota para visualizar reuniões passadas do usuário
$route['reunioes_passadas/(:num)'] = 'reunioes/reunioes_passadas/$1'; // Paginação

// Reuniões - Back
$route['admin/reunioes/(:num)'] = 'admin/reunioes/index/$1'; // Rota para visualizar reuniões passadas do usuário



// Comunidades - Front
$route['criar_comunidade'] = 'comunidades/criar_comunidade'; // Rota para criar comunidade
$route['criar_comunidade/(:num)'] = 'comunidades/criar_comunidade/$1'; // Rota para criar comunidade
$route['comunidades/(:num)'] = 'comunidades/index/$1'; // Rota para visualizar comunidade
$route['comunidade/(:num)'] = 'comunidades/comunidade/$1'; // Rota para visualizar comunidade
$route['comunidade/(:num)/(:num)'] = 'comunidades/comunidade/$1/$2'; // Paginação
$route['participar_comunidade/(:num)/(:num)'] = 'comunidades/participar_comunidade/$1/$2'; // Rota para participar da comunidade
$route['sair_comunidade/(:num)/(:num)'] = 'comunidades/sair_comunidade/$1/$2'; // Rota para sair da comunidade
$route['excluir_comunidade/(:num)/(:num)'] = 'comunidades/excluir_comunidade/$1/$2'; // Rota para excluir a comunidade
$route['editar_comunidade/(:num)'] = 'comunidades/editar_comunidade/$1'; // Rota para editar a comunidade
$route['minhas_comunidades/(:num)'] = 'comunidades/minhas_comunidades/$1'; // Rota para comunidades do usuário
// Comunidades - Back
$route['admin/comunidades/(:num)'] = 'admin/comunidades/index/$1'; // Rota para comunidades do usuário




// Extras
$route['contato/(:num)'] = 'contato/index/$1'; // Rota para o envio de formulário de contato
$route['admin/materiais'] = 'admin/reunioes/materiais'; // Rota para o envio de formulário de contato
$route['(:num)'] = 'home/index/$1'; // Rota para paginação da home page
