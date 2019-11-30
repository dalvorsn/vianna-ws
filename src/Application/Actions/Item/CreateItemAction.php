<?php
declare(strict_types=1);
namespace App\Application\Actions\Item;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Item\ItemFurniture;
use OpenApi\Annotations as OA;

/**
* @OA\Post(
*     path="/items",
*     security={{"bearerAuth":{}}},
*     summary="Insert an item",
*     description="Returns the inserted item",
*     tags={"items"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="Item type",
*                     property="tipo",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="Identification code of provider",
*                     property="codigo_fornecedor",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="Item name",
*                     property="nome",
*                     type="string"
*                 ),
*                 required={"tipo", "codigo_fornecedor", "nome"}
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
*     @OA\Response(response="405",description="Invalid input"),
* )
*/


class CreateItemAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO itens 
        ( tipo, codigo_fornecedor, nome ) 
      VALUES 
        ( :tipo, :codigo_fornecedor, :nome )";

      $codigo = $this->insert($query, (array)$data);

      $item = Item::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}