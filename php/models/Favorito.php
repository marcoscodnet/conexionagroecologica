<?php
class Favorito extends Doctrine_Record {
    public function setTableDefinition() {
        $this->hasColumn('user_id', 'integer', null, array(
			'primary' => true
        ));

        $this->hasColumn('favorito_id', 'integer', null, array(
			'primary' => true
        ));
    }
}
?>