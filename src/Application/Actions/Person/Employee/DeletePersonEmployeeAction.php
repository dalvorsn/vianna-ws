<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Employee;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Delete(
*     path="/people-employee/{codigo}",
*     summary="Delete employee by codigo",
*     description="",
*     tags={"people-employee"},
*     @OA\Parameter(
*         description="Identificator of employee to return",
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
*         description="PersonEmployee not found"
*     ),
* )
*/

class DeletePersonEmployeeAction extends Action
{
  protected function action(): Response
  {
    $codigo = $this->resolveArg("codigo");

    $query = "SELECT * FROM pessoas_funcionarios WHERE codigo = :codigo";
    $item = $this->fetchResult($query, [
      "codigo" => $codigo
    ], "PersonEmployee not found.");

    $query = "DELETE FROM pessoas_funcionarios WHERE codigo = :codigo";
    $rows = $this->delete($query, [ "codigo" => $codigo ]);

    return $this->respondWithData([]);
  }
}
