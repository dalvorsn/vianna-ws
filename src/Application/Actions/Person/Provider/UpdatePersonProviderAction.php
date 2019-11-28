<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Provider;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Person\PersonProvider;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/people-provider",
*     summary="Update an provider",
*     description="Returns the update provider",
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
*           
* )
*/



class UpdatePersonProviderAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM pessoas_fornecedores WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "PersonProvider not found.");

      $query = "UPDATE pessoas_fornecedores SET
        codigo_tipo = :codigo_tipo,
        codigo_pessoa = :codigo_pessoa
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = PersonProvider::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

