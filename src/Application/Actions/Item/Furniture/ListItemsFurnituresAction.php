<?php
declare(strict_types=1);
namespace App\Application\Actions\Item\Furniture;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/items-furniture",
*     security={{"bearerAuth":{}}},
*     summary="Return all items",
*     tags={"items-furniture"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ItemFurniture")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/


class ListItemsFurnituresAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM itens_mobiliarios";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_item" => $item["codigo_item"],
                "codigo_patrimonio" => utf8_encode($item["codigo_patrimonio"]),
                "data_aquisicao" => $item["data_aquisicao"],
            ]);
        }

        return $this->respondWithData($ret);
    }
}