<?php
class Aplicacao_GeradorSenha_GeradorSenha
{
    /**
     * @var Zend_Acl
     */
    protected $_acl;
	protected $_idPerfil;
 
    public function _constructor($nome)
    {	
		
		return $this->gerador($nome);
		
		
    }
	
   	
    protected function gerador($nome)
    {
    	          
        // Recebe concatenado o nome da pessoa + o tempo
        $aux = $nome.time();
        
        // Ele faz um md5 da variavel $aux e captura os 6 primeiros caracteres
        $senha = substr(md5($aux),0,8);
        
        return $senha;
    
    
    }
	
}
