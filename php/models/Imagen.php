<?php
class Imagen extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('imagen');
        $this->hasColumn('ruta', 'string', 128);
        $this->hasColumn('orden', 'integer', 3);
        $this->hasColumn('id_propiedad', 'integer');
        $this->hasColumn('id_caso', 'integer', 4, array('unsigned'=>true));
        $this->hasColumn('id_jornada', 'integer', 4, array('unsigned'=>true));
        $this->hasColumn('id_popup', 'integer', 4, array('unsigned'=>true));
    }

    public function setUp() {
        $this->hasOne('Propiedad as propiedad', array(
            'local' => 'id_propiedad',
            'foreign' => 'id'
        ));
        $this->hasOne('Caso as caso', array(
            'local' => 'id_caso',
            'foreign' => 'id'
        ));
        $this->hasOne('Jornada as jornada', array(
            'local' => 'id_jornada',
            'foreign' => 'id'
        ));
        $this->hasOne('Popup as popup', array(
            'local' => 'id_popup',
            'foreign' => 'id'
        ));
    }
    
    public static function lastId () {
        $q = Doctrine_Query::create()
                ->select('i.id')
                ->from('Imagen i')
                ->orderBy('i.id desc')
                ->limit(1)
                ->offset(0);
        $result = $q->fetchOne(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
        return $result;
    }

}
?>