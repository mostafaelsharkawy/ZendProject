<?php

class Application_Model_DbTable_MaterialContent extends Zend_Db_Table_Abstract {

    protected $_name = 'material_contents';

    function listMaterialContent() {
        return $this->fetchAll()->toArray();
    }

    function getMaterialContentById($id,$mtype) {
        return $this->fetchAll($this->select()->where('material_id=?', $id)->where('material_type_id=?',$mtype));
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
    function addMaterialContent($materialContentInfo, $id,$mtype) {
        $row = $this->createRow();
//        print_r(addMaterialContent);
        var_dump($materialContentInfo);
//        echo $materialContentInfo['mtype'];
//        var_dump($row)
        $row->content_path = $materialContentInfo['file'];
        $row->material_id = $id;
        $row->material_type_id=$mtype;
        $row->is_locked='0';
        $row->is_show='0';

        return $row->save();
    }

}
