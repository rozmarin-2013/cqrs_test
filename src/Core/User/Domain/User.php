<?php

namespace App\Core\User\Domain;

use App\Common\EventManager\EventsCollectorTrait;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    use EventsCollectorTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;


    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private int|bool $isActive = 0;

    /**
     * @ORM\Column(type="string", length=300, nullable=false)
     */
    private string $email;

    public function __construct(string $email)
    {
        $this->id = null;
        $this->email = $email;

        $this->record();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIsActive(): bool|int
    {
        return $this->isActive;
    }

    public function setIsActive(bool|int $isActive): void
    {
        $this->isActive = $isActive;
    }
}