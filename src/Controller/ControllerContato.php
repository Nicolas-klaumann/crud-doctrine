<?php

namespace App\Controller;

use App\Model\ModelContato;
use App\Model\ModelPessoa;

/**
 * Classe ControllerContato 
 *
 * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025
 */
class ControllerContato extends ControllerBase
{
    /**
     * Função responsável por renderizar os registros em tela
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function index() {
        $repo = $this->em->getRepository(ModelContato::class);
        $contatos = $repo->findAll();

        $this->render("Contato/index.php", ['contatos' => $contatos]);
    }

    /**
     * Função responsável por renderizar a tela de inserção 
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function create() {
        $pessoas = $this->em->getRepository(ModelPessoa::class)->findAll();
        $this->render("Contato/create.php", ['pessoas' => $pessoas]);
    }

    /**
     * Função responsável por inserir registros no banco de dados
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function store() {
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

        $this->redirect("/contato/");
    }

    /**
     * Função responsável por mostrar detalhes do registro
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function show($id) {
        $contato = $this->em->find(ModelContato::class, $id);
        $this->render("Contato/show.php", ['contato' => $contato]);
    }

    /**
     * Função responsável por renderizar a tela de edição
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function edit($id) {
        $contato = $this->em->find(ModelContato::class, $id);
        $pessoas = $this->em->getRepository(ModelPessoa::class)->findAll();

        $this->render("Contato/edit.php", [
            'contato' => $contato,
            'pessoas' => $pessoas
        ]);
    }

    /**
     * Função responsável por fazer a edição de um registro
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function update($id) {
        $contato = $this->em->find(ModelContato::class, $id);

        $contato->setTipo($_POST['tipo']);
        $contato->setDescricao($_POST['descricao']);

        $pessoa = $this->em->find(ModelPessoa::class, $_POST['idPessoa']);
        $contato->setPessoa($pessoa);

        $this->em->flush();

        $this->redirect("/contato");
    }

    /**
     * Função responsável por remover um registro
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function delete($id) {
        $contato = $this->em->find(ModelContato::class, $id);

        $this->em->remove($contato);
        $this->em->flush();

        $this->redirect("/contato");
    }
}   
