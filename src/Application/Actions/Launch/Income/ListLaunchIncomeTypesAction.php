<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Income;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/launch-income",
*     security={{"bearerAuth":{}}},
*     summary="Return all launch income",
*     tags={"launch-income"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/LaunchIncome")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/


class ListLaunchIncomeTypesAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM lancamentos_receitas";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_lancamento" => $item["codigo_lancamento"],
                "codigo_fornecedor" => $item["codigo_fornecedor"],
                "pago" => $item["pago"],
                "descricao" => $item["descricao"],
                "data_pagamento" => $item["data_pagamento"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
