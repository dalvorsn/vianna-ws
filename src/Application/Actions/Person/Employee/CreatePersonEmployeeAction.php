<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Employee;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Employee\PersonEmployee;
use OpenApi\Annotations as OA;

/**
* @OA\Post(
*     path="/people-employee",
*     summary="Insert an employee",
*     description="Returns the inserted employee",
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
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreatePersonEmployeeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO pessoas_funcionarios 
        ( codigo_tipo, codigo_pessoa, cargo, salario ) 
      VALUES 
        ( :codigo_tipo, :codigo_pessoa, :cargo, :salario )";

      $codigo = $this->insert($query, (array)$data);

      $item = PersonEmployee::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}