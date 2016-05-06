<?php

class Application_Model_DbTable_Subcategories extends Zend_Db_Table_Abstract
{

    protected $_name = 'subcategories';
	

	function listSubcategories(){
		return $this->fetchAll()->toArray();
	}
	
	
	function getSubcategoryById($id_sub){
		return $this->find($id_sub)->toArray();
	}

	function updateSubcategory($subInfo,$id_sub){
		return $this->update($subInfo,'id_sub='.$id_sub);


	}

	
	function deleteSubcategory($id_sub){
		return $this->delete('id_sub='.$id_sub);
	}


	function addSubcategory($subInfo){
		$row = $this->createRow();
		$row->sub_category = $subInfo['sub_category'];
		$row->id_cato = $subInfo['id_cato'];
		return $row->save();
	}


}

