<?php

class RelUsuarioInteresesSubcategoria extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('rel_usuario_intereses_subcategoria');
        $this->hasColumn('id_usuario_intereses', 'integer', 4, array(
            'primary' => true, 'unsigned' => true,
        ));

        $this->hasColumn('id_subcategoria', 'integer', null, array(
            'primary' => true
        ));
    }
    

}
?>