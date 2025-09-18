<?php

namespace App\Controller;

use App\Model\ModelPessoa;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class ControllerPessoa extends ControllerBase
{
    public function index()
    {
        $nome = $_GET['nome'] ?? null;
        $repo = $this->em->getRepository(ModelPessoa::class);

        if ($nome) {
            $pessoas = $repo->createQueryBuilder('p')
                ->where('p.nome LIKE :nome')
                ->setParameter('nome', '%' . $nome . '%')
                ->getQuery()
                ->getResult();
        } else {
            $pessoas = $repo->findAll();
        }

        // Passamos o array com a chave 'pessoas' para a view
        $this->render("Pessoa/index.php", ['pessoas' => $pessoas]);
    }

    // Formulário de criação
    public function create()
    {
        $this->render("Pessoa/create.php");
    }

    // Salvar pessoa
    public function store()
    {
        $nome = $_POST['nome'] ?? null;
        $cpf  = $_POST['cpf'] ?? null;

        if (!$nome || !$cpf) {
            die("Nome e CPF são obrigatórios");
        }

        $pessoa = new ModelPessoa();
        $pessoa->setNome($nome);
        $pessoa->setCpf($cpf);

        try {
            $this->em->persist($pessoa);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            // CPF já existe
            echo "<p style='color:red;'>Erro: já existe uma pessoa cadastrada com este CPF.</p>";
            $this->render("Pessoa/create.php");
            return;
        }

        $this->redirect("/pessoa");
    }

    // Mostrar pessoa
    public function show($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);
        $this->render("Pessoa/show.php", ['pessoa' => $pessoa]);
    }

    // Formulário de edição
    public function edit($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);
        $this->render("Pessoa/edit.php", ['pessoa' => $pessoa]);
    }

    // Atualizar pessoa
    public function update($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);

        $pessoa->setNome($_POST['nome']);
        $pessoa->setCpf($_POST['cpf']);

        try {
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            echo "<p style='color:red;'>Erro: já existe outra pessoa com este CPF.</p>";
            $this->render("Pessoa/edit.php");
            return;
        }

        $this->redirect("/pessoa");
    }

    // Excluir pessoa
    public function delete($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);

        $this->em->remove($pessoa);
        $this->em->flush();

        $this->redirect("/pessoa");
    }
}
