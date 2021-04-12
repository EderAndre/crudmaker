<?php
class Aplicacao_Mail_Dispatcher
{
    /**
     * @var Zend_Acl
     */
  
 
    public function _constructor($configs=array(),$contentHtml, $destiny=array(),$subject)
    {	
		
		return $this->sendHtmlMail($configs,$contentHtml, $destiny,$subject);
		
		
    }
	
   	
    protected function sendHtmlMail($configs=array(),$contentHtml, $destiny=array('mail'=>'','name'=>''),$subject)
    {
    	$result=false;     
       
	$transport = new Zend_Mail_Transport_Smtp($configs['host'], $configs);

	$mail = new Zend_Mail();
	$mail->setBodyHtml($contentHtml);
    	$mail->setFrom($configs['from']);
    	$mail->setSubject($subject);
    	$mail->addTo($destiny['mail'],$destiny['name']);

    try{
		$mail->send($transport);
		$result=true;

	}catch(Exception $e){

		$result=$e;
	}		
    return $result;
    
    }
	
}
