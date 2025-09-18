<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe ModelContato
 * 
 * @author Nicolas Klaumann
 */
#[ORM\Entity]
#[ORM\Table(name: "contato")]
class ModelContato
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    // tipo: boolean => 0 = Telefone, 1 = Email
    #[ORM\Column(type: "boolean")]
    private bool $tipo;

    #[ORM\Column(type: "string", length: 255)]
    private string $descricao;

    #[ORM\ManyToOne(targetEntity: ModelPessoa::class, inversedBy: "contatos")]
    #[ORM\JoinColumn(name: "id_pessoa", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ModelPessoa $pessoa;


    // getters e setters
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getTipo(): bool
    {
        return $this->tipo;
    }

    public function setTipo(bool $t): self
    {
        $this->tipo = $t;
        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $d): self
    {
        $this->descricao = $d;
        return $this;
    }

    public function getPessoa(): ModelPessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(?ModelPessoa $p): self
    {
        if ($p) $this->pessoa = $p;
        return $this;
    }
}
