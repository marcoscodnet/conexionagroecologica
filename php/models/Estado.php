<?php
class Estado extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('estado');
		$this->hasColumn('contenido','string',50);
	}
	
	static public function aceptada () {
		return Doctrine::getTable('estado')->findOneByContenido('aceptada');
	}
	
	static public function rechazada () {
		return Doctrine::getTable('estado')->findOneByContenido('rechazada');
	}
	
	static public function finalizada () {
		return Doctrine::getTable('estado')->findOneByContenido('finalizada');
	}
	
	static public function pendiente () {
		return Doctrine::getTable('estado')->findOneByContenido('pendiente');
	}
	
	static public function leido () {
		return Doctrine::getTable('estado')->findOneByContenido('leido');
	}
	
	static public function noLeido () {
		return Doctrine::getTable('estado')->findOneByContenido('no leido');
	}
	
	static public function comprada () {
		return Doctrine::getTable('estado')->findOneByContenido('comprada');
	}
	
	static public function borrada () {
		return Doctrine::getTable('estado')->findOneByContenido('borrada');
	}
	public static function filtrados ($arrayFiltro) {
		$ids = join(',',$arrayFiltro);  
		$filtro='e.id in ('.$ids.')';
		$q = Doctrine_Query::create()
			->select('e.*')
			->from('Estado e')
			->where($filtro);
		$resultado = $q->execute();
		return $resultado;
	}
	
	public function toSelect($estado = false) {
        $html = '';
        $estados = Estado::filtrados(array(1, 2, 4, 5));
        $html .= '<select id="selectEstado" name="estado">';
        $html .= '<option value="">todos</option>';
        if (!$estado) {
            foreach ($estados as $est) {
                $html .= '<option value="' . $est->id . '">' . $est->contenido . '</option>';
            }
        } else {
            foreach ($estados as $est) {
                if ($est->id == $estado) {
                    $selected = '  selected="selected"';
                    //$this->selected = $est;
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $est->id . '"' . $selected . '>' . $est->contenido . '</option>';
            }
        }
        $html .= '</select>';
        return $html;
    }
    
	public function toSelectPublicaciones($estado = false) {
        $html = '';
        $estados = Estado::filtrados(array(1,3,7));
        $html .= '<select id="selectEstado" name="estado">';
        $html .= '<option value="">todos</option>';
        if (!$estado) {
            foreach ($estados as $est) {
                $html .= '<option value="' . $est->id . '">' . $est->contenido . '</option>';
            }
        } else {
            foreach ($estados as $est) {
                if ($est->id == $estado) {
                    $selected = '  selected="selected"';
                    //$this->selected = $est;
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $est->id . '"' . $selected . '>' . $est->contenido . '</option>';
            }
        }
        $html .= '</select>';
        return $html;
    }

}
?>