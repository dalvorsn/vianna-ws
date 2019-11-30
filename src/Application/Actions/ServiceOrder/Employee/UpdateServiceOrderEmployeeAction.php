<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Employee;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\ServiceOrder\ServiceOrderEmployee;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/os-employee",
*     security={{"bearerAuth":{}}},
*     summary="Update an employee service order",
*     description="Returns the update employee service order",
*     tags={"os-employee"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="codigo_ordem_servico",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="codigo_funcionario",
*                     type="int"
*                 ),

*                 required={"codigo_ordem_servico", "codigo_funcionario"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/ServiceOrderEmployee")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateServiceOrderEmployeeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM ordens_servico_funcionarios WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "ServiceOrderEmployee not found.");

      $query = "UPDATE ordens_servico_funcionarios SET
        codigo_ordem_servico = :codigo_ordem_servico,
        codigo_funcionario = :codigo_funcionario
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = ServiceOrderEmployee::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

