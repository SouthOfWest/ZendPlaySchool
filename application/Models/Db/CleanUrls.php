<?php

class Models_Db_CleanUrls extends Zend_Db_Table_Abstract
{
    protected $_name = 'clean_url';
    protected $_primary = 'id';
    protected $_cols = array(
    'id',
    'module',
    'controller',
    'action',
    'value',
    'url'
    );

    public function getList()
    {
        $result = $this->fetchAll($this->select()
            ->from($this->_name, array(
                'id'=>'id',
                'module'=>'module',
                'controller'=>'controller',
                'action'=>'action',
                'value'=>'value',
                'url'=>'url',
                )));
        return $result;
    }

    public static function getTableName()
    {
        $table = new Models_Db_CleanUrls();
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

    public function getUrlByValue($value)
    {
        $result = $this->fetchRow($this->select()
            ->from($this->_name, array(
                'url'=>'url',
            ))
            ->where('`value`=?',$value)
        );
        return $result['url'];
    }

}