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
* @OA\Get(
*     path="/launch-income/{codigo}",
*     summary="Find launch income by codigo",
*     description="Returns a single office item",
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
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/LaunchIncome")
*     ),
*     @OA\Response(
*         response="404",
*         description="LaunchIncome not found"
*     ),
* )
*/

class ViewLaunchIncomeTypeAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM lancamentos_receitas WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "LaunchIncome not found.");

        return $this->respondWithData($item);
    }
}
