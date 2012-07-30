<?php

class Models_Db_Pages extends Zend_Db_Table_Abstract
{
    protected $_name = 'pages';
    protected $_primary = 'id';
    protected $_cols = array(
    'id',
    'name',
    'text',
    );

    public function findById($id)
    {
        $result = $this->fetchRow($this->select()
                ->from($this->_name, array(
                'name'=>'name',
                'text'=>'text',
                ))
                ->where('`id` = ?', $id)
        );
        return $result->toArray();
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


    public function getItem($id)
    {
        $result = $this->fetchRow($this->select()
            ->from($this->_name,array(
                'id'=> 'id',
                'name'=>'name',
                'text'=>'text',
            ))
            ->where('`id`=?',$id)

        );
        if ($result) {
            return $result->toArray();
        } else {
            return false;
        }
    }

    public function updateItem($updateArray)
    {
        if (isset($updateArray['url']) && ($updateArray['url']!=''))
        {
            $modelCleanUrl =  new Models_Db_CleanUrls();
            $modelCleanUrl->updateItemByValue($updateArray['id'],$updateArray['url']);
        }

        $where = $this->getAdapter()->quoteInto('id = ?', $updateArray['id']);
        $data = array(
            'name'=>$updateArray['name'],
            'text'=>$updateArray['text'],
        );
        $this->update($data, $where);
        return true;
    }

    public function insertItem($insertArray)
    {
        $data = array(
            'name'=>$insertArray['name'],
            'text'=>$insertArray['text'],
        );
        //todo осторожно использование другой модели, может стоит в контроллер вынести
        $id = $this->insert($data);
        if (is_numeric($id))
        {
            $modelCleanUrl = new Models_Db_CleanUrls();
            $cleanUrlArray = array(
                'module'=>'default',
                'controller'=>'pages',
                'action'=>'view',
                'value'=>$id,
                'url'=>$insertArray['url']
            );
            return $modelCleanUrl->insertItem($cleanUrlArray);
        }
        return false;

    }

    public function deleteItem($id)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($where);
        $modelCleanUrl = new Models_Db_CleanUrls();
        $modelCleanUrl->deleteItemByValue($id);
    }
}