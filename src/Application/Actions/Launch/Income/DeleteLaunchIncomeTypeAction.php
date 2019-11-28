<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Income;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Delete(
*     path="/launch-income/{codigo}",
*     summary="Delete launch income by codigo",
*     description="",
*     tags={"launch-income"},
*     @OA\Parameter(
*         description="Identificator of launch income to return",
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
*         description="LaunchIncome not found"
*     ),
* )
*/

class DeleteLaunchIncomeTypeAction extends Action
{
  protected function action(): Response
  {
    $codigo = $this->resolveArg("codigo");

    $query = "SELECT * FROM lancamentos_receitas WHERE codigo = :codigo";
    $item = $this->fetchResult($query, [
      "codigo" => $codigo
    ], "LaunchIncome not found.");

    $query = "DELETE FROM lancamentos_receitas WHERE codigo = :codigo";
    $rows = $this->delete($query, [ "codigo" => $codigo ]);

    return $this->respondWithData([]);
  }
}
