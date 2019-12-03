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
*     path="/people-customer/find-by-person/{codigo_pessoa}",
*     security={{"bearerAuth":{}}},
*     summary="Find customer by codigo_pessoa",
*     description="Returns a single office item",
*     tags={"people-customer"},
*     @OA\Parameter(
*         description="Identificator of customer to return",
*         in="path",
*         name="codigo_pessoa",
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

class FindPersonCustomerAction extends Action
{
    protected function action(): Response
    {
        $codigo_pessoa = $this->resolveArg("codigo_pessoa");

        $query = "SELECT * FROM pessoas_clientes WHERE codigo_pessoa = :codigo_pessoa";
        $item = $this->fetchResult($query, [
            "codigo_pessoa" => $codigo_pessoa
        ], "PersonCustomer not found.");

        return $this->respondWithData($item);
    }
}
