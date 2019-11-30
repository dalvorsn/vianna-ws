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
*     path="/items/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Find item by codigo",
*     description="Returns a single item",
*     tags={"items"},
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
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="Item not found"
*     ),
* )
*/

class ViewItemAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM itens WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "Item not found.");

        return $this->respondWithData($item);
    }
}