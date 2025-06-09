<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
//LOGIN, ESQUECEU A SENHA, NOVA SENHA
$router->get('/login', 'LoginController@loginView');
$router->post('/login', 'LoginController@login');
$router->get('/reset-password', 'LoginController@passwordResetView');
$router->post('/password-reset', 'LoginController@passwordReset');
$router->post('/new-password', 'LoginController@updatePassword');
$router->post('/sigin', 'LoginController@register');
$router->get('/logout', 'LoginController@logout');
//DASHBOARD
$router->get('/dashboard', 'DashboardController@index');
//manuTEÇÕES
$router->get('/manutencoes', 'ManutencoesController@index');
$router->get('/manutencao/novo', 'ManutencoesController@novo');
$router->post('/manutencao/novo', 'ManutencoesController@novoPost');
$router->get('/manutencao/detalhes/{id}', 'ManutencoesController@editar');
$router->post('/manutencao/detalhes', 'ManutencoesController@editarPost');
//INSTALAÇÕES
$router->get('/instalacoes', 'InstalacaoController@index');
$router->get('/instalacao/detalhes/{id}', 'InstalacaoController@editar');
$router->post('/instalacao/detalhes', 'InstalacaoController@editarPost');
$router->get('/instalacao/novo', 'InstalacaoController@novo');
$router->post('/instalacao/novo', 'InstalacaoController@novoPost');



