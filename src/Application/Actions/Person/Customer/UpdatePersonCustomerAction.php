<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Customer;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Person\PersonCustomer;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/people-customer",
*     security={{"bearerAuth":{}}},
*     summary="Update an customer",
*     description="Returns the update customer",
*     tags={"people-customer"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="codigo_tipo",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="codigo_pessoa",
*                     type="int"
*                 ),

*                 required={"codigo_tipo", "codigo_pessoa"}
*             )
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
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdatePersonCustomerAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM pessoas_clientes WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "PersonCustomer not found.");

      $query = "UPDATE pessoas_clientes SET
        codigo_tipo = :codigo_tipo,
        codigo_pessoa = :codigo_pessoa
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = PersonCustomer::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

