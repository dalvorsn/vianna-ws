<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Customer;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Delete(
*     path="/people-customer/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Delete customer by codigo",
*     description="",
*     tags={"people-customer"},
*     @OA\Parameter(
*         description="Identificator of customer to return",
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
*         description="PersonCustomer not found"
*     ),
* )
*/

class DeletePersonCustomerAction extends Action
{
  protected function action(): Response
  {
    $codigo = $this->resolveArg("codigo");

    $query = "SELECT * FROM pessoas_funcionarios WHERE codigo = :codigo";
    $item = $this->fetchResult($query, [
      "codigo" => $codigo
    ], "PersonCustomer not found.");

    $query = "DELETE FROM pessoas_funcionarios WHERE codigo = :codigo";
    $rows = $this->delete($query, [ "codigo" => $codigo ]);

    return $this->respondWithData([]);
  }
}
