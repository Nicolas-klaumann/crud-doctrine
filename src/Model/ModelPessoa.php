<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Classe ModelPessoa 
 * 
 * @author Nicolas Klaumann
 */

#[ORM\Entity]
#[ORM\Table(name: "pessoa")]
class ModelPessoa
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $nome;

    #[ORM\Column(type: "string", length: 20, unique: true)]
    private string $cpf;

    #[ORM\OneToMany(targetEntity: ModelContato::class, mappedBy: "pessoa", cascade: ["persist", "remove"], orphanRemoval: true)]
    private Collection $contatos;

    public function __construct()
    {
        $this->contatos = new ArrayCollection();
    }

    // getters e setters
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getContacts(): Collection
    {
        return $this->contatos;
    }

    public function addContato(ModelContato $c): self
    {
        if (!$this->contatos->contains($c)) {
            $this->contatos->add($c);
            $c->setPessoa($this);
        }
        return $this;
    }
    public function removeContato(ModelContato $c): self
    {
        if ($this->contatos->removeElement($c)) {
            $c->setPessoa(null);
        }
        return $this;
    }
}
