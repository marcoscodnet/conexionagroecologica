<?php
class AccesoAgua extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('acceso_agua');
		$this->hasColumn('contenido','string',255);
	}
	
	static public function toSelect ($propiedad=false) {
		$html = '';
		$accesoAguas = Doctrine::getTable('AccesoAgua')->findAll();
		$html .= '<select name="accesoAgua" id="accesoAgua">';
		if (!$propiedad) {
			foreach ($accesoAguas as $accesoAgua) {
				$html .= '<option value="'.$accesoAgua->id.'">'.$accesoAgua->contenido.'</option>';
			}
		} else {
			foreach ($accesoAguas as $accesoAgua) {
				$selected = ($accesoAgua->id == $propiedad->accesoAgua->id)?'  selected="selected"':'';
				$html .= '<option value="'.$accesoAgua->id.'"'.$selected.'>'.$accesoAgua->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>