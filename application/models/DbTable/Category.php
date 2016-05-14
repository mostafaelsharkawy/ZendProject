<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'courses';
    function getCategories(){
		return $this->fetchAll($this->select()->where('parent_id IS NULL'));
	}


	function getCategoryByID($id) {
        return $this->find($id)->toArray();
    }

	function editCategories($id,$categoryInfo){
		$this->update($categoryInfo, "id=$id");
	}
	
	function deleteCategory($id){
		return $this->delete('id='.$id);
	}
	function addCategory($categoryInfo){
		$row = $this->createRow();
		$row->title = $categoryInfo['title'];
		$row->user_id = $categoryInfo['user_id'];
		$row->parent_id = "NULL";
		return $row->save();
	}


}

