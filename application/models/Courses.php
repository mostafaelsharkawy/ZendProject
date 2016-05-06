<?php

class Application_Model_DbTable_Courses extends Zend_Db_Table_Abstract
{

    protected $_name = 'courses';
	

	function listCourses(){
		return $this->fetchAll()->toArray();
	}
	
	
	function getCourseById($id_cours){
		return $this->find($id_cours)->toArray();
	}

	function updateCourse($coursInfo,$id_cours){
		return $this->update($coursInfo,'id_cours='.$id_cours);


	}

	
	function deleteCourse($id_cours){
		return $this->delete('id_cours='.$id_cours);
	}


	function addCourse($coursInfo){
		$row = $this->createRow();
		$row->cours_name = $coursInfo['cours_name'];
		$row->cours_pdf=$coursInfo['cours_pdf'];
		$row->cours_word=$coursInfo['cours_word'];
		$row->cours_ppt=$coursInfo['cours_ppt'];
		$row->cours_video=$coursInfo['cours_video'];
		$row->cours_image=$coursInfo['cours_image'];
		$row->state=$coursInfo['state'];
		$row->lock=$coursInfo['lock'];
		$row->no_user=$coursInfo['no_user'];
		$row->no_download=$coursInfo['no_download'];
		$row->id_user=$coursInfo['id_user'];
		$row->id_cato=$coursInfo['id_cato'];
		$row->id_sub=$coursInfo['id_sub'];

		return $row->save();
	}


}

