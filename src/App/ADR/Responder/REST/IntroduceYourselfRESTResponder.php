<?php

namespace App\ADR\Responder\REST;

use App\ADR\Domain\GreetUser\GreetUserResult;
use App\ADR\Domain\GreetUser\GreetUserResultInterface;
use App\ADR\Domain\GreetUser\NotReadyToGreetUserResult;
use App\ADR\Domain\GreetUser\UnableToGreetUserResult;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class IntroduceYourselfRESTResponder
{
    public function respond(GreetUserResultInterface $result): ResponseInterface
    {
        if ($result instanceof GreetUserResult) {
            return $this->greetUser($result);
        }
        if ($result instanceof UnableToGreetUserResult) {
            return $this->respondWithProblem($result);
        }

        return $this->gatherData($result);
    }

    private function gatherData(NotReadyToGreetUserResult $result): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => 'error',
                'message' => 'Name and language are required for this endpoint',
            ]
        );
    }

    private function respondWithProblem(UnableToGreetUserResult $result): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => 'error',
                'message' => $result->getException()->getMessage(),
            ]
        );
    }

    private function greetUser(GreetUserResult $result): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => 'success',
                'data' => [
                    'greeting' => $result->getGreeting(),
                ],
            ]
        );
    }
}
