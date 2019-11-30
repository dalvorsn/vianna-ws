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
* @OA\Post(
*     path="/items-tools",
*     security={{"bearerAuth":{}}},
*     summary="Insert an tool",
*     description="Returns the inserted tool",
*     tags={"items-tools"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="Identification code of tool",
*                     property="codigo_item",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="Acquisition date",
*                     property="data_aquisicao",
*                     type="string",
*                     format="datetime"
*                 ),
*                 required={"codigo_item", "data_aquisicao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ItemTool")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreateItemToolAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO itens_ferramentas 
        ( codigo_item, data_aquisicao ) 
      VALUES 
        ( :codigo_item, :data_aquisicao )";

      $codigo = $this->insert($query, (array)$data);

      $item = ItemTool::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}
