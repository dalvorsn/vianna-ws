<?php
declare(strict_types=1);
namespace App\Application\Actions\Item\Office;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Item\ItemOffice;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/items-office",
*     summary="Update an office item",
*     description="Returns the update office item",
*     tags={"items-office"},
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
*                     property="lote",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="Item name",
*                     property="data_aquisicao",
*                     type="string",
*                     format="datetime"
*                 ),
*                 required={"codigo", "codigo_item", "lote", "data_aquisicao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ItemOffice")
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateItemOfficeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM itens_materiais_escritorio WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "ItemOffice not found.");

      $query = "UPDATE itens_materiais_escritorio SET
        codigo_item = :codigo_item,
        lote = :lote,
        data_aquisicao = :data_aquisicao
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = ItemOffice::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

