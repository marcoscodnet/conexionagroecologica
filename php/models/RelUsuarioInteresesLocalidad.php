<?php

class RelUsuarioInteresesLocalidad extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('rel_usuario_intereses_localidad');
        $this->hasColumn('id_usuario_intereses', 'integer', 4, array(
            'primary' => true, 'unsigned' => true,
        ));

        $this->hasColumn('id_localidad', 'integer', null, array(
            'primary' => true
        ));
    }
    
	public function setUp() {
        $this->hasOne('Localidad as localidad', array(
            'local' => 'id_localidad',
            'foreign' => 'id',
            'onUpadate' => 'CASCADE'
        ));
        
    }

}
?>