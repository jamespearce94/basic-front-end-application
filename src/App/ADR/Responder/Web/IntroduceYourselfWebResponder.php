<?php

namespace App\ADR\Responder\Web;

use App\ADR\Domain\GreetUser\GreetUserResult;
use App\ADR\Domain\GreetUser\GreetUserResultInterface;
use App\ADR\Domain\GreetUser\NotReadyToGreetUserResult;
use App\ADR\Domain\GreetUser\UnableToGreetUserResult;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class IntroduceYourselfWebResponder
{
    /** @var TemplateRendererInterface */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function respond(GreetUserResultInterface $result, $options = []): ResponseInterface
    {
        if ($options['single-page'] ?? false) {
            return $this->respondWithSinglePage($result);
        }

        if ($result instanceof GreetUserResult) {
            return $this->greetUser($result);
        }
        if ($result instanceof UnableToGreetUserResult) {
            return $this->respondWithProblem($result);
        }

        return $this->gatherData($result);
    }

    private function gatherData(NotReadyToGreetUserResult $result): HtmlResponse
    {
        return new HtmlResponse(
            $this->renderer->render(
                'app::greeting/request'
            )
        );
    }

    private function respondWithProblem(UnableToGreetUserResult $result): HtmlResponse
    {
        return new HtmlResponse(
            $this->renderer->render(
                'app::greeting/request',
                [
                    'problem' => $result->getException()->getMessage(),
                    'name' => $result->getPayload()->getName(),
                    'language' => $result->getPayload()->getLanguage(),
                ]
            )
        );
    }

    private function greetUser(GreetUserResult $result): HtmlResponse
    {
        return new HtmlResponse(
            $this->renderer->render(
                'app::greeting/respond',
                [
                    'greeting' => $result->getGreeting(),
                ]
            )
        );
    }

    private function respondWithSinglePage(GreetUserResultInterface $result): HtmlResponse
    {
        return new HtmlResponse(
            $this->renderer->render(
                'app::greeting/request-single-page'
            )
        );
    }
}
