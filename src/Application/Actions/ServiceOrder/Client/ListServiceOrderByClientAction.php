<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Client;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/os-client/{codigo_cliente}/list",
*     security={{"bearerAuth":{}}},
*     summary="Return all client service orders filtered by codigo_cliente",
*     tags={"os-client"},
*     @OA\Parameter(
*         description="Identificator of client service order to return",
*         in="path",
*         name="codigo_cliente",
*         required=true,
*         @OA\Schema(
*           type="integer",
*           format="int64"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ServiceOrderClient")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/


class ListServiceOrderByClientAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo_cliente");

        $query = "SELECT * FROM atendimentos_cliente WHERE codigo_cliente = :codigo_cliente";
        $items = $this->fetchResults($query, [ "codigo_cliente" => $codigo ]);
        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_cliente" => $item["codigo_cliente"],
                "codigo_funcionario" => $item["codigo_funcionario"],
                "descricao" => json_encode($item["descricao"]),

            ]);
        }

        return $this->respondWithData($ret);
    }
}
