<?php
declare(strict_types=1);

namespace App\Project\WidgetBundle\Controller;

use App\Project\WidgetBundle\Exception\ApiNotAvailableException;
use App\Project\WidgetBundle\Form\Type\WidgetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    /** @var HttpClientInterface */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function index(Request $request): Response
    {
        $form = $this->createForm(WidgetType::class);

        $form->handleRequest($request);
        $info = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if ($data['amount'] < 0) {
                return $this->render('@ProjectWidget/error.html.twig', ['error' => 'Invalid Number']);
            }

            try {
                $response = $this->client->request(
                    'GET',
                    $this->generateUrl('api_widgets', ['amount' => $data['amount']], UrlGeneratorInterface::ABSOLUTE_URL)
                );
                $info = json_decode($response->getContent(), true);
            } catch (TransportExceptionInterface $e) {
                return $this->render('@ProjectWidget/error.html.twig');
            }
        }
        return $this->render('@ProjectWidget/main.html.twig', [
            'form' => $form->createView(),
            'info' => $info
        ]);
    }

}
