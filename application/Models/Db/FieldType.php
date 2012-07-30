<?php

class Models_Db_FieldType extends Zend_Db_Table_Abstract
{
    protected $_name = 'field_type';
    protected $_primary = 'id';
    protected $_cols = array(
    'id',
    'name',
    'type',
    'length',
    'default',
    );

    public function getList()
    {
        $result = $this->fetchAll($this->select()
            ->from($this->_name, array(
                'id'=>'id',
                'name'=>'name',
                'type'=>'type',
                'length'=>'length',
                'default'=>'default',
                )));
        return $result;
    }

    public static function getTableName()
    {
        $table = new Models_Db_FieldType();
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