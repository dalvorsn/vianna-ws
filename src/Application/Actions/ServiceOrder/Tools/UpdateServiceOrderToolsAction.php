<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Tools;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\ServiceOrder\ServiceOrderTools;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/os-tools",
*     security={{"bearerAuth":{}}},
*     summary="Update an tools service order",
*     description="Returns the update tools service order",
*     tags={"os-tools"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="codigo_ordem_servico",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="codigo_ferramenta",
*                     type="int"
*                 ),

*                 required={"codigo_ordem_servico", "codigo_ferramenta"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ServiceOrderTools")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateServiceOrderToolsAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM ordens_servico_ferramentas WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "ServiceOrderTools not found.");

      $query = "UPDATE ordens_servico_ferramentas SET
        codigo_ordem_servico = :codigo_ordem_servico,
        codigo_ferramenta = :codigo_ferramenta
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = ServiceOrderTools::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

