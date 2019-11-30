<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Employee;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/people-employee/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Find employee by codigo",
*     description="Returns a single office item",
*     tags={"people-employee"},
*     @OA\Parameter(
*         description="Identificator of employee to return",
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
*         @OA\JsonContent(ref="#/components/schemas/PersonEmployee")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="PersonEmployee not found"
*     ),
* )
*/

class ViewPersonEmployeeAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM pessoas_funcionarios WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "PersonEmployee not found.");

        return $this->respondWithData($item);
    }
}
