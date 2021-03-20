<?php

class ConexionMailer extends PHPMailer {
    public function __construct() {
        //parent::__construct();
        $this->PluginDir = RUTA_LOCAL."php/clases/include/";
		$this->Mailer = "smtp";
		$this->Host = "a2plcpnl0310.prod.iad2.secureserver.net";
		$this->SMTPAuth = true;
		$this->Username = "info@conexionagroecologica.com"; 
		$this->Password = "incoag2050!";
		$this->Port = "465";
		$this->SMTPSecure = "ssl";
		$this->isSMTP();
		$this->From = "info@conexionagroecologica.com";
		$this->FromName = "Conexión Agroecológica";
		$this->Timeout=30;
	    $this->IsHTML(true);
    }
}

?>