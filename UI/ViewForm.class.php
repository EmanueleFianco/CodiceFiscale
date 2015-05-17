<?php
require_once('smarty-libs/Smarty.class.php');

/**
 * Classe ViewForm per gestire l'input da form. Estende Smarty.
 * @author Gioele Cicchini
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Federica Caruso
 * @package CodiceFiscale/UI
 * 
 */

class ViewForm extends Smarty {

	/**
	 *
	 * Costruttore di ViewForm che setta semplicemente le cartelle di lavoro di Smarty
	 *
	*/

	public function __construct() {
		parent::__construct();
        $this->setTemplateDir('smarty-dir/templates');
        $this->setCompileDir('smarty-dir/templates_c');
        $this->setCacheDir('smarty-dir/cache');
        $this->setConfigDir('smarty-dir/configs');
	}

	/**
	 *
	 * Metodo che richiama il metodo display di Smarty
	 * @param string $template Stringa contenente il nome del template da utilizzare
	 *
	 */

	public function setTemplate($template) {
    

    	$this->display($template);
    }

    /**
	 *
	 * Metodo che richiama il metodo assign di Smarty
	 * @param string $reference Stringa che individua il segnaposto utilizzato nel template
	 * @param Persona|CodiceFiscale $data Oggetto associato al segnaposto nel template
	 *
	 */

    public function setDataIntoTemplate($reference,$data) {
	$this->assign($reference,$data);
    }
}

?>