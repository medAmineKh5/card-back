<?php

namespace App\Controller;

use App\Service\CardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class CardController extends AbstractController
{
    public function __construct(private readonly CardService $cardService)
    {
    }

    /**
     * @return JsonResponse
     */
    #[Route('/api/cards', name: 'api_random_cards', methods: ['GET'])]
    public function getRandomCards(): JsonResponse
    {
        return new JsonResponse($this->cardService->getCards());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/api/cards/sort', name: 'api_sorted_cards', methods: ['POST'])]
    public function sortCards(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        return new JsonResponse($this->cardService->sortCards($data));
    }
}
