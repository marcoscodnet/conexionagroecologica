<?php
class Proveedor extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('proveedor');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('nombre', 'string', 127);
        $this->hasColumn('tel', 'string', 50);
        $this->hasColumn('email', 'string', 50);
        $this->hasColumn('web', 'string', 80);
        $this->hasColumn('id_localidad', 'integer');
        $this->hasColumn('id_subcategoria', 'integer', 3, array('unsigned'=>true));
        $this->hasColumn('descripcion', 'string', 10000);
    }

    public function setUp() {
        $this->hasOne('Localidad as localidad', array(
            'local' => 'id_localidad',
            'foreign' => 'id'
        ));
        $this->hasOne('SubcategoriaProveedor as subcategoria', array(
            'local' => 'id_subcategoria',
            'foreign' => 'id'
        ));
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('nombre'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Timestampable');
    }
}
?>