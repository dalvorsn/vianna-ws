<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/os/{codigo}",
*     summary="Find service order by codigo",
*     description="Returns a single office item",
*     tags={"os"},
*     @OA\Parameter(
*         description="Identificator of service order to return",
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
*         @OA\JsonContent(ref="#/components/schemas/ServiceOrder")
*     ),
*     @OA\Response(
*         response="404",
*         description="ServiceOrder not found"
*     ),
* )
*/

class ViewServiceOrderAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM ordens_servico WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "ServiceOrder not found.");

        return $this->respondWithData($item);
    }
}
