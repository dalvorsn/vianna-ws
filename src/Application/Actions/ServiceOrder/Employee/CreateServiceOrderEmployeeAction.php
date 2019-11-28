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
* @OA\Post(
*     path="/os-employee",
*     summary="Insert an employee service order",
*     description="Returns the inserted employee service order",
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
*     @OA\Response(response="405",description="Invalid input")
* )
*/

class CreateServiceOrderEmployeeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO ordens_servico_funcionarios 
        ( codigo_ordem_servico, codigo_funcionario ) 
      VALUES 
        ( :codigo_ordem_servico, :codigo_funcionario )";

      $codigo = $this->insert($query, (array)$data);

      $item = ServiceOrderEmployee::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}