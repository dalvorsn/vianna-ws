<?php
declare(strict_types=1);
namespace App\Application\Actions\ServiceOrder\Employee;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/os-employee",
*     security={{"bearerAuth":{}}},
*     summary="Return all employee service order",
*     tags={"os-employee"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ServiceOrderEmployee")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/


class ListServiceOrderEmployeesAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM ordens_servico_funcionarios";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_ordem_servico" => $item["codigo_ordem_servico"],
                "codigo_funcionario" => $item["codigo_funcionario"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
