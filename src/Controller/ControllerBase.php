<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;

/**
 * @class ControllerBase
 *
 * Classe base para todos os controladores da aplicação.
 * Fornece a injeção do EntityManager e pode conter métodos utilitários
 * que são compartilhados por outros controllers.
 */
class ControllerBase
{
    /**
     * @var EntityManager O gerenciador de entidades do Doctrine.
     */
    protected $em;

    /**
     * Construtor da classe.
     * Injeta a dependência do EntityManager, tornando-o disponível para
     * todas as classes que herdam de ControllerBase.
     *
     * @param EntityManager $em O EntityManager a ser injetado.
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Inclui um arquivo de view.
     * Este método é útil para centralizar a lógica de inclusão de views,
     * permitindo que você altere o caminho de forma global se necessário.
     *
     * @param string $path O caminho do arquivo de view a ser incluído.
     * @param array $data Um array de dados que será extraído e disponibilizado para a view.
     */
    protected function render(string $path, array $data = []): void
    {
        // Extrai o array $data em variáveis locais.
        // Exemplo: se $data for ['nome' => 'João'], a variável $nome será criada.
        extract($data);

        include __DIR__ . "/../View/" . $path;
    }

    /**
     * Redireciona para uma URL específica.
     * Um método utilitário para facilitar o redirecionamento.
     *
     * @param string $path O caminho da URL para onde redirecionar.
     */
    protected function redirect(string $path): void
    {
        header("Location: " . $path);
        exit;
    }
}
