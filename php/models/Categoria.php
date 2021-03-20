<?php

class Categoria extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('categoria');
        $this->hasColumn('contenido', 'string', 150);
    }

    public function setUp() {
        $this->hasMany('Subcategoria as subcategorias', array(
            'local' => 'id',
            'foreign' => 'id_categoria'
        ));
    }

    var $selected = false;

    public function getContenido() {
        $cont = $this->_get('contenido');
        return utf8_decode($cont);
    }

    /* public function setContenido ($contenido) {
      $cont = utf8_encode($contenido);
      $this->_set('contenido', $cont);
      } */

    public function addSubcatetorias() {
        $total = func_num_args();
        for ($i = 0; $i < $total; $i++) {
            $sub = new Subcategoria ();
            $sub->contenido = func_get_arg($i);
            $sub->save();
            $this->subcategorias[] = $sub;
        }
    }

    public function toSelect($producto = false) {
        $html = '';
        $categorias = Doctrine::getTable('categoria')->findAll();
        $html .= '<select id="selectCategoria" name="categoria">';
        if (!$producto) {
            foreach ($categorias as $cat) {
                $html .= '<option value="' . $cat->id . '">' . $cat->contenido . '</option>';
            }
        } else {
            foreach ($categorias as $cat) {
                if ($cat->id == $producto->subcategoria->categoria->id) {
                    $selected = '  selected="selected"';
                    $this->selected = $cat;
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $cat->id . '"' . $selected . '>' . $cat->contenido . '</option>';
            }
        }
        $html .= '</select>';
        return $html;
    }

    public static function toSmartSelect($objeto = false) {
        $categoriaId = ($objeto) ? $objeto->categoria->id : 0;
        $categorias = Doctrine_Query::create()
                ->select('c.*')
                ->from('Categoria c')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
        ;
        $html = '<select id="selectCategoria" name="categoria"><option value="0">Elegir</option>';
        $html .= '<option value="" selected="selected">Cualquier Categor&iacute;a</option>';
        foreach ($categorias as $categoria) {
            $selected = ($categoria['id'] == $categoriaId) ? ' selected="selected"' : '';
            $html .= '<option value="' . $categoria['id'] . '"' . $selected . '>' . $categoria['contenido'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public function subcategoriasToSelect($producto = false) {
        $subcategorias = ($this->selected) ? $this->selected->subcategorias : $this->subcategorias;
        $html = '';
        $html .= '<select id="selectSubcategoria" name="subcategoria">';
        if (!$producto) {
            $i = 0;
            foreach ($subcategorias as $sub) {
                if ($i == 0) {
                    $html .= '<!--{subcategoriaPrimerOption}-->';
                }
                $html .= '<option value="' . $sub->id . '">' . $sub->contenido . '</option>';
                $i++;
            }
        } else {
            foreach ($subcategorias as $sub) {
                if ($sub->id == $producto->subcategoria->id) {
                    $selected = '  selected="selected"';
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $sub->id . '"' . $selected . '>' . $sub->contenido . '</option>';
            }
        }
        $html .= '</select>';
        return $html;
    }

}

?>