<?php
class Contenedor extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('contenedor');
		$this->hasColumn('contenido','string',50);
	}
	
	static public function suelto () {
		return Doctrine::getTable('contenedor')->findOneByContenido('suelto');
	}
	
	static public function enCaja () {
		return Doctrine::getTable('contenedor')->findOneByContenido('en caja');
	}
	
	static public function embalado () {
		return Doctrine::getTable('contenedor')->findOneByContenido('embalado');
	}
	
	static public function enPallets () {
		return Doctrine::getTable('contenedor')->findOneByContenido('en pallets');
	}
	
	static public function otro () {
		return Doctrine::getTable('contenedor')->findOneByContenido('otro');
	}
	
	static public function toSelect ($producto=false) {
		$html = '';
		$contenedores = Doctrine::getTable('contenedor')->findAll();
		$html .= '<select name="contenedor">';
		if (!$producto) {
			foreach ($contenedores as $contenedor) {
				$html .= '<option value="'.$contenedor->id.'">'.$contenedor->contenido.'</option>';
			}
		} else {
			foreach ($contenedores as $contenedor) {
				$selected = ($contenedor->id == $producto->contenedor->id)?'  selected="selected"':'';
				$html .= '<option value="'.$contenedor->id.'"'.$selected.'>'.$contenedor->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>