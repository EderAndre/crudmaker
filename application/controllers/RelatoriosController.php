<?php

class RelatoriosController extends Zend_Controller_Action
{
	
	
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
	// plotly/plotly-latest.min.js
	
	$this->view->headScript()
		->offsetSetFile(4,$this->view->baseUrl('script/plotly/plotly-latest.min.js'));

		$this->_getModel();
		 $b=$this->_model->totalPerfis();
		$this->view->content=json_encode($b);
    }
    
    public function apAction()
    {
    
    	/**
		 * logo da empresa
    	 */
    	
    	
    }
public function _getModel()
    {
    	// action body
		if(null===$this->_model)
		{
		require_once APPLICATION_PATH."/models/Relatorios.php";
		 $this->_model=new Model_Relatorios();
		}
		return $this->_model;
    }
    function textoCentral($page, $text, $bottom) {
    	$text_width = $this->getTextWidth($text, $page->getFont(), $page->getFontSize());
    	$box_width = $page->getWidth();
    	$left = ($box_width - $text_width) / 2;
    
    	$page->drawText($text, $left, $bottom, 'UTF-8');
    }
    function LinhaCentral($page, $size, $bottom) {
    	
    	$box_width = $page->getWidth();
    	$left = ($box_width - $size) / 2;
    
    	
    	$page->drawline( $left,$bottom,$left+$size,$bottom);
    }
    
    function getTextWidth($text, $font, $font_size) {
    	$drawing_text = iconv('', 'UTF-8', $text);
    	$characters    = array();
    	for ($i = 0; $i < strlen($drawing_text); $i++) {
    		$characters[] = (ord($drawing_text[$i++]) << 8) | ord ($drawing_text[$i]);
    	}
    	$glyphs        = $font->glyphNumbersForCharacters($characters);
    	$widths        = $font->widthsForGlyphs($glyphs);
    	$text_width   = (array_sum($widths) / $font->getUnitsPerEm()) * $font_size;
    	return $text_width;
    }
   
}

