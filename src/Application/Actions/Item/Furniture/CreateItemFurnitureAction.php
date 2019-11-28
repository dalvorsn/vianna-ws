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
* @OA\Post(
*     path="/items-furniture",
*     summary="Insert an item",
*     description="Returns the inserted item",
*     tags={"items-furniture"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="Identification code of item",
*                     property="codigo_item",
*                     type="int"
*                 ),
*                  @OA\Property(
*                     description="Identification code of item",
*                     property="codigo_patrimonio",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="Acquisition date",
*                     property="data_aquisicao",
*                     type="string",
*                     format="datetime"
*                 ),
*                 required={"codigo_item", "codigo_patrimonio", "data_aquisicao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ItemFurniture")
*     ),
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreateItemFurnitureAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO itens_mobiliarios 
        ( codigo_item, codigo_patrimonio, data_aquisicao ) 
      VALUES 
        ( :codigo_item, :codigo_patrimonio, :data_aquisicao )";

      $codigo = $this->insert($query, (array)$data);

      $item = ItemFurniture::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}