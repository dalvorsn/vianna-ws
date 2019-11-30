<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Launch\Launch;
use OpenApi\Annotations as OA;

/**
* @OA\Post(
*     path="/launch",
*     security={{"bearerAuth":{}}},
*     summary="Insert an launch",
*     description="Returns the inserted launch",
*     tags={"launch"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="tipo",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="valor",
*                     type="double"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="data_vencimento",
*                     type="datetime"
*                 ),

*                 required={"tipo", "valor", "data_vencimento"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/Launch")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreateLaunchAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO lancamentos 
        ( tipo, valor, data_vencimento ) 
      VALUES 
        ( :tipo, :valor, :data_vencimento )";

      $codigo = $this->insert($query, (array)$data);

      $item = Launch::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}