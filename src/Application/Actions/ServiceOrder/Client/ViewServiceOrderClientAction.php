<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Client;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/os-client/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Find client service order by codigo",
*     description="Returns a single office item",
*     tags={"os-client"},
*     @OA\Parameter(
*         description="Identificator of client service order to return",
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
*         @OA\JsonContent(ref="#/components/schemas/ServiceOrderClient")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="ServiceOrderClient not found"
*     ),
* )
*/

class ViewServiceOrderClientAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM atendimentos_cliente WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "ServiceOrderClient not found.");

        return $this->respondWithData($item);
    }
}
