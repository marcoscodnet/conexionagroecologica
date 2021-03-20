<?php
class PosibleUsoSuelo extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('posible_uso_suelo');
		$this->hasColumn('contenido','string',255);
	}
	
	static public function toSelect ($propiedad=false) {
		$html = '';
		$posibleUsoSuelos = Doctrine::getTable('PosibleUsoSuelo')->findAll();
		$html .= '<select name="posibleUsoSuelo" id="posibleUsoSuelo">';
		if (!$propiedad) {
			foreach ($posibleUsoSuelos as $posibleUsoSuelo) {
				$html .= '<option value="'.$posibleUsoSuelo->id.'">'.$posibleUsoSuelo->contenido.'</option>';
			}
		} else {
			foreach ($posibleUsoSuelos as $posibleUsoSuelo) {
				$selected = ($posibleUsoSuelo->id == $propiedad->posibleUsoSuelo->id)?'  selected="selected"':'';
				$html .= '<option value="'.$posibleUsoSuelo->id.'"'.$selected.'>'.$posibleUsoSuelo->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
	
	static public function toCheckbox () {
		$html = '';
		$posibleUsoSuelos = Doctrine::getTable('PosibleUsoSuelo')->findAll();
		$html .= '<table width="300px;"><tr>';	
		$i=1;
			foreach ($posibleUsoSuelos as $posibleUsoSuelo) {
				//$selected = ($posibleUsoSuelo->id == $propiedad->posibleUsoSuelo->id)?'  selected="selected"':'';
				if (($i % 2)!=0) {
					$html .= '</tr><tr>';	
				}
				$i++;
				$html .= '<td><p><input class="posibleCheck" type="checkbox" id="posibles_'.$posibleUsoSuelo->id.'" name="posibles_'.$posibleUsoSuelo->id.'">'.$posibleUsoSuelo->contenido.'</p></td>';
			}	
		
		$html .= '</tr></table>';
		return $html;
	}
	
}
?>