<?php
declare(strict_types=1);
namespace App\Application\Actions\Person;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Person\Person;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/people",
*     security={{"bearerAuth":{}}},
*     summary="Update an person",
*     description="Returns the update person",
*     tags={"people"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="nome",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="email",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="cpf",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="cnpj",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="data_nascimento",
*                     type="datetime"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="endereco",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="telefone",
*                     type="string"
*                 ),

*                 required={"nome", "email", "cpf", "cnpj", "data_nascimento", "endereco", "telefone"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/Person")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdatePersonAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM pessoas WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "Person not found.");

      $query = "UPDATE pessoas SET
        nome = :nome,
        email = :email,
        cpf = :cpf,
        cnpj = :cnpj,
        data_nascimento = :data_nascimento,
        endereco = :endereco,
        telefone = :telefone
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = Person::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

