<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetInvitation;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={
 *         "get"={
 *             "method"="GET",
 *             "path"="/invitations/{id}",
 *             "controller"=GetInvitation::class,
 *             "normalization_context"={"groups"={"get-invitation"}},
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InvitationRepository")
 */
class Invitation
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Guest")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $guest1;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Guest")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $guest2;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Guest")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $guest3;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Guest")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $guest4;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Guest")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $guest5;

    /**
     * @ORM\Column(type="text")
     * @Groups("get-invitation")
     */
    private $comment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $received;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->sent = false;
        $this->received = false;
    }

    public function __toString(): string
    {
        return $this->getGuestsNames();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getGuestsNames(): string
    {
        return implode(', ', $this->getGuests());
    }

    /**
     * @Groups("get-invitation")
     */
    public function getGuests(): array
    {
        $guests = [];

        if ($this->getGuest1()) {
            $guests[] = $this->getGuest1();
        }
        if ($this->getGuest2()) {
            $guests[] = $this->getGuest2();
        }
        if ($this->getGuest3()) {
            $guests[] = $this->getGuest3();
        }
        if ($this->getGuest4()) {
            $guests[] = $this->getGuest4();
        }
        if ($this->getGuest5()) {
            $guests[] = $this->getGuest5();
        }

        return $guests;
    }

    public function getGuest1(): ?Guest
    {
        return $this->guest1;
    }

    public function setGuest1(?Guest $guest1): self
    {
        $this->guest1 = $guest1;

        return $this;
    }

    public function getGuest2(): ?Guest
    {
        return $this->guest2;
    }

    public function setGuest2(?Guest $guest2): self
    {
        $this->guest2 = $guest2;

        return $this;
    }

    public function getGuest3(): ?Guest
    {
        return $this->guest3;
    }

    public function setGuest3(?Guest $guest3): self
    {
        $this->guest3 = $guest3;

        return $this;
    }

    public function getGuest4(): ?Guest
    {
        return $this->guest4;
    }

    public function setGuest4(?Guest $guest4): self
    {
        $this->guest4 = $guest4;

        return $this;
    }

    public function getGuest5(): ?Guest
    {
        return $this->guest5;
    }

    public function setGuest5(?Guest $guest5): self
    {
        $this->guest5 = $guest5;

        return $this;
    }

    public function getLink(): string
    {
        return sprintf('https://elenayjaime.com/%s', $this->getId());
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function isSent(): bool
    {
        return $this->sent;
    }

    public function setSent(bool $sent): self
    {
        $this->sent = $sent;

        if (!$sent) {
            $this->received = false;
        }

        return $this;
    }

    public function isReceived(): bool
    {
        return $this->received;
    }

    public function setReceived(bool $received): self
    {
        if ($this->isSent()) {
            $this->received = $received;
        }

        return $this;
    }
}
