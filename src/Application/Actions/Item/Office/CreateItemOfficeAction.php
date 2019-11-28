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
* @OA\Post(
*     path="/items-office",
*     summary="Insert an office item",
*     description="Returns the inserted office item",
*     tags={"items-office"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="Identification code of office item",
*                     property="codigo_item",
*                     type="int"
*                 ),
*                  @OA\Property(
*                     description="Lote of office item",
*                     property="lote",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="Acquisition date",
*                     property="data_aquisicao",
*                     type="string",
*                     format="datetime"
*                 ),
*                 required={"codigo_item", "lote", "data_aquisicao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ItemOffice")
*     ),
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreateItemOfficeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO itens_materiais_escritorio 
        ( codigo_item, lote, data_aquisicao ) 
      VALUES 
        ( :codigo_item, :lote, :data_aquisicao )";

      $codigo = $this->insert($query, (array)$data);

      $item = ItemOffice::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}
