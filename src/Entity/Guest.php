<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={"get", "put"},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\GuestRepository")
 */
class Guest
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @Groups("get-invitation")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get-invitation")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("get-invitation")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("get-invitation")
     */
    private $secondLastName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get-invitation")
     */
    private $answer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get-invitation")
     */
    private $menu;

    /**
     * @ORM\Column(type="array")
     * @Groups("get-invitation")
     */
    private $allergens;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("get-invitation")
     */
    private $song;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get-invitation")
     */
    private $room;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get-invitation")
     */
    private $gender;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->confirmation = false;
        $this->answer = false;
        $this->menu = 'Original';
        $this->allergens = [];
        $this->room = false;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        if (!$this->lastName) {
            return $this->getFirstName();
        }

        if (!$this->secondLastName) {
            return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
        }

        return sprintf('%s %s %s', $this->getFirstName(), $this->getLastName(), $this->getSecondLastName());
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSecondLastName(): ?string
    {
        return $this->secondLastName;
    }

    public function setSecondLastName(?string $secondLastName): self
    {
        $this->secondLastName = $secondLastName;

        return $this;
    }

    public function getConfirmation(): bool
    {
        return $this->confirmation;
    }

    public function setConfirmation(bool $confirmation): self
    {
        $this->confirmation = $confirmation;

        return $this;
    }

    public function getAnswer(): bool
    {
        return $this->answer;
    }

    public function setAnswer(bool $answer): self
    {
        $this->answer = $answer;
        $this->confirmation = true;

        return $this;
    }

    public function getMenu(): string
    {
        return $this->menu;
    }

    public function setMenu(string $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getAllergens(): array
    {
        return $this->allergens;
    }

    public function setAllergens(array $allergens): self
    {
        $this->allergens = $allergens;

        return $this;
    }

    public function getSong(): ?string
    {
        return $this->song;
    }

    public function setSong(?string $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getRoom(): bool
    {
        return $this->room;
    }

    public function setRoom(bool $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
