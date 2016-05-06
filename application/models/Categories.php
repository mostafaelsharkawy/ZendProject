<?php

class Application_Model_DbTable_Categories extends Zend_Db_Table_Abstract
{

    protected $_name = 'categories';
	

	function listCategories(){
		return $this->fetchAll()->toArray();
	}
	
	
	function getCategoryById($id_cato){
		return $this->find($id_cato)->toArray();
	}

	function updateCategory($catoInfo,$id_cato){
		return $this->update($catoInfo,'id_cato='.$id_cato);


	}

	
	function deleteCategory($id_cato){
		return $this->delete('id_cato='.$id_cato);
	}


	function addCategory($catoInfo){
		$row = $this->createRow();
		$row->category = $catoInfo['category'];

		return $row->save();
	}


}

