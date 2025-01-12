<?php

namespace App\Model;

use App\Entity\Card;

class CardModel
{
    private string $color;
    private string $value;


    public function __construct(private readonly Card $card)
    {
        $this->setColor();
        $this->setValue();
    }

    public function setColor(): void
    {
        $this->color = $this->card->getColor();
    }

    public function setValue(): void
    {
        $this->value = $this->card->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function toArray(): array
    {
        return [
            'color' => $this->color,
            'value' => $this->value,
        ];
    }
}