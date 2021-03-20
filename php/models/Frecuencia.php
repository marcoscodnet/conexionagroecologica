<?php
class Frecuencia extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('frecuencia');
		$this->hasColumn('contenido','string',300);
	}
	
	static public function toSelect ($producto=false) {
		$html = '';
		$frecuencias = Doctrine::getTable('frecuencia')->findAll();
		$html .= '<select id="selectFrecuencia" name="frecuencia">';
		if (!$producto) {
			foreach ($frecuencias as $frecuencia) {
				$html .= '<option value="'.$frecuencia->id.'">'.$frecuencia->contenido.'</option>';
			}
		} else {
			foreach ($frecuencias as $frecuencia) {
				$selected = ($frecuencia->id == $producto->fuente->id)?'  selected="selected"':'';
				$html .= '<option value="'.$frecuencia->id.'"'.$selected.'>'.$frecuencia->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>