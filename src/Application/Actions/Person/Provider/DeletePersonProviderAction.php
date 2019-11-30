<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Provider;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Delete(
*     path="/people-provider/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Delete provider by codigo",
*     description="",
*     tags={"people-provider"},
*     @OA\Parameter(
*         description="Identificator of provider to return",
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
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="PersonProvider not found"
*     ),
* )
*/

class DeletePersonProviderAction extends Action
{
  protected function action(): Response
  {
    $codigo = $this->resolveArg("codigo");

    $query = "SELECT * FROM pessoas_fornecedores WHERE codigo = :codigo";
    $item = $this->fetchResult($query, [
      "codigo" => $codigo
    ], "PersonProvider not found.");

    $query = "DELETE FROM pessoas_fornecedores WHERE codigo = :codigo";
    $rows = $this->delete($query, [ "codigo" => $codigo ]);

    return $this->respondWithData([]);
  }
}
