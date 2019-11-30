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
* @OA\Post(
*     path="/people-customer",
*     security={{"bearerAuth":{}}},
*     summary="Insert an customer",
*     description="Returns the inserted customer",
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
* )
*/

class CreatePersonCustomerAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO pessoas_clientes 
        ( codigo_tipo, codigo_pessoa ) 
      VALUES 
        ( :codigo_tipo, :codigo_pessoa )";

      $codigo = $this->insert($query, (array)$data);

      $item = PersonCustomer::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}