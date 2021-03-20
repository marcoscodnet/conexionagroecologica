<?php
class TipoContrato extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('tipo_contrato');
		$this->hasColumn('contenido','string',255);
	}
	
	static public function toSelect ($propiedad=false) {
		$html = '';
		$tipoContratos = Doctrine::getTable('TipoContrato')->findAll();
		$html .= '<select name="tipoContrato" id="tipoContrato">';
		if (!$propiedad) {
			foreach ($tipoContratos as $tipoContrato) {
				$html .= '<option value="'.$tipoContrato->id.'">'.$tipoContrato->contenido.'</option>';
			}
		} else {
			foreach ($tipoContratos as $tipoContrato) {
				$selected = ($tipoContrato->id == $propiedad->tipoContrato->id)?'  selected="selected"':'';
				$html .= '<option value="'.$tipoContrato->id.'"'.$selected.'>'.$tipoContrato->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>