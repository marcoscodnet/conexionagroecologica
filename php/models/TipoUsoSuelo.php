<?php
class TipoUsoSuelo extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('tipo_uso_suelo');
		$this->hasColumn('contenido','string',255);
	}
	
	static public function toSelect ($propiedad=false) {
		$html = '';
		$tipoUsoSuelos = Doctrine::getTable('TipoUsoSuelo')->findAll();
		$html .= '<select name="tipoUsoSuelo" id="tipoUsoSuelo">';
		if (!$propiedad) {
			foreach ($tipoUsoSuelos as $tipoUsoSuelo) {
				$html .= '<option value="'.$tipoUsoSuelo->id.'">'.$tipoUsoSuelo->contenido.'</option>';
			}
		} else {
			foreach ($tipoUsoSuelos as $tipoUsoSuelo) {
				$selected = ($tipoUsoSuelo->id == $propiedad->tipoUsoSuelo->id)?'  selected="selected"':'';
				$html .= '<option value="'.$tipoUsoSuelo->id.'"'.$selected.'>'.$tipoUsoSuelo->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
	
}
?>