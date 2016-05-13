<?php

class Application_Model_DbTable_MaterialType extends Zend_Db_Table_Abstract {

    protected $_name = 'material_types';

    function listMaterialTypes() {
        return $this->fetchAll()->toArray();
    }

    function getAllMaterialtypes() {
        return $this->fetchAll()->toArray();
    }

    function getMaterialTypeById($id) {
        return $this->find($id)->toArray();
    }

    function editMaterialType($id, $materialtypeInfo) {
        $this->update($materialtypeInfo, 'id=' . $id);
    }

    function deleteMaterialType($id) {
        return $this->delete('id=' . $id);
    }

    function addMaterialType($materialTypeInfo) {
        $row = $this->createRow();
        $row->type = $materialTypeInfo['type'];
        $row->user_id = 1;

        return $row->save();
    }

}
