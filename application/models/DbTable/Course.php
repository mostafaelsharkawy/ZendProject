<?php

class Application_Model_DbTable_Course extends Zend_Db_Table_Abstract
{

    protected $_name = 'courses';
    function getCategories(){
		return $this->fetchAll($this->select()->where('parent_id IS NULL'));
	}

	function getOneCourse($id){
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

	function getCourses(){
		return $this->fetchAll($this->select()->where('parent_id !=?',"NULL"));
	}

	function getCatCourses($id){
		return $this->fetchAll($this->select()->where('parent_id =?',$id));
	}

	function editCourses($id,$coursesInfo){
		$this->update($coursesInfo, "id=$id");
	}
	
	function deleteCourses($id){
		return $this->delete('id='.$id);
	}
	function addCourses($coursesInfo){
		$row = $this->createRow();
		$row->title = $coursesInfo['title'];
		$row->user_id = $coursesInfo['user_id'];
		$row->parent_id = $coursesInfo['parent_id'];
		return $row->save();
	}


}

