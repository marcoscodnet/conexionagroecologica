<?php
class ListaPrecio extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('lista_precio');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('material', 'string', 255);
        $this->hasColumn('precio_kg','float',10);
        $this->hasColumn('variacion_precio','float',10);
        $this->hasColumn('variacion_porcentaje','float',10);
		$this->hasColumn('tipo', 'string', 20);
        
    }
    
	public function setUp() {
        
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('material'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Timestampable');
    }
    
}
?>