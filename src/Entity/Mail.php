<?php

namespace App\Entity;

use App\Repository\MailRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MailRepository::class)
 */
class Mail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = 4,
     *      max = 100,
     *      minMessage = "Tu nombre debe tener al menos 4 carácteres",
     *      maxMessage = "Tu nombre no puede ser mayor a 100 carácteres"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = 4,
     *      max = 100,
     *      minMessage = "Tu nombre debe tener al menos 4 carácteres",
     *      maxMessage = "Tu nombre no puede ser mayor a 100 carácteres"
     * )
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $phone;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "Tu nombre debe tener al menos 4 carácteres",
     *      maxMessage = "Tu nombre no puede ser mayor a 100 carácteres"
     * )
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\IsNull()
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\IsNull()
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        //$this->createdAt = $createdAt;
        $this->createdAt = new \DateTime("now");

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        //$this->updatedAt = $updatedAt;
        $this->updatedAt = new \DateTime("now");

        return $this;
    }
}
