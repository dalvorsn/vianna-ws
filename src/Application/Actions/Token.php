<?php
declare(strict_types=1);
namespace App\Application\Actions;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use App\Domain\Person\Person;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;
use Firebase\JWT\JWT;

/**
* @OA\Post(
*     path="/token",
*     tags={"Authorization"},
*     summary="Generate token using credentials.",
*     description="API Login. Return the token for later access.",
*     @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="application/json",
*             @OA\Schema(
*                 @OA\Property(
*                     description="Email",
*                     property="email",
*                     type="email",
*                     example="admin@admin.com"
*                 ),
*                 @OA\Property(
*                     description="Plain password",
*                     property="password",
*                     type="string",
*                     example="123456"
*                 ),
*                 required={"email", "password"}
*             )
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Return a token.",
*         @OA\JsonContent(ref="#/components/schemas/Token")
*     ),
*     @OA\Response(
*         response=401,
*         description="Invalid username/password supplied"
*     )
* )
*/


class Token extends Action
{
    protected function action(): Response
    {
      $data = $this->getFormData();

      $query = 
      "SELECT * FROM pessoas
      WHERE 
        email = :email AND password = :password";

      $stm = $this->db->prepare($query);
      $stm->execute((array)$data);
      $ret = $stm->fetch();
      if(!$ret) {
        return $this->response->withStatus(401);
      }

      $person = Person::convertClass((object)$ret);
      $token = $this->generateToken($person);

      return $this->respondWithData($token);
    }

    private function generateToken(Person $person) {
      $tokenPayload = [
        'sub' => $person->codigo,
        'name' => $person->nome,
        'email' => $person->email
      ];

      $token = JWT::encode($tokenPayload, $_ENV["JWT_SECRET"] ?? 'secret');
      
      return new \App\Domain\Token($token);
    }

}