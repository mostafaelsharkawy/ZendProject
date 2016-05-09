<?php

class Application_Model_DbTable_MaterialType extends Zend_Db_Table_Abstract
{

    protected $_name = 'material_types';
    
    function getAllMaterialtypes()
    {
    	return $this->fetchAll()->toArray();
    }


}

