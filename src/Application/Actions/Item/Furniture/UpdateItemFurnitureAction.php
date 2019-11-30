<?php
declare(strict_types=1);
namespace App\Application\Actions\Item\Furniture;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Item\ItemFurniture;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/items-furniture",
*     security={{"bearerAuth":{}}},
*     summary="Update an item",
*     description="Returns the update item",
*     tags={"items-furniture"},
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
*                 required={"codigo", "codigo_item", "codigo_mobiliario", "data_aquisicao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/Item")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateItemFurnitureAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM itens_mobiliarios WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "Furniture not found.");

      $query = "UPDATE itens_mobiliarios SET
        codigo_item = :codigo_item,
        codigo_patrimonio = :codigo_patrimonio,
        data_aquisicao = :data_aquisicao 
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = ItemFurniture::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}