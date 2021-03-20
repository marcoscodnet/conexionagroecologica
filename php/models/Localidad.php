<?php

class Localidad extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('localidad');
        $this->hasColumn('contenido', 'string', 150);
        $this->hasColumn('id_provincia', 'integer');
    }

    public function setUp() {
        $this->hasOne('Provincia as provincia', array(
            'local' => 'id_provincia',
            'foreign' => 'id',
            'onUpadate' => 'CASCADE'
        ));
        
        $this->hasMany('UsuarioIntereses as usuario_intereses', array(
            'local' => 'id_localidad',
            'foreign' => 'id_usuario_intereses',
            'refClass' => 'RelUsuarioInteresesLocalidad'
        ));
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

    public static function toSmartSelect($objeto = false) {
        $localidadId = ($objeto) ? $objeto->localidad->id : 0;
        $localidades = Doctrine_Query::create()
                ->select('l.*')
                ->from('Localidad l')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select id="selectLocalidad" name="localidad"><option value="0">Elegir</option>';
        foreach ($localidades as $localidad) {
            $selected = ($localidad['id'] == $localidadId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $localidad['id'] . '"' . $selected . '>' . $localidad['contenido'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

}
?>