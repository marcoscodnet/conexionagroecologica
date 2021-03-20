<?php

class Provincia extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('provincia');
        $this->hasColumn('contenido', 'string', 150);
    }

    public function setUp() {
        $this->hasMany('Localidad as localidades', array(
            'local' => 'id',
            'foreign' => 'id_provincia',
            'onUpadate' => 'CASCADE'
        ));
    }

    var $selected = false;

    public function toSelect($producto = false) {
        $html = '';
        $provincias = Doctrine::getTable('provincia')->findAll();
        $html .= '<select id="selectProvincia" name="provincia">';
        if (!$producto) {
            foreach ($provincias as $prov) {
                $html .= '<option value="' . $prov->id . '">' . $prov->contenido . '</option>';
            }
        } else {
            foreach ($provincias as $prov) {
                if ($prov->id == $producto->direccion->localidad->provincia->id) {
                    $selected = '  selected="selected"';
                    $this->selected = $prov;
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $prov->id . '"' . $selected . '>' . $prov->contenido . '</option>';
            }
        }
        $html .= '</select>';
        return $html;
    }

    public function localidadesToSelect($producto = false) {
        $localidades = ($this->selected) ? $this->selected->localidades : $this->localidades;
        $html = '';
        $html .= '<select id="selectLocalidad" name="localidad">';
        if (!$localidades->count()) {
            $html .= '<!--{localidadPrimerOption}-->';
        }
        if (!$producto) {
            $i = 0;
            foreach ($localidades as $loc) {
                if ($i == 0) {
                    $html .= '<!--{localidadPrimerOption}-->';
                }
                $html .= '<option value="' . $loc->id . '">' . $loc->contenido . '</option>';
                $i++;
            }
        } else {
            foreach ($localidades as $loc) {
                if ($loc->id == $producto->direccion->localidad->id) {
                    $selected = '  selected="selected"';
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $loc->id . '"' . $selected . '>' . $loc->contenido . '</option>';
            }
        }
        $html .= '</select>';
        return $html;
    }
    
    public static function toSmartSelect($objeto = false) {
        $localidadId = ($objeto) ? $objeto->provincia->id : 0;
        $localidades = Doctrine_Query::create()
                ->select('p.*')
                ->from('Provincia p')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select id="selectProvincia" name="provincia"><option value="0">Elegir</option>';
        foreach ($localidades as $localidad) {
            $selected = ($localidad['id'] == $localidadId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $localidad['id'] . '"' . $selected . '>' . $localidad['contenido'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public function toString() {
        $html = $this->_get('contenido');
        $html = str_replace('&#225;', 'á', $html);
        $html = str_replace('&#233;', 'é', $html);
        $html = str_replace('&#237;', 'í', $html);
        $html = str_replace('&#243;', 'ó', $html);
        $html = str_replace('&#250;', 'ú', $html);
        $html = str_replace('&#252;', 'ü', $html);
        $html = str_replace('&#241;', 'ñ', $html);
        return $html;
    }

}
?>