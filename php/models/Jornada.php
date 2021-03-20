<?php
class Jornada extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('jornada');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('titulo', 'string', 255);
        $this->hasColumn('descripcion', 'string', 10000);
        $this->hasColumn('blog', 'string', 255);
    }

 public function setUp() {
        
        $this->hasMany('Imagen as imagenes', array(
            'local' => 'id',
            'foreign' => 'id_jornada'
        ));
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('titulo'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Timestampable');
    }
    
    public function sortedImages ($hydrateMode=Doctrine::HYDRATE_ARRAY) {
        return Doctrine_Query::create()
                ->select('i.*')
                ->from('Imagen i')
                ->innerJoin('i.jornada j WITH j.id = '.$this->id)
                ->orderBy('i.orden')
                ->execute(array(), $hydrateMode)
        ;
    }
}
?>