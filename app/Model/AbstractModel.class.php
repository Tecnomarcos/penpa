<?php

namespace Model;

use Lib\Mensagem;
use Lib\Banco;

abstract class AbstractModel implements ModelBase, \Iterator {

    use Mensagem;

    protected $banco;

    function gerenciar() {
        return $this->listar();
    }

    function editar() {
        if ($_POST) {
            $_POST['id'] = $_GET['id'];
            if ($this->salvar()) {
                $modulo = ucfirst($this);
                header("location:admin.php?modulo=$modulo&acao=gerenciar");
                exit();
            }
        }

        return $this->ver(" id = {$_GET['id']}");
    }

    function cadastro() {
        if ($_POST) {
            if ($this->salvar()) {
                Mensagem::set('Dados Salvos', 'success');
            }
        }
    }

    function inserir() {
        if ($_POST) {
            if ($this->salvar()) {
                $modulo = ucfirst($this);
                header("location:admin.php?modulo=$modulo&acao=gerenciar");
            }
        }
    }

    function salvar() {

        $this->propriedades = $_POST;

        if (isset($this->propriedades['id'])) {
            return $this->alterar();
        } else {
            return $this->gravar();
        }
    }

    private function gravar() {
        return $this->banco->inserir($this);
    }

    private function alterar() {
        return $this->banco->atualizar($this);
    }

    function excluir() {
        if (isset($_GET['id'])) {
            $this->propriedades['id'] = $_GET['id'];
            if ($this->banco->deletar($this)) {
                $modulo = ucfirst($this);
                header("location:admin.php?modulo=$modulo&acao=gerenciar");
            }
        }
    }

    function listar(array $parametros = NULL) {
        $retorno = $this->banco->listarTodos($this, $parametros);
        if ($retorno) {
            foreach ($retorno as $registro) {
                $classe = get_class($this);
                $obj = new $classe();
                $obj->propriedades = $registro;
                $registros[] = $obj;
            }
        } else {
            return null;
        }

        return $registros;
    }

    function ver($onde) {

        if ($registro = $this->banco->selecionar($this, $onde)) {
            $classe = get_class($this);
            $obj = new $classe();
            $obj->propriedades = $registro;
            return $obj;
        } else {
            return null;
        }
    }

    function __construct() {
        $this->banco = Banco::getInstancia();
    }

    function __destruct() {
        unset($this->banco);
    }

    function __toString() {
        return $this->tabela;
    }

    function getAtributos() {
        return $this->propriedades;
    }

    function __call($metodo, $parametro) {
        $nomeAtributo = substr($metodo, 3);
        $nomeMetodo = substr($metodo, 0, 3);
        $nomeAtributo = strtolower($nomeAtributo);
        $nomeMetodo = strtolower($nomeMetodo);
        switch ($nomeMetodo) {
            case 'get':
                if (isset($this->propriedades[$nomeAtributo])) {
                    return $this->propriedades[$nomeAtributo];
                } else {
                    throw new \Exception(" $nomeAtributo : Atributo não existe");
                }
                break;
            case 'set':
                if (isset($this->propriedades[$nomeAtributo])) {
                    $this->propriedades[$nomeAtributo] = $parametro[0];
                } else {
                    throw new \Exception(" $nomeAtributo : Atributo não existe");
                }
                break;
            default:
                throw new \Exception('Metodo Inválido');
        }
    }

    function rewind() {
        
    }

    function valid() {
        
    }

    function next() {
        
    }

    function key() {
        
    }

    function current() {
        
    }

}
