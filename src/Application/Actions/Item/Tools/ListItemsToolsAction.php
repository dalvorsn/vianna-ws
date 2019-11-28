<?php
declare(strict_types=1);
namespace App\Application\Actions\Item\Tools;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/items-tools",
*     summary="Return all tools item",
*     tags={"items-tools"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ItemTool")
*         )
*     ),
* )
*/

class ListItemsToolsAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM itens_ferramentas";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo_item" => $item["codigo_item"],
                "data_aquisicao" => $item["data_aquisicao"]
            ]);
        }

        return $this->respondWithData($ret);
    }
}
