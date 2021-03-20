<?php
class UsoSuelo extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('uso_suelo');
		$this->hasColumn('contenido','string',255);
	}
	
	static public function toSelect ($propiedad=false) {
		$html = '';
		$usoSuelos = Doctrine::getTable('UsoSuelo')->findAll();
		$html .= '<select name="usoSuelo" id="usoSuelo">';
		if (!$propiedad) {
			foreach ($usoSuelos as $usoSuelo) {
				$html .= '<option value="'.$usoSuelo->id.'">'.$usoSuelo->contenido.'</option>';
			}
		} else {
			foreach ($usoSuelos as $usoSuelo) {
				$selected = ($usoSuelo->id == $propiedad->usoSuelo->id)?'  selected="selected"':'';
				$html .= '<option value="'.$usoSuelo->id.'"'.$selected.'>'.$usoSuelo->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>