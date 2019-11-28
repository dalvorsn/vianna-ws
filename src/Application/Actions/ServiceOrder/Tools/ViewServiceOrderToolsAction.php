<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Tools;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/os-tools/{codigo}",
*     summary="Find tools service order by codigo",
*     description="Returns a single office item",
*     tags={"os-tools"},
*     @OA\Parameter(
*         description="Identificator of tools service order to return",
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
*         @OA\JsonContent(ref="#/components/schemas/ServiceOrderTools")
*     ),
*     @OA\Response(
*         response="404",
*         description="ServiceOrderTools not found"
*     ),
* )
*/

class ViewServiceOrderToolsAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM ordens_servico_ferramentas WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "ServiceOrderTools not found.");

        return $this->respondWithData($item);
    }
}
