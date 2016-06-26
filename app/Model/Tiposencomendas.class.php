<?php
namespace Model;

use Lib\Mensagem;

class TiposEncomendas extends AbstractModel
{
    protected $tabela = 'tiposencomendas';
    
    protected $propriedades = array('id' => NULL,
                                    'tipo' => NULL
                                    );
}
