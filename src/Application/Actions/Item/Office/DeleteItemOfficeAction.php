<?php
declare(strict_types=1);
namespace App\Application\Actions\Item\Office;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Delete(
*     path="/items-office/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Delete item by codigo",
*     description="",
*     tags={"items-office"},
*     @OA\Parameter(
*         description="Identificator of office item to return",
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
*         description="successful operation"
*     ),
*     @OA\Response(
*         response="404",
*         description="Furniture not found"
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/

class DeleteItemOfficeAction extends Action
{
  protected function action(): Response
  {
    $codigo = $this->resolveArg("codigo");

    $query = "SELECT * FROM itens_materiais_escritorio WHERE codigo = :codigo";
    $item = $this->fetchResult($query, [
      "codigo" => $codigo
    ], "Furniture not found.");

    $query = "DELETE FROM itens_materiais_escritorio WHERE codigo = :codigo";
    $rows = $this->delete($query, [ "codigo" => $codigo ]);

    return $this->respondWithData([]);
  }
}
