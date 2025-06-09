<?php
namespace src\handlers;
use \core\murano\DB;

class PacienteHandler {

    /**
     * Empresa
     * Status
     * Operador
     * Ordem
     *
     * @var string
     * @var string
     * @var string
     * @var string
     */
    public static function get( $id_empresa, $status = 'Hospedado', $operador = '=', $ordem = 'asc' ){

        $listaAtivos = DB::table('paciente')->select()
        ->where('id_empresa', $id_empresa)
        ->where('diaria', 0)
        ->where('status', $operador, $status)
        ->orderBy('nome', $ordem)->get();

        return $listaAtivos;

    }

    public static function ativos($id_empresa){
        $pacientesInternados = DB::table('paciente')->select()
            ->where('id_empresa', $id_empresa)
            ->where('diaria', 0)
            ->where('status', 'Hospedado')
            ->orderBy('nome', 'asc')
            ->get();

        $pacientesDiaria = DB::table('paciente')->select()
            ->where('id_empresa', $id_empresa)
            ->where('diaria', 1)
            ->where('status', 'Hospedado')
            ->orderBy('nome', 'asc')
            ->get();

            return array_merge($pacientesInternados, $pacientesDiaria);
    }

    /**
     * Pct
     *
     * @var string
     */
    public static function ehAtivo( $id ){

        $ativo = DB::table('paciente')->select()
        ->where('id', $id)
        ->where('status', '=', 'Hospedado')
        ->orWhere('status', '=', 'Diária')
        ->exists();

        return $ativo;

    }

    /**
     * Empresa
     *
     * @var int
     */
    public static function GetAtivos( $id ){

        $pacientesHospedado = DB::table('paciente')->select()
        ->where('id_empresa', $id)
        ->where('status', '=', 'Hospedado')
        ->orderBy('nome', 'asc')
        ->get();

        $pacientesDiaria = DB::table('paciente')->select()
        ->where('id_empresa', $id)
        ->where('status', '=', 'Diária')
        ->orderBy('nome', 'asc')
        ->get();

        return array_merge($pacientesHospedado, $pacientesDiaria);

    }

    public static function GetInavos( $id ){

        $pacienteInativo = DB::table('paciente')->select()
        ->where('id_empresa', $id)
        ->where('status', '!=', 'Hospedado')
        ->orderBy('nome', 'asc')
        ->get();

        return $pacienteInativo;

    }
    /**
     * Paciente
     * Empresa
     *
     * @var string
     * @var string
     */
    public static function getOne( $paciente, $id_empresa ){

        $paciente = DB::table('paciente')->select()
        ->where('id_empresa', $id_empresa)
        ->where('id', $paciente)
        ->one();

        return $paciente;

    }

    /**
     * Paciente
     * Empresa
     *
     * @var string
     * @var string
     */
    public static function getEvolucaoPct( $paciente, $id_empresa, $limite = 10 ){

        $evolucao = DB::table('evolucao')->select()
        ->where('id_empresa', $id_empresa)
        ->where('id_paciente', $paciente)
        ->orderBy('id', 'desc')
        ->limit($limite)
        ->get();

        return $evolucao;

    }

    /**
     * Paciente
     * Empresa
     *
     * @var string
     * @var string
     */
    public static function getEvolucaoPctGrupo( $paciente, $id_empresa, $grupo ){

        $evolucao = DB::table('evolucao')->select()
        ->where('id_empresa', $id_empresa)
        ->where('id_paciente', $paciente)
        ->where('tipoE', 'like', $grupo)
        ->orderBy('id', 'desc')
        ->get();

        return $evolucao;

    }

    /**
     * Paciente
     * Empresa
     *
     * @var string
     * @var string
     */
    public static function getSinaisPct( $paciente, $id_empresa ){

        $sinais = DB::table('ssvv')->select()
        ->where('id_empresa', $id_empresa)
        ->where('id_paciente', $paciente)
        ->orderBy('id', 'desc')
        ->get();

        return $sinais;

    }
    
}
