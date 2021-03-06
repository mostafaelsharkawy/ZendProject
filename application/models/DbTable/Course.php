<?php

class Application_Model_DbTable_Course extends Zend_Db_Table_Abstract
{

    protected $_name = 'courses';
  

  	 function getCategories(){
		return $this->fetchAll($this->select()->where('parent_id IS NULL'));
	}

<<<<<<< HEAD
	function getOneCourse($id){
		return $this->find($id)->toArray();
		
	}
=======
>>>>>>> cb201f0fdfed9a4cbcbdd1336f293b0f705e3d1a

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
		$row->parent_id = NULL;
		return $row->save();
	}

	
	function getCourses(){
		return $this->fetchAll($this->select()->where('parent_id >?',"0"));
<<<<<<< HEAD
	}

	function getCatCourses($id){
		return $this->fetchAll($this->select()->where('parent_id =?',$id));
=======
>>>>>>> cb201f0fdfed9a4cbcbdd1336f293b0f705e3d1a
	}
	function getCourseByID($id) {
        return $this->find($id)->toArray();
    }

	function getCourseByID($id) {
        return $this->find($id)->toArray();
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

