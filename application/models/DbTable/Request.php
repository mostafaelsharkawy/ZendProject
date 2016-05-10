<?php

class Application_Model_DbTable_Request extends Zend_Db_Table_Abstract
{
    protected $_name = 'requests';
    
    #is_hide =0 this request is not hidden
    function listRequests(){
        $select=$this->select('*')
                ->setIntegrityCheck(false)
                ->where('requests.is_hide=0')
                ->join('courses','courses.id = requests.course_id',array('courses_title'=>'title'))
                ->join('users','users.id = requests.user_id',array('username','user_id'=>'id'));
        return $this->fetchAll($select)->toArray();
    }
    function listHideRequests(){
        $select=$this->select('*')
                ->setIntegrityCheck(false)
                ->where('requests.is_hide=1')
                ->join('courses','courses.id = requests.course_id',array('courses_title'=>'title'))
                ->join('users','users.id = requests.user_id',array('username','user_id'=>'id'));
        return $this->fetchAll($select)->toArray();
    }

    function editRequest($id,$requestInfo){
        $this->update($requestInfo, "id=$id");
    }

    function deleteRequest($id){
        return $this->delete('id='.$id);
    }
    function addRequest($requestInfo,$user_id){
        $row = $this->createRow();
        $row->title = $requestInfo['title'];
        $row->content = $requestInfo['content'];
        $row->user_id = $user_id;
        $row->is_hide=0;
        $row->course_id = $requestInfo['course_id'];
        return $row->save();
    }
    function hideRequest($id,$hide)
    {
        $data = array("is_hide" => $hide );
        $this->update($data,'id='.$id);
    }
}

