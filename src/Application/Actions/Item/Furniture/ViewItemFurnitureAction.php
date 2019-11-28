<?php
declare(strict_types=1);
namespace App\Application\Actions\Item;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/items-furniture/{codigo}",
*     summary="Find item by codigo",
*     description="Returns a single item",
*     tags={"items-furniture"},
*     @OA\Parameter(
*         description="Identificator of item to return",
*         in="path",
*         name="codigo",
*         required=true,
*         @OA\Schema(
*           type="integer",
*           format="int64"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/Item")
*     ),
*     @OA\Response(
*         response="404",
*         description="Furniture not found"
*     ),
* )
*/


class ViewItemFurnitureAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM itens_mobiliarios WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "Furniture not found.");

        return $this->respondWithData($item);
    }
}