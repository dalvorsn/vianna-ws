<?php
declare(strict_types=1);
namespace App\Application\Actions\Item;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Item\Item;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/items",
*     security={{"bearerAuth":{}}},
*     summary="Update an item",
*     description="Returns the update item",
*     tags={"items"},
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


class UpdateItemAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM itens WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "Item not found.");

      $query = "UPDATE itens SET
        tipo = :tipo, 
        codigo_fornecedor = :codigo_fornecedor,
        nome = :nome 
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = Item::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}