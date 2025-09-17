<?php
namespace App\Controller;

use App\Model\ModelContato;
use App\Model\ModelPessoa;
use Doctrine\ORM\EntityManager;

class ControllerContato
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    // RF03: Listar contatos
    public function index()
    {
        $repo = $this->em->getRepository(ModelContato::class);
        $contatos = $repo->findAll();

        include __DIR__ . "/../View/Contato/index.php";
    }

    // Formulário de criação
    public function create()
    {
        $pessoas = $this->em->getRepository(ModelPessoa::class)->findAll();
        include __DIR__ . "/../View/Contato/create.php";
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

        header("Location: /contato");
        exit;
    }

    // Mostrar contato
    public function show($id)
    {
        $contato = $this->em->find(ModelContato::class, $id);
        include __DIR__ . "/../View/Contato/show.php";
    }

    // Formulário de edição
    public function edit($id)
    {
        $contato = $this->em->find(ModelContato::class, $id);
        $pessoas = $this->em->getRepository(ModelPessoa::class)->findAll();

        include __DIR__ . "/../View/Contato/edit.php";
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

        header("Location: /contato");
        exit;
    }

    // Excluir contato
    public function delete($id)
    {
        $contato = $this->em->find(ModelContato::class, $id);

        $this->em->remove($contato);
        $this->em->flush();

        header("Location: /contato");
        exit;
    }
}
