<?php

namespace App\Command;

use App\Entity\Card;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-card-values',
    description: 'create all cards with color and values',
)]
class AddCardValuesCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $colors = ['Carreaux', 'Cœur', 'Pique', 'Trèfle'];
        $values = ['AS', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Valet', 'Dame', 'Roi'];

        foreach ($colors as $color) {
            foreach ($values as $value) {
                $card = new Card();
                $card->setColor($color);
                $card->setValue($value);

                $this->entityManager->persist($card);
            }
        }

        $this->entityManager->flush();

        $output->writeln('Cards added to the database.');

        return Command::SUCCESS;
    }
}
