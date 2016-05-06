<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract
{

    protected $_name = 'comments';
	

	function listComments(){
		return $this->fetchAll()->toArray();
	}
	
	
	function getCommentById($id_comt){
		return $this->find($id_comt)->toArray();
	}

	function updateComment($comtInfo,$id_comt){
		return $this->update($comtInfo,'id_comt='.$id_comt);


	}

	
	function deleteComment($id_comt){
		return $this->delete('id_comt='.$id_comt);
	}


	function addComment($comtInfo){
		$row = $this->createRow();
		$row->contain_comt = $comtInfo['contain_comt'];
		$row->id_user = $comtInfo['id_user'];
		$row->id_cours = $comtInfo['id_cours'];
		return $row->save();
	}


}

