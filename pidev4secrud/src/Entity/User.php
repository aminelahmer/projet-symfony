<?php
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "user")]
class User

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_user", type: "integer", nullable: false)]
    private $idUser;

    #[ORM\Column(name: "age", type: "integer", nullable: true, options: ["default" => "NULL"])]
    private $age = NULL;

    #[ORM\Column(name: "username", type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private $username = 'NULL';

    #[ORM\Column(name: "mail", type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private $mail = 'NULL';

    #[ORM\Column(name: "mdp", type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private $mdp = 'NULL';

    #[ORM\Column(name: "image", type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private $image = 'NULL';

    #[ORM\Column(name: "role", type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private $role = 'NULL';

    #[ORM\Column(name: "sexe", type: "string", length: 255, nullable: true, options: ["default" => "NULL"])]
    private $sexe = 'NULL';

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(?string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
}
