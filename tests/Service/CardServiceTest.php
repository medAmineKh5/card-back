<?php

namespace App\Tests\Service;

use App\Service\CardService;
use PHPUnit\Framework\TestCase;

class CardServiceTest extends TestCase
{
    public function testSortCards(): void
    {
        $service = new CardService($this->createMock(\Doctrine\ORM\EntityManagerInterface::class));

        $cards = [
            ['value' => '10', 'color' => 'Pique'],
            ['value' => 'AS', 'color' => 'Cœur'],
            ['value' => 'Roi', 'color' => 'Carreaux']
        ];

        $expected = [
            ['value' => 'Roi', 'color' => 'Carreaux'],
            ['value' => 'AS', 'color' => 'Cœur'],
            ['value' => '10', 'color' => 'Pique']
        ];

        $result = $service->sortCards($cards);
        $this->assertEquals($expected, $result);
    }

    public function testSortEmptyCards(): void
    {
        $service = new CardService($this->createMock(\Doctrine\ORM\EntityManagerInterface::class));

        $result = $service->sortCards([]);
        $this->assertEquals([], $result);
    }
}
