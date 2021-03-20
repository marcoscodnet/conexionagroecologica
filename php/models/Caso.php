<?php
class Caso extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('caso');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('titulo', 'string', 255);
        $this->hasColumn('descripcion', 'string', 10000);
        $this->hasColumn('destacado', 'integer', 1, array('unsigned'=>true, 'default'=>0));
        $this->hasColumn('id_subcategoria', 'integer');
        $this->hasColumn('id_ubicacion', 'integer', 1, array('unsigned'=>true));
    }

    public function setUp() {
        $this->hasOne('Ubicacion as ubicacion', array(
            'local' => 'id_ubicacion',
            'foreign' => 'id'
        ));
        $this->hasOne('Subcategoria as subcategoria', array(
            'local' => 'id_subcategoria',
            'foreign' => 'id'
        ));
        $this->hasMany('Imagen as imagenes', array(
            'local' => 'id',
            'foreign' => 'id_caso'
        ));
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('titulo'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Timestampable');
    }
    
    public function sortedImages ($hydrateMode=Doctrine::HYDRATE_ARRAY) {
        return Doctrine_Query::create()
                ->select('i.*')
                ->from('Imagen i')
                ->innerJoin('i.caso c WITH c.id = '.$this->id)
                ->orderBy('i.orden')
                ->execute(array(), $hydrateMode)
        ;
    }
}
?>