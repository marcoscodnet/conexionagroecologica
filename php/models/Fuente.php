<?php
class Fuente extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('fuente');
		$this->hasColumn('contenido','string',300);
	}
	
	static public function toSelect ($producto=false) {
		$html = '';
		$fuentes = Doctrine::getTable('fuente')->findAll();
		$html .= '<select id="selectFuente" name="fuente">';
		if (!$producto) {
			foreach ($fuentes as $fuente) {
				$html .= '<option value="'.$fuente->id.'">'.$fuente->contenido.'</option>';
			}
		} else {
			foreach ($fuentes as $fuente) {
				$selected = ($fuente->id == $producto->fuente->id)?'  selected="selected"':'';
				$html .= '<option value="'.$fuente->id.'"'.$selected.'>'.$fuente->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>