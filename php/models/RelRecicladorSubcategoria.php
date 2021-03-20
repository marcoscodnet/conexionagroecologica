<?php

class RelRecicladorSubcategoria extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('rel_reciclador_subcategoria');
        $this->hasColumn('id_reciclador', 'integer', 4, array(
            'primary' => true, 'unsigned' => true,
        ));

        $this->hasColumn('id_subcategoria', 'integer', null, array(
            'primary' => true
        ));
    }

}
?>