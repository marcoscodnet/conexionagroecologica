<?php
class Usuario extends Doctrine_Record {

    private $mapPaginado = array(
        'misPublicaciones' => array('tabla' => 'publicacion', 'owner' => 'owner', 'estado' => '%', 'orderBy' => 'inicio'),
        'mensajesRecibidos' => array('tabla' => 'mensaje', 'owner' => 'receptor', 'estado' => '%', 'orderBy' => 'id_estado desc, t.id'),
        'mensajesEnviados' => array('tabla' => 'mensaje', 'owner' => 'emisor', 'estado' => '%', 'orderBy' => 'id_estado desc, t.id'),
        'comprasRealizadas' => array('tabla' => 'transaccion', 'owner' => 'comprador', 'estado' => 'aceptada', 'orderBy' => 'fecha'),
        'ventasRealizadas' => array('tabla' => 'transaccion', 'owner' => 'vendedor', 'estado' => 'aceptada', 'orderBy' => 'fecha'),
        'favoritos' => array('tabla' => 'publicacion', 'owner' => 'seguidores', 'estado' => '%', 'orderBy' => 'inicio')
    );

    public function setTableDefinition() {
        $this->setTableName('usuario');
        $this->hasColumn('nombre', 'string', 150);
        $this->hasColumn('apellido', 'string', 150);
        $this->hasColumn('email', 'string', 150);
        $this->hasColumn('company', 'string', 300);
        $this->hasColumn('razon', 'string', 300); //razon social
        $this->hasColumn('cuit', 'integer', 12);
        $this->hasColumn('pass', 'string', 32);
        $this->hasColumn('user_id', 'integer'); //favoritos (many to many)
        $this->hasColumn('id_telefono', 'integer'); //telefono
        $this->hasColumn('id_celular', 'integer'); //celular
        //$this->hasColumn('puntos','float'); //estrellitas del vendedor
        $this->hasColumn('codigo', 'string', 32);
        $this->hasColumn('id_localidad', 'integer');
        $this->hasColumn('propietario','boolean', array('default' => 'false'));
        $this->hasColumn('productor','boolean', array('default' => 'false'));
        $this->hasColumn('datos_disponibles','boolean', 1, array('default' => 0));
    }

    public function setUp() {
        $this->hasOne('Telefono as telefono', array(
            'local' => 'id_telefono',
            'foreign' => 'id'
        ));
        $this->hasOne('Telefono as celular', array(
            'local' => 'id_celular',
            'foreign' => 'id'
        ));
        $this->hasOne('Localidad as localidad', array(
            'local' => 'id_localidad',
            'foreign' => 'id'
        ));
        $this->hasMany('Publicacion as publicaciones', array(
            'local' => 'id',
            'foreign' => 'id_owner'
        ));
        $this->hasMany('Punto as puntos', array(
            'local' => 'id',
            'foreign' => 'id_owner'
        ));
        $this->hasMany('Publicacion as favoritos', array(
            'local' => 'user_id',
            'foreign' => 'favorito_id',
            'refClass' => 'Favorito'
        ));
        $this->hasMany('Venta as ventas', array(
            'local' => 'id',
            'foreign' => 'id_owner'
        ));
        $this->hasMany('Mensaje as mensajesEnviados', array(
            'local' => 'id',
            'foreign' => 'id_emisor'
        ));
        $this->hasMany('Mensaje as mensajesRecibidos', array(
            'local' => 'id',
            'foreign' => 'id_receptor'
        ));
        $this->hasMany('Transaccion as compras', array(
            'local' => 'id',
            'foreign' => 'id_comprador'
        ));
        $this->hasMany('Transaccion as ventas', array(
            'local' => 'id',
            'foreign' => 'id_vendedor'
        ));
    }

    public function telefonoToString() {
        return ($this->_get('id_telefono')) ? $this->telefono->toString() : 'No especificado';
    }

    public function celularToString() {
        return ($this->_get('id_celular')) ? $this->celular->toString() : 'No especificado';
    }

    public function getNombre() {
        return utf8_decode($this->_get('nombre'));
    }

    public function setNombre($nombre) {
        $this->_set('nombre', utf8_encode($nombre));
    }

    public function getApellido() {
        return utf8_decode($this->_get('apellido'));
    }

    public function setApellido($apellido) {
        $this->_set('apellido', utf8_encode($apellido));
    }

    public function getEmail() {
        return utf8_decode($this->_get('email'));
    }

    public function setEmail($email) {
        $this->_set('email', utf8_encode($email));
    }

    public function getCompany() {
        return utf8_decode($this->_get('company'));
    }

    public function setCompany($company) {
        $this->_set('company', utf8_encode($company));
    }

    public function getRazon() {
        return utf8_decode($this->_get('razon'));
    }

    public function setRazon($razon) {
        $this->_set('razon', utf8_encode($razon));
    }

    public function setPass($pass) {
        $this->_set('pass', md5($pass));
    }

    public function getReputacion() {
        $total = 0;
        foreach ($this->puntos as $punto) {
            $total += $punto->valor;
        }
        $html = '<span class="reputacion">';
        $puntos = ($this->puntos->count() > 1) ? round($total / ($this->puntos->count() - 1)) : 0;
        for ($i = 0; $i < 5; $i++) {
            $estrella = ($i < $puntos) ? '<span class="estrella"><strong>&bull;</strong></span>' : '<span class="estrellaVacia"><strong>&nbsp;</strong></span>';
            $html .= $estrella;
        }
        $html .= '</span>';
        return $html;
    }

    public static function syst() {
        return Doctrine::getTable('usuario')->find(1);
    }

    public static function admin() {
        return Doctrine::getTable('usuario')->find(2);
    }

    public function toString() {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function asignarCodigo() {
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $myCodigo = '';
        do {
            for ($i = 0; $i < 32; $i++) {
                $myCodigo .= substr($string, rand(0, 62), 1);
            }
            $codigo = Doctrine::getTable('codigo')->findOneByContenido($myCodigo);
        } while ($codigo);
        $objetoCodigo = new Codigo ();
        $objetoCodigo->contenido = $myCodigo;
        $objetoCodigo->save();
        $this->codigo = $myCodigo;
        $this->_set('codigo', $myCodigo);
    }

    static public function isValido($email, $pass) {
        $q = Doctrine_Query::create()
                ->select('u.*')
                ->from('Usuario u')
                ->where('u.email = ?', utf8_encode($email));
        $usuario = $q->execute();
        if ($usuario[0]->pass == md5($pass)) {
            return $usuario[0];
        } else {
            return false;
        }
    }

    public function publicar($propiedad, $fin) {
        $publicacion = new Publicacion ();
        $publicacion->propiedad = $propiedad;
        $publicacion->inicio = date('Y-m-d');
        $publicacion->finalizacion = $fin;
        $this->publicaciones[] = $publicacion;
        $publicacion->estado = Estado::pendiente();
        $publicacion->save();
    }

    public function comprar($producto) {
        $transaccion = new Transaccion ();
        $transaccion->fecha = date('Y-m-d');
        $transaccion->publicacion = $producto->publicacion;
        $transaccion->estado = Estado::pendiente();
        $this->compras[] = $transaccion;
        $producto->publicacion->owner->ventas[] = $transaccion;
        $producto->publicacion->estado = Estado::comprada();
        Doctrine_Manager::connection()->flush();
    }

    public function cambiarPass($passActual, $passNueva) {
        if ($this->pass == md5($passActual)) {
            $this->pass = $passNueva;
            return true;
        } else {
            return false;
        }
    }

    public function ventasSinCalificar() {
        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('transaccion t')
                ->innerJoin('t.vendedor v')
                ->innerJoin('t.estado e')
                ->where('v.id = ' . $this->id)
                ->andWhere('e.contenido <> "borrada" and e.contenido = "aceptada"')
                ->andWhere('t.aceptadaPorElVendedor = 0');
        $ventas = $q->execute();
        return $ventas;
    }

    public function comprasSinCalificar() {
        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('transaccion t')
                ->innerJoin('t.comprador c')
                ->innerJoin('t.estado e')
                ->where('c.id = ' . $this->id)
                ->andWhere('e.contenido <> "borrada" and e.contenido = "aceptada"')
                ->andWhere('t.aceptadaPorElComprador = 0');
        $compras = $q->execute();
        return $compras;
    }

    public function mensajesNoLeidos() {
        $q = Doctrine_Query::create()
                ->select('m.*')
                ->from('mensaje m')
                ->innerJoin('m.receptor u')
                ->innerJoin('m.estado e')
                ->where('u.id = ' . $this->id)
                ->andWhere('e.contenido = "no leido"');
        $mensajes = $q->execute();
        return $mensajes;
    }

    public function inFavoritos($producto) {
        $q = Doctrine_Query::create()
                ->select('f.*')
                ->from('Favorito f')
                ->where('f.user_id = ' . $this->id)
                ->andWhere('f.favorito_id = ' . $producto->id);
        $resultado = $q->execute();
        return $resultado->count();
    }

    public function inCompras($producto) {
        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('transaccion t')
                ->innerJoin('t.comprador c')
                ->innerJoin('t.publicacion p')
                ->innerJoin('p.producto pr')
                ->where('c.id = ' . $this->id)
                ->andWhere('pr.id = ' . $producto->id);
        $compras = $q->execute();
        return count($compras);
    }

    //FUNCIONES PARA LOS PAGINADORES
    public function paginar($atributo, $cuantos, $desde) {
    	//$aceptados=(($atributo=='mensajesEnviados')||($atributo=='mensajesRecibidos'))?'e.contenido = "aceptada"':'1=1';
        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from($this->mapPaginado[$atributo]['tabla'] . ' t')
                ->innerJoin('t.' . $this->mapPaginado[$atributo]['owner'] . ' u')
                ->innerJoin('t.estado e')
                ->where('u.id = ' . $this->id)
                ->andWhere('e.contenido <> "borrada"')
                //->andWhere($aceptados)
                ->andWhere('e.contenido like ?', array($this->mapPaginado[$atributo]['estado']))
                ->limit($cuantos) //cuantos trae
                ->offset($desde) //a partir de donde empieza a traer
                ->orderBy('t.' . $this->mapPaginado[$atributo]['orderBy'] . ' desc');
        $resultado = $q->execute();
        return $resultado;
    }

    public function contar($atributo) {
        //$aceptados=(($atributo=='mensajesEnviados')||($atributo=='mensajesRecibidos'))?'e.contenido = "aceptada"':'1=1';
        $q = Doctrine_Query::create()
                ->select('COUNT(t.id) as total')
                ->from($this->mapPaginado[$atributo]['tabla'] . ' t')
                ->innerJoin('t.' . $this->mapPaginado[$atributo]['owner'] . ' u')
                ->innerJoin('t.estado e')
                ->where('u.id = ' . $this->id)
                ->andWhere('e.contenido <> "borrada"')
                //->andWhere($aceptados)
                ->andWhere('e.contenido like ?', array($this->mapPaginado[$atributo]['estado']))
                ->groupBy('u.id');
        $total = $q->execute();
        return ($total->count()) ? $total[0]->total : 0;
    }

    //FIN FUNCIONES PARA LOS PAGINADORES
}
?>