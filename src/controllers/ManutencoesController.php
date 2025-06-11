<?php
namespace src\controllers;

use \core\Controller;
use \core\murano\DB;
use \core\murano\Mensagem;
use \src\handlers\UserHandler;

class ManutencoesController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index() {
        $manutencoes = DB::table('manutencoes as m')
            ->select('m.id, m.titulo, m.descricao, m.data_prevista, m.status, i.nome as instalacao, m.data_prevista as data, u.name as tecnico')
            ->join('instalacoes as i', 'i.id', '=', 'm.instalacao_id')
            ->join('users as u', 'u.id', '=', 'm.responsavel')
            ->where('i.usuario_id', $this->loggedUser->id)
            ->orderBy('m.data_prevista', 'desc')
            ->get();

        $this->render('manutencoes', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Manutenções',
            'manutencoes' => $manutencoes
        ]);
    }

    public function novo() {
        $instalacoes = DB::table('instalacoes')
            ->select()
            ->where('usuario_id', $this->loggedUser->id)
            ->get();
        $this->render('novo_manutencao', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Nova Manutenção',
            'instalacoes' => $instalacoes
        ]);
    }
    public function novoPost() {
        $instalacao_id = filter_input(INPUT_POST, 'instalacao_id', FILTER_VALIDATE_INT);
        $tecnico_id = filter_input(INPUT_POST, 'tecnico_id', FILTER_VALIDATE_INT);
        $titulo = filter_input(INPUT_POST, 'titulo');
        $data_prevista = filter_input(INPUT_POST, 'data_prevista');
        $descricao = filter_input(INPUT_POST, 'descricao');
        $status = filter_input(INPUT_POST, 'status');
        $tipo = filter_input(INPUT_POST, 'tipo');


        if ($instalacao_id && $tecnico_id && $titulo && $data_prevista && $descricao && $status && $tipo) {
            // Inserir nova manutenção no banco de dados
            DB::table('manutencoes')->insert([
                'instalacao_id' => $instalacao_id,
                'usuario_id' => $this->loggedUser->id,
                'responsavel' => $tecnico_id,
                'titulo' => $titulo,
                'data_prevista' => $data_prevista,
                'descricao' => $descricao,
                'status' => $status,
                'tipo' => $tipo
            ])->execute();
            // Obter o ID da última manutenção inserida
            $id = DB::lastId('manutencoes')['id'];
            // Registrar log de criação da manutenção
            DB::table('historico_logs')->insert([
                'manutencao_id' => $id,
                'usuario_id' => $this->loggedUser->id,
                'acao' => 'Manutenção criada: ' . $titulo
            ])->execute();
            // Redirecionar para o dashboard ou lista de manutenções
            Mensagem::success('Manutenção criada com sucesso!');
            $this->redirect('/manutencoes');
        } else {
            // Tratar erro de validação
            Mensagem::error('Por favor, preencha todos os campos corretamente.');
            $this->redirect('/manutencao/novo');
        }
    }

    public function editar($atts = []){

        if(!empty($atts['id'])) {
            $id = $atts['id'];

            $manutencao = DB::table('manutencoes')
            ->select()
            ->where('id', $id)
            ->first();

            $manutencao = DB::table('manutencoes as m')
            ->select('m.id, m.instalacao_id, m.tipo, m.titulo, m.descricao, m.data_prevista, m.status, i.nome as instalacao, m.data_prevista as data, u.name as tecnico')
            ->join('instalacoes as i', 'i.id', '=', 'm.instalacao_id')
            ->join('users as u', 'u.id', '=', 'm.responsavel')
            ->where('m.id', $id)
            ->orderBy('m.data_prevista', 'desc')
            ->one();

            $logs = DB::table('historico_logs')
                ->select()
                ->where('manutencao_id', $id)
                ->orderBy('data_log', 'desc')
                ->get();

            if($manutencao) {
                $instalacoes = DB::table('instalacoes')
                    ->select()
                    ->where('usuario_id', $this->loggedUser->id)
                    ->get();

                $this->render('manutencao', [
                    'loggedUser' => $this->loggedUser,
                    'titulo'     => 'Editar Manutenção',
                    'manutencao' => $manutencao,
                    'instalacoes' => $instalacoes,
                    'logs' => $logs
                ]);
            } else {
                Mensagem::error('Manutenção não encontrada.');
                $this->redirect('/manutencoes');
            }
        } else {
            Mensagem::error('ID da manutenção não informado.');
            $this->redirect('/manutencoes');
        }

    }

    public function editarPost() {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $instalacao_id = filter_input(INPUT_POST, 'instalacao_id', FILTER_VALIDATE_INT);
        $tecnico_id = filter_input(INPUT_POST, 'tecnico_id', FILTER_VALIDATE_INT);
        $titulo = filter_input(INPUT_POST, 'titulo');
        $data_prevista = filter_input(INPUT_POST, 'data_prevista');
        $descricao = filter_input(INPUT_POST, 'descricao');
        $status = filter_input(INPUT_POST, 'status');
        $tipo = filter_input(INPUT_POST, 'tipo');

        if ($id && $instalacao_id && $tecnico_id && $titulo && $data_prevista && $descricao && $status && $tipo) {

            $manutencao = DB::table('manutencoes')
                ->select()
                ->where('id', $id)
                ->first();

            $log = '';

            $anterior = $manutencao['status'];
            $novo = $status;

            if ($anterior !== $novo) {
                if ($novo === 'Concluída') {
                    $log = "Manutenção concluída.";
                } elseif ($anterior === 'Concluída' && $novo !== 'Concluída') {
                    $log = "Manutenção reaberta.";
                } else {
                    $log = "Status alterado de <b>{$anterior}</b> para <b>{$novo}</b>.";
                }
            } else {
                $log = "Manutenção atualizada.";
            }

            DB::table('historico_logs')->insert([
                'manutencao_id' => $id,
                'usuario_id' => $this->loggedUser->id,
                'acao' => $log,
            ])->execute();

            // Atualizar manutenção no banco de dados
            DB::table('manutencoes')->update([
                'instalacao_id' => $instalacao_id,
                'responsavel' => $tecnico_id,
                'titulo' => $titulo,
                'data_prevista' => $data_prevista,
                'descricao' => $descricao,
                'status' => $status,
                'tipo' => $tipo
            ])->where('id', $id)->execute();
            // Redirecionar para o dashboard ou lista de manutenções
            Mensagem::success('Manutenção atualizada com sucesso!');
            $this->returnPage();
        } else {
            // Tratar erro de validação
            Mensagem::error('Por favor, preencha todos os campos corretamente.');
            $this->returnPage();
        }
    }

}
