<?php
namespace src\controllers;

use \core\Controller;
use \core\murano\DB;
use \core\murano\Mensagem;
use \src\handlers\UserHandler;

class InstalacaoController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index() {
        $instalacoes = DB::table('instalacoes')
            ->select()
            ->where('usuario_id', $this->loggedUser->id)
            ->get();

        $this->render('instalacoes', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Instalações',
            'instalacoes' => $instalacoes
        ]);
    }

    public function novo() {
        $this->render('novo_instalacao', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Nova Instalação',
        ]);
    }
    public function novoPost() {
        $nome = filter_input(INPUT_POST, 'nome');
        $setor = filter_input(INPUT_POST, 'setor');
        $observacoes = filter_input(INPUT_POST, 'observacoes');
        if ($nome && $setor) {
            // Inserir nova instalação no banco de dados
            DB::table('instalacoes')->insert([
                'nome' => $nome,
                'setor' => $setor,
                'observacoes' => $observacoes,
                'usuario_id' => $this->loggedUser->id
            ])->execute();
            // Redirecionar para o dashboard ou lista de instalações
            Mensagem::success('Instalação criada com sucesso!');
            $this->redirect('/instalacoes');
        } else {
            // Tratar erro de validação
            Mensagem::error('Por favor, preencha todos os campos corretamente.');
            $this->redirect('/instalacoes/novo');
        }
    }
    public function editar($args) {
        $id = $args['id'] ?? 0;
        if ($id) {
            $instalacao = DB::table('instalacoes')
                ->select()
                ->where('id', $id)
                ->where('usuario_id', $this->loggedUser->id)
                ->first();
            if ($instalacao) {
                $this->render('instalacao', [
                    'loggedUser' => $this->loggedUser,
                    'titulo'     => 'Editar Instalação',
                    'instalacao' => $instalacao
                ]);
            } else {
                Mensagem::error('Instalação não encontrada.');
                $this->redirect('/instalacoes');
            }
        } else {
            Mensagem::error('ID inválido.');
            $this->redirect('/instalacoes');
        }
    }
    public function editarPost() {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'nome');
        $setor = filter_input(INPUT_POST, 'setor');
        $observacoes = filter_input(INPUT_POST, 'observacoes');

        if ($id && $nome && $setor) {
            // Atualizar instalação no banco de dados
            DB::table('instalacoes')->update([
                'nome' => $nome,
                'setor' => $setor,
                'observacoes' => $observacoes
            ])->where('id', $id)
              ->where('usuario_id', $this->loggedUser->id)
              ->execute();
            Mensagem::success('Instalação atualizada com sucesso!');
            $this->returnPage();
        } else {
            Mensagem::error('Por favor, preencha todos os campos corretamente.');
            $this->returnPage();
        }
    }

}
