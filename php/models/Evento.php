<?php
class Evento extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('evento');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('fecha', 'datetime');
        $this->hasColumn('titulo', 'string', 127);
        $this->hasColumn('organizador', 'string', 127);
        $this->hasColumn('direccion', 'string', 127);
        $this->hasColumn('web', 'string', 80);
        $this->hasColumn('telefono', 'string', 30);
        $this->hasColumn('email', 'string', 50);
        $this->hasColumn('fb', 'string', 80);
        $this->hasColumn('tw', 'string', 80);
        $this->hasColumn('id_provincia', 'integer');
        $this->hasColumn('id_categoria', 'integer', 1, array('unsigned'=>true));
    }

    public function setUp() {
        $this->hasOne('Provincia as provincia', array(
            'local' => 'id_provincia',
            'foreign' => 'id'
        ));
        $this->hasOne('CategoriaEvento as categoria', array(
            'local' => 'id_categoria',
            'foreign' => 'id'
        ));
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('titulo'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Timestampable');
    }
    
    public function getDate () {
        $diaHora = new stdClass();
        $date = explode(' ', $this->_get('fecha'));
        $diaHora->dia = preg_replace('/([0-9]{4})-([0-9]{2})-([0-9]{2})/','$3-$2-$1', $date[0]);
        if ($date[1] > "12:00") {
           $diaHora->hora = preg_replace('/([0-9]{1,2}):([0-9]{1,2})/e','("$1" - 12).":$2"', $date[1]).' PM';
        } else {
            $diaHora->hora = $date[1].' AM';
        }
        
        return $diaHora;
    }
}
?>