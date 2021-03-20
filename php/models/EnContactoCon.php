<?php
class EnContactoCon extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('encontactocon');
		$this->hasColumn('contenido','string',300);
	}
	
	public function getContenido () {
		$contenido = $this->_get('contenido');
		return utf8_decode($contenido);
	}
	
	static public function toSelect ($producto=false) {
		$html = '';
		$enContactoCon = Doctrine::getTable('encontactocon')->findAll();
		$html .= '<select id="selectEnContactoCon" name="enContactoCon">';
		if (!$producto) {
			foreach ($enContactoCon as $n) {
				$html .= '<option value="'.$n->id.'">'.$n->contenido.'</option>';
			}
		} else {
			foreach ($enContactoCon as $n) {
				$selected = ($n->id == $producto->enContactoCon->id)?'  selected="selected"':'';
				$html .= '<option value="'.$n->id.'"'.$selected.'>'.$n->contenido.'</option>';
			}	
		}
		$html .= '</select>';
		return $html;
	}
}
?>