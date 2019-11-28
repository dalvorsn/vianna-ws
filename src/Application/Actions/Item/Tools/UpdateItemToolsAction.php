<?php
declare(strict_types=1);
namespace App\Application\Actions\Item\Tools;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Item\ItemTool;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/items-tools",
*     summary="Update an tool item",
*     description="Returns the update tool item",
*     tags={"items-tools"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="Identification code",
*                     property="codigo",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="Identification code of provider",
*                     property="codigo_item",
*                     type="int"
*                 ),
*                  @OA\Property(
*                     description="Identification code of provider",
*                     property="codigo_patrimonio",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="Item name",
*                     property="data_aquisicao",
*                     type="string",
*                     format="datetime"
*                 ),
*                 required={"codigo", "codigo_item", "data_aquisicao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ItemTool")
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateItemToolAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM itens_ferramentas WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "ItemTool not found.");

      $query = "UPDATE itens_ferramentas SET
        codigo_item = :codigo_item,
        data_aquisicao = :data_aquisicao
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = ItemTool::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}
