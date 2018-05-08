<?php

/**
 * Implement your code here
 * Feel free to remove the echos :)
 */

class myTreeView extends abstractTreeView {
	
    public function showCompleteTree()
    {
        $data = [];

        $lang = 'eng';

        if(empty($_GET['lang'])) {
            $lang == 'eng';
        } else {
            $lang = $_GET['lang'];
        }

        $sql = "SELECT * FROM tree_entry";
        $res = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
        
        while( $row = mysqli_fetch_assoc($res) ) { 
            $tmp = array();
            $tmp['id'] = $row['entry_id'];
            $tmp['parent_id'] = $row['parent_entry_id'];
            array_push($data, $tmp); 
        }
        $itemsByReference = array();
        
        foreach($data as $key => &$item){
            $itemsByReference[$item['id']] = &$item;
        }

        // Set items as children of the relevant parent item.
        foreach($data as $key => &$item)  {
        //echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                $itemsByReference[$item['parent_id']]['nodes'][] = &$item;
            }
        }

        foreach($data as $key => &$item)  {
        //echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                unset($data[$key]);
            }
        }

//       return include("views/tree.php");
    }
    
    public function getTranslate(int $entry_id, string $lang)
    {
        $sql = "SELECT * FROM tree_entry_lang WHERE entry_id = '$entry_id' AND lang = '$lang'";
        $res = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
        
        $row = mysqli_fetch_assoc($res);

        return $row['name'];
    }
    
    public function showAjaxTree(string $lang)
    {
        $data = [];

        $lang = 'eng';

        if(empty($_GET['lang'])) {
            $lang == 'eng';
        } else {
            $lang = $_GET['lang'];
        }

        $sql = "SELECT tree_entry.entry_id as entry_id, tree_entry.parent_entry_id as parent_id, tree_entry_lang.name as text FROM tree_entry LEFT JOIN tree_entry_lang on tree_entry.entry_id = tree_entry_lang.entry_id and tree_entry_lang.lang = '$lang' GROUP BY entry_id";
        $res = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
        
        while( $row = mysqli_fetch_assoc($res) ) {
            $tmp = array();
            $tmp['id'] = $row['entry_id'];
            $tmp['parent_id'] = $row['parent_id'];
            $tmp['text'] = $row['text'];
            array_push($data, $tmp); 
        }
        
        $itemsByReference = array();
        
        foreach($data as $key => &$item) {
            $itemsByReference[$item['id']] = &$item;
        }

        // Set items as children of the relevant parent item.
        foreach($data as $key => &$item) {
        //echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                $itemsByReference[$item['parent_id']]['nodes'][] = &$item;
            }
        }

        foreach($data as $key => &$item) {
        //echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                unset($data[$key]);
            }
        }

        return json_encode($data);
    }

    public function createTreeView($data, $currentParent, $currLevel = 0, $prevLevel = -1)
    {
        if ($data === 0 ) {
            $data = [];
        }

        $sql = "SELECT tree_entry.entry_id as entry_id, tree_entry.parent_entry_id as parent_id, tree_entry_lang.name as text FROM tree_entry LEFT JOIN tree_entry_lang on tree_entry.entry_id = tree_entry_lang.entry_id";
        $res = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
        
        while( $row = mysqli_fetch_assoc($res) ) {
            $tmp = array();
            $tmp['id'] = $row['entry_id'];
            $tmp['parent_id'] = $row['parent_id'];
            $tmp['text'] = $row['text'];
            array_push($data, $tmp); 
        }

        foreach ($data as $key => &$item) {

            if ($currentParent == $item['parent_id']) {
                if ($currLevel > $prevLevel) echo " <ol class='tree'> "; 
                if ($currLevel == $prevLevel) echo " </li> ";

                echo '<li> <label>'.$item['text'].'</label>';
                
                if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
                $currLevel++;

                $this->createTreeView($data, $key, $currLevel, $prevLevel);
                $currLevel--;
            }  

        }

        if ($currLevel == $prevLevel) echo " </li>  </ol> ";

    }
    
    public function fetchAjaxTreeNode($entry_id) {
        echo 'fetchAjaxTreeNode for entry_id ('.$entry_id.')<br>';
    }
}