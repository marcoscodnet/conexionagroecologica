<?php
class TipoReciclador extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('tipo_reciclador');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 50);
    }
    
    public static function toSmartSelect($objeto = false) {
        $tipoId = ($objeto) ? $objeto->tipo->id : 0;
        $tipos = Doctrine_Query::create()
                ->select('t.*')
                ->from('TipoReciclador t')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select  id="selectTipoReciclador" name="tipo">';
        foreach ($tipos as $tipo) {
            $selected = ($tipo['id'] == $tipoId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $tipo['id'] . '"' . $selected . '>' . $tipo['value'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}
?>