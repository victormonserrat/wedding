<?php

namespace App\Controller;

use App\Entity\Invitation;
use Doctrine\ORM\EntityManagerInterface;

class GetInvitation
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Invitation $data): Invitation
    {
        $data->setReceived(true);
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}