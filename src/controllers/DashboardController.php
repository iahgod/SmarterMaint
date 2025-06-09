<?php
namespace src\controllers;

use \core\Controller;
use \core\murano\DB;
use \src\handlers\UserHandler;

class DashboardController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }
    
    public function index() {
        
        // Abertas
        $totalAbertas = DB::table('manutencoes')
            ->select()
            ->where('status', 'aberta')
            ->count();

        // Concluidas
        $totalConcluidas = DB::table('manutencoes')
            ->select()
            ->where('status', 'concluida')
            ->count();

        // Atrasadas (status != 'concluida' e data_prevista < hoje)
        $totalAtrasadas = DB::table('manutencoes')
            ->select()
            ->where('status', '!=', 'Concluida')
            ->where('data_prevista', '<', date('Y-m-d'))
            ->count();
        $totalAtrasadasArray = DB::table('manutencoes')
            ->select('id')
            ->where('status', '!=', 'Concluida')
            ->where('data_prevista', '<', date('Y-m-d'))
            ->get();
        if($totalAtrasadasArray){
            foreach($totalAtrasadasArray as $atrasada){
                DB::table('manutencoes')->update([
                    'status' => 'Atrasada'
                ])->where('id', $atrasada['id'])
                ->execute();
            }
        }

        // Próximas manutenções (data_prevista >= hoje E <= +7 dias)
        $proximasManutencoes = DB::table('manutencoes')->select()
            ->where('status', '!=', 'concluida')
            ->where('data_prevista', '>=', date('Y-m-d'))
            ->where('data_prevista', '<=', date('Y-m-d', strtotime('+7 days')))
            ->orderBy('data_prevista', 'asc')
            ->get();
        
        $ultimasManutencoes = DB::table('manutencoes as m')
        ->select('m.id, m.titulo, m.descricao, m.data_prevista, m.status, i.nome as instalacao, m.data_prevista as data, u.name as tecnico')
        ->join('instalacoes as i', 'i.id', '=', 'm.instalacao_id')
        ->join('users as u', 'u.id', '=', 'm.responsavel')
        ->where('i.usuario_id', $this->loggedUser->id)
        ->orderBy('m.data_prevista', 'desc')
        ->limit(7)
        ->get();


        $this->render('dashboard', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Dashboard',
            'totalAbertas' => $totalAbertas,
            'totalConcluidas' => $totalConcluidas,
            'totalAtrasadas' => $totalAtrasadas,
            'proximasManutencoes' => $proximasManutencoes,
            'ultimasManutencoes' => $ultimasManutencoes
        ]);
        
    }


}
