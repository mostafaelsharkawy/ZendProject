<?php

class Application_Model_DbTable_Material extends Zend_Db_Table_Abstract
{

    protected $_name = 'materials';

    function getAllMaterials()
    {
    	return $this->fetchAll()->toArray();
    }

    function getMaterials($course_id){
		return $this->fetchAll($this->select()->where('course_id=?',$course_id));
	}

	function editMaterial($id,$materialInfo){
		$this->update($materialInfo, "id=$id");
	}
	
	function deleteMaterial($id){
		return $this->delete('id='.$id);
	}
	function addMaterial($materialInfo){
		$row = $this->createRow();
		$row->title = $materialInfo['title'];
		$row->user_id = $materialInfo['user_id'];
		$row->material_type_id = $materialInfo['material_type_id'];
		$row->course_id = $materialInfo["course_id"];
		$row->is_approved = $materialInfo['is_approved'];
		$row->is_published = $materialInfo['is_published'];
		$row->is_shown = $materialInfo["is_shown"];
		return $row->save();
	}



}

