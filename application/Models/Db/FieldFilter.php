<?php

class Models_Db_FieldFilter extends Zend_Db_Table_Abstract
{
    protected $_name = 'field_filter';
    protected $_primary = 'id';
    protected $_cols = array(
    'id',
    'tid',
    'column',
    'filter',
    'type',
    );

    public function getList()
    {
        $result = $this->fetchAll($this->select()
            ->from($this->_name, array(
                'id'=>'id',
                'tid'=>'tid',
                'column'=>'column',
                'filter'=>'filter',
                )));
        return $result;
    }

    public static function getTableName()
    {
        $table = new Models_Db_FieldFilter();
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

    public function getFilterByTid($tid)
    {
        $result = $this->fetchAll($this->select()
            ->from($this->_name, array(
            'id'=>'id',
            'column'=>'column',
            'filter'=>'filter',
            'type'=>'type',
             ))
            ->where('`tid`=?',$tid)
        );
        return $result;
    }

}