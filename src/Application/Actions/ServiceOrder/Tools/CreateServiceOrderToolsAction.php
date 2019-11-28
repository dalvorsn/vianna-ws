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
* @OA\Post(
*     path="/os-tools",
*     summary="Insert an tools service order",
*     description="Returns the inserted tools service order",
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
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreateServiceOrderToolsAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO ordens_servico_ferramentas 
        ( codigo_ordem_servico, codigo_ferramenta ) 
      VALUES 
        ( :codigo_ordem_servico, :codigo_ferramenta )";

      $codigo = $this->insert($query, (array)$data);

      $item = ServiceOrderTools::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}