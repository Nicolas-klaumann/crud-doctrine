<?php
namespace App\Controller;

use App\Model\ModelPessoa;
use Doctrine\ORM\EntityManager;

class PessoaController
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    // RF01 + RF02: Listar pessoas (com filtro por nome)
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

        include __DIR__ . "/../../views/pessoa/index.php";
    }

    // Formulário de criação
    public function create()
    {
        include __DIR__ . "/../../views/pessoa/create.php";
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

        $this->em->persist($pessoa);
        $this->em->flush();

        header("Location: /pessoas");
        exit;
    }

    // Mostrar pessoa
    public function show($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);
        include __DIR__ . "/../../views/pessoa/show.php";
    }

    // Formulário de edição
    public function edit($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);
        include __DIR__ . "/../../views/pessoa/edit.php";
    }

    // Atualizar pessoa
    public function update($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);

        $pessoa->setNome($_POST['nome']);
        $pessoa->setCpf($_POST['cpf']);

        $this->em->flush();

        header("Location: /pessoas");
        exit;
    }

    // Excluir pessoa
    public function delete($id)
    {
        $pessoa = $this->em->find(ModelPessoa::class, $id);

        $this->em->remove($pessoa);
        $this->em->flush();

        header("Location: /pessoas");
        exit;
    }
}
