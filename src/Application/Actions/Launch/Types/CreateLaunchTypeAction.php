<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Types;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\{DNS}\LaunchTypes;
use OpenApi\Annotations as OA;

/**
* @OA\Post(
*     path="/launch-type",
*     summary="Insert an launch type",
*     description="Returns the inserted launch type",
*     tags={"launch-type"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="descricao",
*                     type="string"
*                 ),

*                 required={"descricao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/LaunchTypes")
*     ),
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreateLaunchTypeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO lancamentos_tipos 
        ( descricao ) 
      VALUES 
        ( :descricao )";

      $codigo = $this->insert($query, (array)$data);

      $item = LaunchTypes::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}