<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Types;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Launch\LaunchIncome;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/launch-income",
*     security={{"bearerAuth":{}}},
*     summary="Update an launch income",
*     description="Returns the update launch income",
*     tags={"launch-income"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="codigo_lancamento",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="codigo_fornecedor",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="pago",
*                     type="bool"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="descricao",
*                     type="string"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="data_pagamento",
*                     type="datetime"
*                 ),

*                 required={"codigo_lancamento", "codigo_fornecedor", "pago", "descricao", "data_pagamento"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/LaunchIncome")
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateLaunchIncomeTypeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM lancamentos_receitas WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "LaunchIncome not found.");

      $query = "UPDATE lancamentos_receitas SET
        codigo_lancamento = :codigo_lancamento,
        codigo_fornecedor = :codigo_fornecedor,
        pago = :pago,
        descricao = :descricao,
        data_pagamento = :data_pagamento
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = LaunchIncome::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

