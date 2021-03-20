<?php
class Sponsor extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('sponsor');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('nombre', 'string', 255);
        $this->hasColumn('orden', 'integer', 3, array('default'=>0, 'unsigned'=>true));
        $this->hasColumn('size', 'integer', 1, array('default'=>1, 'unsigned'=>true)); //1: chico - 2: grande
        $this->hasColumn('link', 'string', 255);
        $this->hasColumn('id_imagen', 'integer');
        $this->hasColumn('id_categoria', 'integer', 2, array('unsigned'=>true));
    }

    public function setUp() {
        $this->hasOne('Imagen as imagen', array(
            'local' => 'id_imagen',
            'foreign' => 'id'
        ));
        $this->hasOne('CategoriaSponsor as categoria', array(
            'local' => 'id_categoria',
            'foreign' => 'id'
        ));
        $this->actAs('Sluggable', array('fields'=>array('nombre'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
    }
    
     public static function sizeToSelect($objeto = false) {
        $size = ($objeto)?$objeto->size:0;
        $sizes = array(array('value'=>1, 'label'=>'Chico'), array('value'=>2, 'label'=>'Grande'));
        $html = '<select id="selectSize" name="size">';
        foreach ($sizes as $s) {
            $selected = ($s['value'] == $size) ? ' selected="selected"' : '';
            $html .= '<option value="' . $s['value'] . '"' . $selected . '>' . $s['label'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

}
?>