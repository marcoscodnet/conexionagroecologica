<?php
class Includer {	
	static public function addJs () {
		$js = '';
		foreach (func_get_args() as $script){
			$js.= '<script type="text/javascript" src="js/';
			$js.= $script;
			$js.='.js"></script>';
		}
		$js.='<!--{recursoJs}-->'; //para poder seguir agregando recursos js
		return $js;		
	}
	
	static public function addCss () {
		$css = '';
		foreach (func_get_args() as $archivo){
			$css.= '<link href="css/';
			$css.= $archivo;
			$css.='.css" rel="stylesheet" type="text/css"/>';
		}
		$css.='<!--{recursoCss}-->'; //para poder seguir agregando recursos js
		return $css;		
	}
}
?>