<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Client;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\ServiceOrder\ServiceOrderClient;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/os-client",
*     security={{"bearerAuth":{}}},
*     summary="Update an client service order",
*     description="Returns the update client service order",
*     tags={"os-client"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="codigo_cliente",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="codigo_funcionario",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="descricao",
*                     type="string"
*                 ),

*                 required={"codigo_cliente", "codigo_funcionario", "descricao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ServiceOrderClient")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateServiceOrderClientAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM atendimentos_cliente WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "ServiceOrderClient not found.");

      $query = "UPDATE atendimentos_cliente SET
        codigo_cliente = :codigo_cliente,
        codigo_funcionario = :codigo_funcionario,
        descricao = :descricao
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = ServiceOrderClient::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

