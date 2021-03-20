<?php
class Telefono extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('telefono');
		$this->hasColumn('tipo','integer',1); //1 = telefono - 2 = celular
		$this->hasColumn('area','integer',4);
		$this->hasColumn('numero','integer',8);
	}
	
	public function toString () {
		$html = '';
		if (!$this->numero) {
			$html = 'No especificado';
		} else {
			if ($this->tipo == 1) {
				$html .= '('.$this->area.') - ';
				$html .= $this->agregarGuion($this->numero);
			} else {
				$html .= '('.$this->area.') - ';
				$html .= '15 - ';
				$html .= $this->agregarGuion($this->numero);
			}
		}
		return $html;
	}
	
	private function agregarGuion ($num) {
		$largoInicio = strlen($num) - 4;
		$inicio = substr($num, 0, $largoInicio);
		$fin = substr($num, -4);
		return $inicio.'-'.$fin;
	}
	
	public function setArea ($area) {
		$area = $area.'';
		$area = preg_replace('/^0+/', '', $area);
		$this->_set('area', $area);
	}
	
	public function getArea () {
		$area = $this->_get('area');
		return ($area)?'00'.$area:'';
	}
}
?>