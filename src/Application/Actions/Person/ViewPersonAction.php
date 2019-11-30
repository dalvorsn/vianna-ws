<?php
declare(strict_types=1);
namespace App\Application\Actions\Person;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/people/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Find person by codigo",
*     description="Returns a single office item",
*     tags={"people"},
*     @OA\Parameter(
*         description="Identificator of person to return",
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
*         @OA\JsonContent(ref="#/components/schemas/Person")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="Person not found"
*     ),
* )
*/

class ViewPersonAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM pessoas WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "Person not found.");

        return $this->respondWithData($item);
    }
}
