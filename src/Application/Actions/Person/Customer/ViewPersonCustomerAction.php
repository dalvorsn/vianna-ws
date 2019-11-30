<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Customer;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/people-customer/{codigo}",
*     security={{"bearerAuth":{}}},
*     summary="Find customer by codigo",
*     description="Returns a single office item",
*     tags={"people-customer"},
*     @OA\Parameter(
*         description="Identificator of customer to return",
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
*         @OA\JsonContent(ref="#/components/schemas/PersonCustomer")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="PersonCustomer not found"
*     ),
* )
*/

class ViewPersonCustomerAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "SELECT * FROM pessoas_funcionarios WHERE codigo = :codigo";
        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "PersonCustomer not found.");

        return $this->respondWithData($item);
    }
}
