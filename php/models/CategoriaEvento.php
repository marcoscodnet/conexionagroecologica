<?php
class CategoriaEvento extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('categoria_evento');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 50);
    }
    
    public static function toSmartSelect($objeto = false) {
        $categoriaId = ($objeto) ? $objeto->categoria->id : 0;
        $categorias = Doctrine_Query::create()
                ->select('c.*')
                ->from('CategoriaEvento c')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select id="selectCategoria" name="categoria"><option value="0">Elegir</option>';
        foreach ($categorias as $categoria) {
            $selected = ($categoria['id'] == $categoriaId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $categoria['id'] . '"' . $selected . '>' . $categoria['value'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
    
}
?>