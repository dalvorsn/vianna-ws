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
* @OA\Post(
*     path="/os",
*     security={{"bearerAuth":{}}},
*     summary="Insert an service order",
*     description="Returns the inserted service order",
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
* )
*/

class CreateServiceOrderAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO ordens_servico 
        ( codigo_atendimento_cliente, data_chamado, data_prevista, data_de_execucao ) 
      VALUES 
        ( :codigo_atendimento_cliente, :data_chamado, :data_prevista, :data_de_execucao )";

      $codigo = $this->insert($query, (array)$data);

      $item = ServiceOrder::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}