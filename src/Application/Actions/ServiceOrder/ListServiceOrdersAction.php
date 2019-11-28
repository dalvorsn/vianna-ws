<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/os",
*     summary="Return all service order",
*     tags={"os"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ServiceOrder")
*         )
*     ),
* )
*/


class ListServiceOrdersAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM ordens_servico";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_atendimento_cliente" => $item["codigo_atendimento_cliente"],
                "data_chamado" => $item["data_chamado"],
                "data_prevista" => $item["data_prevista"],
                "data_de_execucao" => $item["data_de_execucao"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
