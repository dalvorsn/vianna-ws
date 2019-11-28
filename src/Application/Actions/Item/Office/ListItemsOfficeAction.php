<?php
declare(strict_types=1);
namespace App\Application\Actions\Item\Office;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/items-office",
*     summary="Return all office item",
*     tags={"items-office"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ItemOffice")
*         )
*     ),
* )
*/


class ListItemsOfficeAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM itens_materiais_escritorio";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_item" => $item["codigo_item"],
                "lote" => utf8_encode($item["lote"]),
                "data_aquisicao" => $item["data_aquisicao"]
            ]);
        }

        return $this->respondWithData($ret);
    }
}
