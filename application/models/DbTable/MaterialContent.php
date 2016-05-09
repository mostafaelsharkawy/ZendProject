<?php

class Application_Model_DbTable_MaterialContent extends Zend_Db_Table_Abstract
{

    protected $_name = 'material_contents';
     function listMaterialContent(){
                    return $this->fetchAll()->toArray();
            }

            function getMaterialContentById($id){
                    return $this->find($id)->toArray();
            }
            function editMaterialContent($id,$materialtypeInfo){
                    $this->update($materialtypeInfo, 'id='.$id);
            }

            function deleteMaterialContent($id){
                    return $this->delete('id='.$id);
            }
               //There will be modifications
            function addMaterialContent($materialContentInfo){
                    $row = $this->createRow();
                    $row->type = $materialContentInfo['type'];
                    $row->user_id = 1;

            return $row->save();
            }
}

