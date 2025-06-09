<?php
namespace core\murano;

class Mensagem {

    /**
     * Exibe uma mensagem de erro
     * @param string $mensagem
     */
    public static function error($mensagem = "Ocorreu um erro inesperado."){
        $_SESSION['flash'] = 'danger@'.$mensagem;
    }
    /**
     * Exibe uma mensagem de aviso
     * @param string $mensagem
     */
    public static function warning($mensagem = "Atenção! Verifique os dados informados."){
        $_SESSION['flash'] = 'warning@'.$mensagem;
    }
    /**
     * Exibe uma mensagem de sucesso
     * @param string $mensagem
     */
    public static function success($mensagem = "Operação realizada com sucesso!"){
        $_SESSION['flash'] = 'success@'.$mensagem;
    }
    
}