<?php

class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{

    protected $_name = 'comments';
	function listComments(){
		return $this->fetchAll()->toArray();
	}
	function getCommentsByMaterialId($id){
		return $this->fetchAll($this->select()->where('material_id=?',$id));
	}

	function editComment($id,$commentInfo){
		$this->update($commentInfo, "id=$id");
	}
	
	function deleteComment($id){
		return $this->delete('id='.$id);
	}
	function addComment($commentInfo){
		$row = $this->createRow();
		$row->content = $commentInfo['content'];
		$row->user_id = 1;//$commentInfo['user_id'];
		$row->material_id = 3;//$commentInfo['material_id'];
		return $row->save();
	}



}

