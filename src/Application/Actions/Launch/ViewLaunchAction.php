<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/launch/{codigo}",
*     summary="Find launch by codigo",
*     description="Returns a single office item",
*     tags={"launch"},
*     @OA\Parameter(
*         description="Identificator of launch to return",
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
*         @OA\JsonContent(ref="#/components/schemas/Launch")
*     ),
*     @OA\Response(
*         response="404",
*         description="Launch not found"
*     ),
* )
*/

class ViewLaunchAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM lancamentos WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "Launch not found.");

        return $this->respondWithData($item);
    }
}
