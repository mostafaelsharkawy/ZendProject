<?php

class Application_Model_DbTable_MaterialContent extends Zend_Db_Table_Abstract {

    protected $_name = 'material_contents';

    function listMaterialContent() {
        return $this->fetchAll()->toArray();
    }

    function getMaterialContentById($id) {
        return $this->fetchAll($this->select()->where('material_id=?', $id));
    }

    function getMaterialbyindex($id) {
        return $this->find($id)->toArray();
    }

    function editMaterialContent($materialcontentInfo, $id) {
        $data = array(
            'content_path' => $materialcontentInfo['file'],
        );
        $this->update($data, 'id=' . $id);
    }

    function lockContent($id) {
        $data = array(
            'is_locked' => '1',
         
        );

        $this->update($data, 'id=' . $id);
    }
    function unlockContent($id) {
        $data = array(
            'is_locked' => '0',
         
        );

        $this->update($data, 'id=' . $id);
    }
    
    function hideContent($id) {
        $data = array(
            'is_show' => '0',
         
        );

        $this->update($data, 'id=' . $id);
    }

    function showContent($id) {
        //die($id);
        $data = array(
            'is_show' => '1',
         
        );

        $this->update($data, 'id=' . $id);
    }

    function deleteMaterialContent($id) {
        return $this->delete('id=' . $id);
    }

    //There will be modifications
    function addMaterialContent($materialContentInfo, $id) {
        $row = $this->createRow();
//        print_r(addMaterialContent);
        $row->content_path = $materialContentInfo['file'];
        $row->material_id = $id;

        return $row->save();
    }

}
