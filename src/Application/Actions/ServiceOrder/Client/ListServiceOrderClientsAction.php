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
*     path="/os-client",
*     security={{"bearerAuth":{}}},
*     summary="Return all client service order",
*     tags={"os-client"},
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


class ListServiceOrderClientsAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM atendimentos_cliente";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_cliente" => $item["codigo_cliente"],
                "codigo_funcionario" => $item["codigo_funcionario"],
                "descricao" => $item["descricao"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
