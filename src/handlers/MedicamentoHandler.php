<?php
namespace src\handlers;
use \core\murano\DB;

class MedicamentoHandler {

    /**
     * id
     * empresa
     *
     * @var int
     * @var int
     */
    public static function getMedicamento( $id, $id_empresa ){

        $medicamentos = DB::table('medicamento_paciente')->select()
        ->where('id_empresa', $id_empresa)
        ->where('id_paciente', $id)
        ->orderBy('id', 'asc')->get();

        return $medicamentos;

    }

    /**
     * id
     *
     * @var int
     */
    public static function getMedicamentoOne( $id ){

        $medicamento = DB::table('meds_novo')->select()
        ->where('id', $id)
        ->one();

        return $medicamento;

    }

    /**
     * id
     *
     * @var int
     */
    public static function getMedicamentoPaciente( $id ){

        $medicamento = DB::table('medicamento_paciente')->select()
        ->where('id', $id)
        ->one();

        return $medicamento;

    }

    public static function addCheck($horario, $medicamento, $paciente){

        $medicamentoC = DB::table('medicamento_check')->select()
        ->where('medicamento_id', $medicamento)
        ->where('horario', $horario)
        ->where('id_paciente', $paciente)->one();

        if(!$medicamentoC){

            DB::table('medicamento_check')->insert([
                'id_paciente' => $paciente,
                'medicamento_id' => $medicamento,
                'horario' => $horario,
                'cadastro' => date('Y-m-d')
            ])->execute();

        }

    }

    public static function addCheck2($horario, $medicamento, $paciente){

        $medicamentoC = DB::table('medicamento_check')->select()
        ->where('medicamento_id', $medicamento)
        ->where('horario', $horario)
        ->where('id_paciente', $paciente)
        ->where('cadastro', date('Y-m-d'))->one();

    //     echo '<pre>';
    //     print_r($medicamento.'a');
    //     echo '</pre>';
    //     exit;

        if(!$medicamentoC){
            
            DB::table('medicamento_check')->insert([
                'id_paciente' => $paciente,
                'medicamento_id' => $medicamento,
                'horario' => $horario,
                'cadastro' => date('Y-m-d')
            ])->execute();

        }

    }


    public static function getMedicamentosChecarNull($id){

        $dados = DB::table('medicamento_check')
            ->select('medicamentos.nome as medicamento, medicamento_check.id as id, medicamento_check.horario as horario, medicamento_check.cadastro')
            ->join('medicamentos', 'medicamentos.id', '=', 'medicamento_check.medicamento_id')
            ->where('medicamento_check.id_paciente', $id)
            ->whereNull('medicamento_check.data_check')
            ->orderBy('medicamento_check.horario', 'asc')
            ->get();

            return $dados;
    }
    public static function getMedicamentosChecar($id){

        $dados = DB::table('medicamento_check')
            ->select('meds_novo.PrincipioAtivo as medicamento, medicamento_check.id as id, medicamento_check.horario as horario, medicamento_check.checado_por, medicamento_check.data_check, medicamento_check.status, medicamento_check.cadastro')
            ->join('meds_novo', 'meds_novo.ID', '=', 'medicamento_check.medicamento_id')
            ->where('medicamento_check.id_paciente', $id)
            ->whereNotNull('medicamento_check.data_check')
            ->orderBy('medicamento_check.data_check', 'desc')
            ->get();

            return $dados;
    }
    
}
