<?php
class Popup extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('popup');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('titulo', 'string', 255);
        $this->hasColumn('ruta', 'string', 255);
        $this->hasColumn('popup_activo', 'integer', 1, array('unsigned'=>true, 'default'=>0));
    }

	public function setUp() {
        
        $this->hasMany('Imagen as imagenes', array(
            'local' => 'id',
            'foreign' => 'id_popup'
        ));
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('titulo'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Timestampable');
    }
    
	public function sortedImages ($hydrateMode=Doctrine::HYDRATE_ARRAY) {
        return Doctrine_Query::create()
                ->select('i.*')
                ->from('Imagen i')
                ->innerJoin('i.popup p WITH p.id = '.$this->id)
                ->orderBy('i.orden')
                ->execute(array(), $hydrateMode)
        ;
    }
}
?>