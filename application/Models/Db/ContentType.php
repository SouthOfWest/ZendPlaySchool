<?php

class Models_Db_ContentType extends Zend_Db_Table_Abstract
{
    protected $_name = 'content_type';
    protected $_primary = 'id';
    protected $_cols = array(
    'id',
    'title',
    'description',
    'machine_name',
    );

    public function getList()
    {
        $result = $this->fetchAll($this->select()
            ->from($this->_name, array(
                'id'=>'id',
                'title'=>'title',
                'description'=>'description',
                'machine_name'=>'machine_name',
                )));
        return $result;
    }

    public static function getTableName()
    {
        $table = new Models_Db_ContentType();
        return $table->_name;
    }

    public function saveItem($options)
    {
        if (isset($options['id']))
        {
            return $this->updateItem($options);
        }
        else
        {
            return $this->insertItem($options);
        }
    }

    public function updateItem($updateArray)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $updateArray['id']);
        unset($updateArray['id']);
        return $this->update($updateArray, $where);
    }

    public function insertItem($insertArray)
    {
        return $this->insert($insertArray);
    }

    public function deleteItem($id)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($where);
    }
}