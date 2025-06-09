<?php
namespace src\controllers;

use \core\Controller;
use \core\murano\DB;
use \core\murano\Mensagem;
use \core\murano\Email;
use \src\handlers\UserHandler;

class LoginController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
    }


    public function loginView() {

        $this->render('login', []);

    }

    public function login() {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if ($email && $password) {
            // Verifica se o usuário existe e a senha está correta
            $email = strtolower($email);
            $user = DB::table('users')->select()
                ->where('email', $email)
                ->one();
            // Verifica se o usuário foi encontrado e se a senha está correta
            if ($user && password_verify($password, $user['password'])) {
                $token = bin2hex(random_bytes(16));
                $_SESSION['token'] = $token;
                DB::table('users')
                    ->update(['token' => $token, 'last_login' => date('Y-m-d H:i:s')])
                    ->where('email', $email)
                    ->execute();
                $this->redirect('/dashboard');
            } else {
                Mensagem::error('E-mail ou senha inválidos.');
                $this->returnPage();
            }
        } else {
            Mensagem::warning('Por favor, preencha todos os campos.');
            $this->returnPage();
        }

    }

    public function passwordReset() {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if ($email) {
            // Verifica se o e-mail existe
            $user = DB::table('users')->select()
                ->where('email', strtolower($email))
                ->one();
            if ($user) {
                // Aqui você deve implementar a lógica para enviar o e-mail de recuperação
                $reset_token = bin2hex(random_bytes(16)); // Gera um token aleatório
                // Atualiza o usuário com o token e a data de expiração
                DB::table('users')
                    ->update(['reset_token' => $reset_token, 'reset_expires' => date('Y-m-d H:i:s', strtotime('+1 hour'))])
                    ->where('email', strtolower($email))
                    ->execute();
                // Envia o e-mail com as instruções de recuperação
                $baseUrl = $this->base();
                $resetLink = $baseUrl.'/reset-password?token=' . $reset_token;
                Email::enviar(
                    $email,
                    $user['name'],
                    'Recuperação de Senha',
                    "Para recuperar sua senha, clique no link abaixo:<br><a href='{$resetLink}'>Recuperar Senha</a><br>O link é válido por 1 hora."
                );
                Mensagem::success('Instruções para recuperação de senha enviadas para o seu e-mail.');
            } else {
                Mensagem::error('E-mail não encontrado.');
            }
        } else {
            Mensagem::warning('Por favor, informe um e-mail válido.');
        }

        $this->returnPage();

    }

    public function passwordResetView() {

        $token = filter_input(INPUT_GET, 'token');
        if ($token) {
            // Verifica se o token é válido
            $user = DB::table('users')->select()
                ->where('reset_token', $token)
                ->where('reset_expires', '>', date('Y-m-d H:i:s'))
                ->one();
            if ($user) {
                // Renderiza a view de redefinição de senha
                $this->render('reset-password', ['token' => $token]);
            } else {
                Mensagem::error('Token inválido ou expirado.');
                $this->redirect('/login');
            }
        } else {
            Mensagem::error('Token não fornecido.');
            $this->redirect('/login');
        }

    }

    public function updatePassword() {

        $newPassword = filter_input(INPUT_POST, 'new_password');
        $confirmPassword = filter_input(INPUT_POST, 'confirm_password');

        if ($newPassword && $confirmPassword) {
            if ($newPassword === $confirmPassword) {
                // Aqui você deve implementar a lógica para atualizar a senha do usuário
                DB::table('users')
                    ->update(['password' => password_hash($newPassword, PASSWORD_DEFAULT), 'reset_token' => null, 'reset_expires' => null])
                    ->where('reset_token', filter_input(INPUT_POST, 'token'))
                    ->execute();
                Mensagem::success('Senha atualizada com sucesso!');
                $this->redirect('/login');
            } else {
                Mensagem::error('As senhas não coincidem.');
            }
        } else {
            Mensagem::warning('Por favor, preencha todos os campos.');
        }

        $this->returnPage();

    }

    public function register() {

        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $passwordConfirm = filter_input(INPUT_POST, 'password_confirm');

        if ($name && $email && $password && $passwordConfirm) {
            if ($password === $passwordConfirm) {
                // Verifica se o e-mail já está cadastrado
                $existingUser = DB::table('users')->select()
                    ->where('email', strtolower($email))
                    ->one();
                if (!$existingUser) {
                    // Cria o novo usuário
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    DB::table('users')->insert([
                        'name' => $name,
                        'email' => strtolower($email),
                        'password' => $hashedPassword,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ])->execute();
                    Mensagem::success('Cadastro realizado com sucesso!');
                } else {
                    Mensagem::error('E-mail já cadastrado.');
                }
            } else {
                Mensagem::error('As senhas não coincidem.');
            }
        } else {
            Mensagem::warning('Por favor, preencha todos os campos.');
        }

        $this->returnPage();

    }
    public function logout() {

         DB::table('users')
            ->update(['token' => ''])
            ->where('id', $this->loggedUser->id)
            ->execute();
        
        $this->redirect('/login');
    }

}