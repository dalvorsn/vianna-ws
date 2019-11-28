<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Launch\Launch;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/launch",
*     summary="Update an launch",
*     description="Returns the update launch",
*     tags={"launch"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="tipo",
*                     type="int"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="valor",
*                     type="double"
*                 ),
*                 @OA\Property(
*                     description="",
*                     property="data_vencimento",
*                     type="datetime"
*                 ),

*                 required={"tipo", "valor", "data_vencimento"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/Launch")
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateLaunchAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM lancamentos WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "Launch not found.");

      $query = "UPDATE lancamentos SET
        tipo = :tipo,
        valor = :valor,
        data_vencimento = :data_vencimento
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = Launch::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

