<?php
class Ubicacion extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('ubicacion');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 50);
    }
    
    public static function toSmartSelect($objeto = false) {
        $ubicacionId = ($objeto) ? $objeto->ubicacion->id : 0;
        $ubicaciones = Doctrine_Query::create()
                ->select('u.*')
                ->from('Ubicacion u')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select  id="selectUbicacion" name="ubicacion"><option value="0">Elegir</option>';
        foreach ($ubicaciones as $ubicacion) {
            $selected = ($ubicacion['id'] == $ubicacionId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $ubicacion['id'] . '"' . $selected . '>' . $ubicacion['value'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
    
}
?>