<?php
class Subcategoria extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('subcategoria');
        $this->hasColumn('contenido', 'string', 150);
        $this->hasColumn('id_categoria', 'integer');
    }

    public function setUp() {
        $this->hasOne('Categoria as categoria', array(
            'local' => 'id_categoria',
            'foreign' => 'id'
        ));
        $this->hasMany('Reciclador as recicladores', array(
            'local' => 'id_subcategoria',
            'foreign' => 'id_reciclador',
            'refClass' => 'RelRecicladorSubcategoria'
        ));
        $this->hasMany('UsuarioIntereses as usuario_intereses', array(
            'local' => 'id_subcategoria',
            'foreign' => 'id_usuario_intereses',
            'refClass' => 'RelUsuarioInteresesSubcategoria'
        ));
    }

    public function getContenido() {
        $cont = $this->_get('contenido');
        return utf8_decode($cont);
    }

    public static function toSmartSelect($objeto = false) {
        $subcategoriaId = ($objeto) ? $objeto->subcategoria->id : 0;
        $subcategorias = Doctrine_Query::create()
                ->select('s.*')
                ->from('Subcategoria s')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select  id="selectSubcategoria" name="subcategoria"><option value="0">Elegir</option>';
        foreach ($subcategorias as $subcategoria) {
            $selected = ($subcategoria['id'] == $subcategoriaId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $subcategoria['id'] . '"' . $selected . '>' . $subcategoria['contenido'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

}
?>