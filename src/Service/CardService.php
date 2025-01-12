<?php

namespace App\Service;

use App\Entity\Card;
use App\Model\CardModel;
use Doctrine\ORM\EntityManagerInterface;

class CardService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * return random 10 cards from the database
     *
     * @return array
     */
    public function getCards(): array
    {
        $cards = $this->entityManager->getRepository(Card::class)->getCards();

        $result = [];

        foreach ($cards as $card) {
            $result[] = (new CardModel($card))->toArray();
        }

        return $result;
    }


    /**
     * Sorts an array of cards by color and value.
     *
     * Colors are sorted in the following order: Carreaux, Cœur, Pique, Trèfle.
     * Values are sorted from AS (1) to Roi (13).
     *
     * @param array $cards An array of cards represented with keys
     *                     'color' (string) and 'value' (string).
     *
     * @return array
     */
    public function sortCards(array $cards): array
    {
        $valueOrder = [
            'AS' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5,
            '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
            'Valet' => 11, 'Dame' => 12, 'Roi' => 13
        ];

        $colorOrder = [
            'Carreaux' => 1, 'Cœur' => 2, 'Pique' => 3, 'Trèfle' => 4
        ];

        usort($cards, function ($a, $b) use ($valueOrder, $colorOrder) {

            if ($colorOrder[$a['color']] === $colorOrder[$b['color']]) {
                return $valueOrder[$a['value']] - $valueOrder[$b['value']];
            }

            return $colorOrder[$a['color']] - $colorOrder[$b['color']];
        });
        return $cards;
    }
}
