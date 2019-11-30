<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\ServiceOrder\ServiceOrder;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/os",
*     security={{"bearerAuth":{}}},
*     summary="Update an service order",
*     description="Returns the update service order",
*     tags={"os"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="codigo_atendimento_cliente",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="data_chamado",
*                     type="datetime"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="data_prevista",
*                     type="datetime"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="data_de_execucao",
*                     type="datetime"
*                 ),

*                 required={"codigo_atendimento_cliente", "data_chamado", "data_prevista", "data_de_execucao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ServiceOrder")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateServiceOrderAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM ordens_servico WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "ServiceOrder not found.");

      $query = "UPDATE ordens_servico SET
        codigo_atendimento_cliente = :codigo_atendimento_cliente,
        data_chamado = :data_chamado,
        data_prevista = :data_prevista,
        data_de_execucao = :data_de_execucao
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = ServiceOrder::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

