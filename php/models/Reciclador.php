<?php
class Reciclador extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('reciclador');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('nombre', 'string', 127);
        $this->hasColumn('tel', 'string', 50);
        $this->hasColumn('email', 'string', 50);
        $this->hasColumn('web', 'string', 80);
        $this->hasColumn('id_localidad', 'integer');
        $this->hasColumn('id_tipo', 'integer', 3, array('unsigned'=>true));
        $this->hasColumn('direccion', 'string', 130);
        $this->hasColumn('latitud', 'string', 50);
        $this->hasColumn('longitud', 'string', 50);
    }

    public function setUp() {
        $this->hasOne('Localidad as localidad', array(
            'local' => 'id_localidad',
            'foreign' => 'id'
        ));
        $this->hasOne('TipoReciclador as tipo', array(
            'local' => 'id_tipo',
            'foreign' => 'id'
        ));
        $this->hasMany('Subcategoria as subcategorias', array(
            'local' => 'id_reciclador',
            'foreign' => 'id_subcategoria',
            'refClass' => 'RelRecicladorSubcategoria'
        ));
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('nombre'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Timestampable');
    }
    
    public function subcategoriasToString ($separator = ', ') {
        $q = Doctrine_Query::create()
                ->select("group_concat(s.contenido separator '$separator') as value")
                ->from('Subcategoria s')
                ->innerJoin('s.recicladores r WITH r.id = '.$this->id)
                ->groupBy('r.id');
        $subcategorias = $q->fetchOne();
        return ($subcategorias)?$subcategorias->value:'';
    }
    
    public function categoriasToHtml () {
        $html = '';
        $q = Doctrine_Query::create()
                ->select("c.id, concat(c.contenido, ': ', group_concat(s.contenido separator ', ')) as value")
                ->from('Categoria c')
                ->innerJoin('c.subcategorias s')
                ->innerJoin('s.recicladores r')
                ->where('r.id = ?', $this->id)
                ->groupBy('r.id, c.id');
        //echo($q->getSqlQuery()); exit();
        $result = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
        foreach ($result as $item) {
            $html .= $item['value'].'<br />';
        }
        return preg_replace('#(<br />)$#', '', $html);
    }
}
?>