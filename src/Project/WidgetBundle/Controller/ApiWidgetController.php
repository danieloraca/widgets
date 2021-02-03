<?php
declare(strict_types=1);

namespace App\Project\WidgetBundle\Controller;

use App\Project\StarBundle\Exception\InvalidNumberException;
use App\Project\WidgetBundle\Utility\Calculator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class ApiWidgetController extends AbstractController
{
    /** @var Calculator */
    private $calcularor;

    /** @var SerializerInterface */
    private $serializer;

    public function __construct(
        Calculator $calculator,
        SerializerInterface $serializer
    ) {
        $this->calcularor = $calculator;
        $this->serializer = $serializer;
    }

    public function index(int $amount): Response
    {
        $response = $this->calcularor->calculate($amount);
        $serialized = $this->getSerializedResponse($response);

        return new Response(
            $serialized,
            200,
            ['Content-Type' => 'application/json']
        );
    }

    private function getSerializedResponse(array $response): string
    {
        return $this->serializer->serialize($response, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getReference();
            }
        ]);
    }
}
