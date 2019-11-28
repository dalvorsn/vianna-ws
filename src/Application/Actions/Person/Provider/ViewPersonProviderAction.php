<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Provider;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/people-provider/{codigo}",
*     summary="Find provider by codigo",
*     description="Returns a single office item",
*     tags={"people-provider"},
*     @OA\Parameter(
*         description="Identificator of provider to return",
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
*         @OA\JsonContent(ref="#/components/schemas/PersonProvider")
*     ),
*     @OA\Response(
*         response="404",
*         description="PersonProvider not found"
*     ),
* )
*/

class ViewPersonProviderAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM pessoas_fornecedores WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "PersonProvider not found.");

        return $this->respondWithData($item);
    }
}
