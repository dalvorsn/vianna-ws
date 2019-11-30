<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Tools;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/os-tools",
*     security={{"bearerAuth":{}}},
*     summary="Return all tools service order",
*     tags={"os-tools"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ServiceOrderTools")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/


class ListServiceOrderToolssAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM ordens_servico_ferramentas";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_ordem_servico" => $item["codigo_ordem_servico"],
                "codigo_ferramenta" => $item["codigo_ferramenta"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
