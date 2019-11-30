<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Income;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Launch\LaunchIncome;
use OpenApi\Annotations as OA;

/**
* @OA\Post(
*     path="/launch-income",
*     security={{"bearerAuth":{}}},
*     summary="Insert an launch income",
*     description="Returns the inserted launch income",
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
* )
*/

class CreateLaunchIncomeTypeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "INSERT INTO lancamentos_receitas 
        ( codigo_lancamento, codigo_fornecedor, pago, descricao, data_pagamento ) 
      VALUES 
        ( :codigo_lancamento, :codigo_fornecedor, :pago, :descricao, :data_pagamento )";

      $codigo = $this->insert($query, (array)$data);

      $item = LaunchIncome::convertClass($data);
      $item->codigo = $codigo;

      return $this->respondWithData((array)$item);
    }
}