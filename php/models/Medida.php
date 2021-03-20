<?php
class Medida extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('medida');
		$this->hasColumn('contenido','string',50);
		$this->hasColumn('contenidoSingular','string',50);
	}
	
	static public function kgs () {
		return Doctrine::getTable('medida')->findOneByContenido('kgs');
	}
	
	static public function tons () {
		return Doctrine::getTable('medida')->findOneByContenido('tons');
	}
	
	static public function unidades () {
		return Doctrine::getTable('medida')->findOneByContenido('unidades');
	}
	
	static public function toSelect ($producto=false) {
		$html = '';
		$medidas = Doctrine::getTable('medida')->findAll();
		$html .= '<select name="cantidadMedida" id="unidad">';
		if (!$producto) {
			foreach ($medidas as $medida) {
				$html .= '<option value="'.$medida->id.'">'.$medida->contenido.'</option>';
			}
		} else {
			foreach ($medidas as $medida) {
				$selected = ($medida->id == $producto->cantidad->medida->id)?'  selected="selected"':'';
				$html .= '<option value="'.$medida->id.'"'.$selected.'>'.$medida->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>