<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';	
    
	function listUsers(){
            return $this->fetchAll()->toArray();
	}
        function makeAdmin($id,$admin){
            $data = array("is_Admin" => $admin );
            $this->update($data,'id='.$id);
        }
        function banUser($id,$ban){
            $data=array('is_Banned'=>$ban);
            $this->update($data, 'id='.$id);
        }
                
	function getUserById($id){
            return $this->find($id)->toArray();
	}
        
        
	function editUser($id,$userInfo){
            $this->update($userInfo, 'id='.$id);
	}

	function deleteUser($id){
		return $this->delete('id='.$id);
	}
	
	function addUser($userInfo){
            $row = $this->createRow();
            $row->username = $userInfo['username'];
            $row->password = md5($userInfo['password']);
            $row->email = $userInfo['email'];
            $row->gender = $userInfo['gender'];
            $row->country = $userInfo['country'];
            $row->signature = $userInfo['signature'];
            $row->is_Admin = '0';
            $row->is_Banned = '0';
            return $row->save();
	}
//        function isAdmin($id){
//            $select=$this->select("is_Admin")
//                    ->from('users')->where('id=', $id);
//            return $this->fetchAll($select)->toArray();
//	}
        

}

