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
* @OA\Post(
*     path="/people",
*     security={{"bearerAuth":{}}},
*     summary="Insert an person",
*     description="Returns the inserted person",
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
* )
*/

class CreatePersonAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO pessoas 
        ( nome, email, cpf, cnpj, data_nascimento, endereco, telefone ) 
      VALUES 
        ( :nome, :email, :cpf, :cnpj, :data_nascimento, :endereco, :telefone )";

      $codigo = $this->insert($query, (array)$data);

      $item = Person::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}