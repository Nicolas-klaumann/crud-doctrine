<?php

namespace App\Controller;

use App\Model\ModelPessoa;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * Classe ControllerPessoa 
 *
 * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
 */
class ControllerPessoa extends ControllerBase
{
    /**
     * Função responsável por renderizar os registros em tela
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function index() {
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

        $this->render("Pessoa/index.php", ['pessoas' => $pessoas]);
    }

    /**
     * Função responsável por renderizar a tela de inserção 
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function create() {
        $this->render("Pessoa/create.php");
    }

    /**
     * Função responsável por inserir registros no banco de dados
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function store() {
        $nome = $_POST['nome'] ?? null;
        $cpf  = $_POST['cpf'] ?? null;

        if (!$nome || !$cpf) {
            die("Nome e CPF são obrigatórios");
        }

        $cpfLimpo = str_replace(['.', '-'], '', $cpf);

        $pessoa = new ModelPessoa();
        $pessoa->setNome($nome);
        $pessoa->setCpf($cpfLimpo);

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

    /**
     * Função responsável por mostrar detalhes do registro
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function show($id) {
        $pessoa = $this->em->find(ModelPessoa::class, $id);
        $this->render("Pessoa/show.php", ['pessoa' => $pessoa]);
    }

    /**
     * Função responsável por renderizar a tela de edição
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function edit($id) {
        $pessoa = $this->em->find(ModelPessoa::class, $id);
        $this->render("Pessoa/edit.php", ['pessoa' => $pessoa]);
    }

    /**
     * Função responsável por fazer a edição de um registro
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function update($id) {
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

    /**
     * Função responsável por remover um registro
     *
     * @author Nicolas Klaumann <nicolas@conectra.com.br> (17-09-2025)
     */
    public function delete($id) {
        $pessoa = $this->em->find(ModelPessoa::class, $id);

        $this->em->remove($pessoa);
        $this->em->flush();

        $this->redirect("/pessoa");
    }
}
