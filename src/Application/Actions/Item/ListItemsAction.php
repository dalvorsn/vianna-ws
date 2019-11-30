<?php
declare(strict_types=1);
namespace App\Application\Actions\Item;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/items",
*     security={{"bearerAuth":{}}},
*     summary="Return all items",
*     tags={"items"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/Item")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/

class ListItemsAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM itens";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "tipo" => $item["tipo"],
                "codigo_fornecedor" => $item["codigo_fornecedor"],
                "nome" => utf8_encode($item["nome"]),
            ]);
        }

        return $this->respondWithData($ret);
    }
}
