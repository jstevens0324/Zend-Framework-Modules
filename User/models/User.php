<?php

class User_Model_User extends Zend_Db_Table
{
    protected $_name = 'users';
    protected $_primary = 'id';

    public function updatePassword($userId, $password)
    {
        $where = array(
            $this->getAdapter()->quoteInto('id = ?', $userId),
        );
        return $this->update(array('password' => md5($password)), $where);
    }

    public function getUserList()
    {
        $select = $this->select()
                    ->from($this->_name, array('username'))
                    ->where('role = ?', 'developer')
                    ->order('username ASC');
        $rowset = $this->fetchAll($select);
        $userList = array();

        foreach($rowset as $row) {
            $userList[$row->username] = $row->username;
        }
        return $userList;
    }
}

