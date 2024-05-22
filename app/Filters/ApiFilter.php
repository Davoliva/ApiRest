<?php
namespace App\Filters;
use Illuminate\Http\Request;
class ApiFilter{

    //Filtros

    //Parametros de la request y sus estados
    protected $safeParams = [];
    //Cambia como se escribe el parametro para que se entienda mejor
    protected $columnMap = [];
    //Cambia los parametros de algunos operadores
    protected $operatorMap = []; 

    public function trasnform(Request $request){
        $eloQuery = [];
        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            if (!isset($query)) {
                continue;
            }
            $column = $this->columnMap[$param] ?? $param;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}

?>