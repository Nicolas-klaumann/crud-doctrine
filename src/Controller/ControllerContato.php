<?php

namespace App\Controller;

use App\Model\ModelContato;
use App\Model\ModelPessoa;

class ControllerContato extends ControllerBase
{
    public function index()
    {
        $repo = $this->em->getRepository(ModelContato::class);
        $contatos = $repo->findAll();

        // Passamos o array com a chave 'contatos' para a view
        $this->render("Contato/index.php", ['contatos' => $contatos]);
    }

    // Formulário de criação
    public function create()
    {
        $pessoas = $this->em->getRepository(ModelPessoa::class)->findAll();
        $this->render("Contato/create.php", ['pessoas' => $pessoas]);
    }

    // Salvar contato
    public function store()
    {
        $tipo = $_POST['tipo'] ?? null;
        $descricao = $_POST['descricao'] ?? null;
        $idPessoa = $_POST['idPessoa'] ?? null;

        if (!$tipo || !$descricao || !$idPessoa) {
            die("Todos os campos são obrigatórios");
        }

        $pessoa = $this->em->find(ModelPessoa::class, $idPessoa);

        $contato = new ModelContato();
        $contato->setTipo($tipo); // pode ser bool ou string
        $contato->setDescricao($descricao);
        $contato->setPessoa($pessoa);

        $this->em->persist($contato);
        $this->em->flush();

        $this->redirect("/contato");
    }

    // Mostrar contato
    public function show($id)
    {
        $contato = $this->em->find(ModelContato::class, $id);
        $this->render("Contato/show.php", ['contato' => $contato]);
    }

    // Formulário de edição
    public function edit($id)
    {
        $contato = $this->em->find(ModelContato::class, $id);
        $pessoas = $this->em->getRepository(ModelPessoa::class)->findAll();

        $this->render("Contato/edit.php", [
            'contato' => $contato,
            'pessoas' => $pessoas
        ]);
    }

    // Atualizar contato
    public function update($id)
    {
        $contato = $this->em->find(ModelContato::class, $id);

        $contato->setTipo($_POST['tipo']);
        $contato->setDescricao($_POST['descricao']);

        $pessoa = $this->em->find(ModelPessoa::class, $_POST['idPessoa']);
        $contato->setPessoa($pessoa);

        $this->em->flush();

        $this->redirect("/contato");
    }

    // Excluir contato
    public function delete($id)
    {
        $contato = $this->em->find(ModelContato::class, $id);

        $this->em->remove($contato);
        $this->em->flush();

        $this->redirect("/contato");
    }
}   
