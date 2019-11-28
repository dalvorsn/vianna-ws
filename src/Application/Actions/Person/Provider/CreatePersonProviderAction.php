<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Provider;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Provider\PersonProvider;
use OpenApi\Annotations as OA;

/**
* @OA\Post(
*     path="/people-provider",
*     summary="Insert an provider",
*     description="Returns the inserted provider",
*     tags={"people-provider"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="codigo_tipo",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="codigo_pessoa",
*                     type="int"
*                 ),

*                 required={"codigo_tipo", "codigo_pessoa"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/PersonProvider")
*     ),
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreatePersonProviderAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO pessoas_fornecedores 
        ( codigo_tipo, codigo_pessoa ) 
      VALUES 
        ( :codigo_tipo, :codigo_pessoa )";

      $codigo = $this->insert($query, (array)$data);

      $item = PersonProvider::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}