<?php

class Propiedad extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('propiedad');
        $this->hasColumn('id_uso_suelo', 'integer'); 
        $this->hasColumn('otro_uso_suelo', 'string', 255);
        $this->hasColumn('id_tipo_uso_suelo', 'integer');
        $this->hasColumn('hectareas', 'integer');
        $this->hasColumn('otro_tipo_uso_suelo', 'string', 255);
        $this->hasColumn('id_tipo_contrato', 'integer');
        $this->hasColumn('id_posible_uso_suelo', 'integer'); //color
        $this->hasColumn('id_acceso_agua', 'integer'); //cantidad
        $this->hasColumn('titulo', 'string', 300);
        $this->hasColumn('descripcion', 'string', 10000);
        $this->hasColumn('id_direccion', 'integer');
        $this->hasColumn('casa_disponible', 'integer', 1, array('unsigned'=>true, 'default'=>0));
        $this->hasColumn('vive_terreno', 'integer', 1, array('unsigned'=>true, 'default'=>0));
        $this->hasColumn('latitud', 'string', 255);
        $this->hasColumn('longitud', 'string', 255);
    }

    public function setUp() {
        $this->hasOne('Publicacion as publicacion', array(
            'local' => 'id',
            'foreign' => 'id_propiedad'
        ));
        $this->hasOne('UsoSuelo as usoSuelo', array(
            'local' => 'id_uso_suelo',
            'foreign' => 'id'
        ));
        $this->hasOne('TipoUsoSuelo as tipoUsoSuelo', array(
            'local' => 'id_tipo_uso_suelo',
            'foreign' => 'id'
        ));
        $this->hasOne('TipoContrato as tipoContrato', array(
            'local' => 'id_tipo_contrato',
            'foreign' => 'id'
        ));
        $this->hasOne('PosibleUsoSuelo as posibleUsoSuelo', array(
            'local' => 'id_posible_uso_suelo',
            'foreign' => 'id'
        ));
        $this->hasOne('AccesoAgua as accesoAgua', array(
            'local' => 'id_acceso_agua',
            'foreign' => 'id'
        ));
        
        $this->hasOne('Direccion as direccion', array(
            'local' => 'id_direccion',
            'foreign' => 'id'
        ));
        
        $this->hasMany('Imagen as imagenes', array(
            'local' => 'id',
            'foreign' => 'id_propiedad'
        ));
    }

    public function getTitulo() {
        return utf8_decode($this->_get('titulo'));
    }

    public function setTitulo($titulo) {
        $this->_set('titulo', utf8_encode($titulo));
    }

    public function getDescripcion() {
        return utf8_decode($this->_get('descripcion'));
    }

    public function setDescripcion($descripcion) {
        $this->_set('descripcion', utf8_encode($descripcion));
    }

   

    

    static public function ultimoId() {
        $q = Doctrine_Query::create()
                ->select('p.id')
                ->from('propiedad p')
                ->orderBy('p.id desc')
                ->limit(1);
        $propiedad = $q->execute();
        return $propiedad[0]->id;
    }

    public function imagenesToHTML($tipo = 'ch') {
        $html = '';
        if ($tipo == 'ch') {
            $i = 0;
            foreach ($this->imagenes as $imagen) {
                $html .= '<img alt="' . htmlentities($this->titulo) . '" src="images/propiedades/ch/' . $imagen->ruta . '?i=' . time() . '" id="img' . $i . '" class="fadeFotos" />';
                $i++;
            }
        } else {
            $i = 0;
            $html .= '<div id="imagenes">';
            foreach ($this->imagenes as $imagen) {
                $active = ($i == 0) ? 'active ' : '';
                $html .= '<a href="images/propiedades/' . $imagen->ruta . '?i=' . time() . '" class="galleryBox" rel="galleryBox' . $this->id . '" title="' . htmlentities($this->titulo) . '">';
                $html .= '<div class="zoomHover"></div>';
                $html .= '<img src="images/propiedades/gr/' . $imagen->ruta . '?i=' . time() . '" alt="' . htmlentities($this->titulo) . '" class="' . $active . 'galeria" />';
                $html .= '</a>';
                $i++;
            }
            $html .= '</div>';
        }
        return $html;
    }

    //validaciones
    public function isVencido() {
        return $this->publicacion->isVencida();
    }

    public function sePuedeMostrar($usuario) {
        $mostrarPropio = ($usuario) ? ($usuario->id == $this->publicacion->owner) : true;
        return $this->isVencido && $mostrarPropio;
    }

}

?>