<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Types;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Launch\LaunchTypes;
use OpenApi\Annotations as OA;

/**
* @OA\Put(
*     path="/launch-type",
*     summary="Update an launch type",
*     description="Returns the update launch type",
*     tags={"launch-type"},
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="",
*                     property="descricao",
*                     type="string"
*                 ),

*                 required={"descricao"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(ref="#/components/schemas/LaunchTypes")
*     ),
*     @OA\Response(response="405",description="Invalid input")
*           
* )
*/



class UpdateLaunchTypeAction extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = "SELECT * FROM lancamentos_tipos WHERE codigo = :codigo";
      $item = $this->fetchResult($query, [
        "codigo" => $data->codigo
      ], "LaunchTypes not found.");

      $query = "UPDATE lancamentos_tipos SET
        descricao = :descricao
      WHERE
        codigo = :codigo";

      $codigo = $this->update($query, (array)$data);

      $item = LaunchTypes::convertClass($data);

      return $this->respondWithData((array)$item);
    }
}

