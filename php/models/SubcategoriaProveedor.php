<?php
class SubcategoriaProveedor extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('subcategoria_proveedor');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 50);
        $this->hasColumn('id_categoria', 'integer', 2, array('unsigned'=>true));
    }
    
    public function setUp() {
        $this->hasOne('CategoriaProveedor as categoria', array(
            'local' => 'id_categoria',
            'foreign' => 'id'
        ));
    }
    
    public static function toSmartSelect($objeto = false) {
        $subcategoriaId = ($objeto) ? $objeto->subcategoria->id : 0;
        $subcategorias = Doctrine_Query::create()
                ->select('s.*')
                ->from('SubcategoriaProveedor s')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select  id="selectSubcategoriaProveedor" name="subcategoria"><option value="0">Elegir</option>';
        foreach ($subcategorias as $subcategoria) {
            $selected = ($subcategoria['id'] == $subcategoriaId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $subcategoria['id'] . '"' . $selected . '>' . $subcategoria['value'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}
?>