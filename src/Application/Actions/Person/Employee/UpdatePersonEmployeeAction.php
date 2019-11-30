<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Employee;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Person\PersonEmployee;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/people-employee",
*     security={{"bearerAuth":{}}},
*     summary="Update an employee",
*     description="Returns the update employee",
*     tags={"people-employee"},
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
*                 @OA\Property(
*                     description="",
*                     property="cargo",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="salario",
*                     type="double"
*                 ),

*                 required={"codigo_tipo", "codigo_pessoa", "cargo", "salario"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/PersonEmployee")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdatePersonEmployeeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM pessoas_funcionarios WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "PersonEmployee not found.");

      $query = "UPDATE pessoas_funcionarios SET
        codigo_tipo = :codigo_tipo,
        codigo_pessoa = :codigo_pessoa,
        cargo = :cargo,
        salario = :salario
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = PersonEmployee::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

