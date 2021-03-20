<?php
class UsuarioIntereses extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('usuario_intereses');
		$this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
		$this->hasColumn('id_usuario','integer');
	}
	
	public function setUp(){
		$this->hasOne('Usuario as usuario',array(
			'local'=>'id_usuario',
			'foreign'=>'id'
		));
		$this->hasMany('Subcategoria as subcategorias', array(
            'local' => 'id_usuario_intereses',
            'foreign' => 'id_subcategoria',
            'refClass' => 'RelUsuarioInteresesSubcategoria'
        ));
        $this->hasMany('Localidad as localidades', array(
            'local' => 'id_usuario_intereses',
            'foreign' => 'id_localidad',
            'refClass' => 'RelUsuarioInteresesLocalidad'
        ));
        //behaviors
		$this->actAs('Timestampable');
	}
	
	public function subcategoriasToString ($separator = ', ') {
        $q = Doctrine_Query::create()
                ->select("group_concat(CONCAT(c.contenido,': ',s.contenido) separator '$separator') as value")
                ->from('Subcategoria s')
                ->innerJoin('s.categoria c')
                ->innerJoin('s.usuario_intereses r WITH r.id = '.$this->id)
                ->groupBy('r.id');
        $subcategorias = $q->fetchOne();
        return ($subcategorias)?$subcategorias->value:'';
    }
    
	public function localidadesToString ($separator = ', ') {
        $q = Doctrine_Query::create()
                ->select("group_concat(DISTINCT p.contenido separator '$separator') as value")
                ->from('Localidad l')
                ->innerJoin('l.provincia p')
                ->innerJoin('l.usuario_intereses r WITH r.id = '.$this->id)
                ->groupBy('r.id');
        $localidades = $q->fetchOne();
        return ($localidades)?$localidades->value:'';
    }
}
?>