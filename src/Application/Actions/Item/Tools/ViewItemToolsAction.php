<?php
declare(strict_types=1);
namespace App\Application\Actions\Tools;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/items-tools/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Find tool item by codigo",
*     description="Returns a single tool item",
*     tags={"items-tools"},
*     @OA\Parameter(
*         description="Identificator of tool item to return",
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
*         @OA\JsonContent(ref="#/components/schemas/ItemTool")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="ItemTool not found"
*     ),
* )
*/


class ViewItemToolAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM itens_materiais_escritorio WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "ItemTool not found.");

        return $this->respondWithData($item);
    }
}
