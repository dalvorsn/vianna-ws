<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Employee;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Delete(
*     path="/os-employee/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Delete employee service order by codigo",
*     description="",
*     tags={"os-employee"},
*     @OA\Parameter(
*         description="Identificator of employee service order to return",
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
*         description="ServiceOrderEmployee not found"
*     ),
* )
*/

class DeleteServiceOrderEmployeeAction extends Action
{
  protected function action(): Response
  {
    $codigo = $this->resolveArg("codigo");

    $query = "SELECT * FROM ordens_servico_funcionarios WHERE codigo = :codigo";
    $item = $this->fetchResult($query, [
      "codigo" => $codigo
    ], "ServiceOrderEmployee not found.");

    $query = "DELETE FROM ordens_servico_funcionarios WHERE codigo = :codigo";
    $rows = $this->delete($query, [ "codigo" => $codigo ]);

    return $this->respondWithData([]);
  }
}
