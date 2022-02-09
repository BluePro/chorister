<?php

namespace App\Listener;

use App\Schema\SchemaFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExceptionListener
{
    private SchemaFactory $schemeFactory;
    private SerializerInterface $serializer;

    public function __construct(SchemaFactory $schemeFactory, SerializerInterface $serializer)
    {
        $this->schemeFactory = $schemeFactory;
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $error = $this->schemeFactory->createError($exception);
        $data = $this->serializer->serialize($error, 'json');

        if ($exception instanceof HttpExceptionInterface) {
            $response = new JsonResponse($data, $exception->getStatusCode(), [], true);
        } else {
            $response = new JsonResponse($data, Response::HTTP_INTERNAL_SERVER_ERROR, [], true);
        }

        $event->setResponse($response);
    }
}
