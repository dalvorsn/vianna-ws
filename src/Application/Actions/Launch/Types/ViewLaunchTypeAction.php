<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Types;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/launch-type/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Find launch type by codigo",
*     description="Returns a single office item",
*     tags={"launch-type"},
*     @OA\Parameter(
*         description="Identificator of launch type to return",
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
*         @OA\JsonContent(ref="#/components/schemas/LaunchTypes")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="LaunchTypes not found"
*     ),
* )
*/

class ViewLaunchTypeAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM lancamentos_tipos WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "LaunchTypes not found.");

        return $this->respondWithData($item);
    }
}
