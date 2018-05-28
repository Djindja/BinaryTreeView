<?php

/**
 * Implement your code here
 * Feel free to remove the echos :)
 */

class myTreeView extends abstractTreeView {

    public function showCompleteTree($data, $currentParent)
    {
        if ($data === 0 ) {
            $data = [];
        }

        $sql = "SELECT tree_entry.entry_id as entry_id, tree_entry.parent_entry_id as parent_id, tree_entry_lang.name as text FROM tree_entry LEFT JOIN tree_entry_lang on tree_entry.entry_id = tree_entry_lang.entry_id GROUP BY tree_entry.entry_id";
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

        foreach($data as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                $itemsByReference[$item['parent_id']]['nodes'][] = &$item;
            }
        }

        foreach($data as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                unset($data[$key]);
            }
        }

        $this->draw($data, 0);

    }

    private function draw($data, $currentParent)
    {
        
        foreach ($data as $key => &$item) {
            echo '<ol>';
            echo '<li>' . $item['text'] . '</li>';

            if (isset($item['nodes'])) {
                $currentParent = $item['id'];
                $this->draw($item['nodes'], $currentParent);
            }

            echo "</ol>";
        }
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

        $lang = 'ger';

        $sql = "SELECT tree_entry.entry_id as entry_id, tree_entry.parent_entry_id as parent_id, tree_entry_lang.name as text FROM tree_entry LEFT JOIN tree_entry_lang on tree_entry.entry_id = tree_entry_lang.entry_id and tree_entry_lang.lang = '$lang' GROUP BY entry_id";
        $res = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
        
        while( $row = mysqli_fetch_assoc($res) ) {
            $tmp = array();
            $tmp['id'] = $row['entry_id'];
            $tmp['parent_id'] = $row['parent_id'];
            $tmp['text'] = $row['text'];

            if($tmp['text'] === null) {
               $tmp['text'] = $this->getTranslate($tmp['id'], "eng"); 
            }
            array_push($data, $tmp); 
        }
        
        $itemsByReference = array();
        
        foreach($data as $key => &$item) {
            $itemsByReference[$item['id']] = &$item;
        }

        foreach($data as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                $itemsByReference[$item['parent_id']]['nodes'][] = &$item;
            }
        }

        foreach($data as $key => &$item) {
            if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                unset($data[$key]);
            }
        }

        return json_encode($data);
    }
    
    public function fetchAjaxTreeNode($entry_id) {
        echo 'fetchAjaxTreeNode for entry_id ('.$entry_id.')<br>';
    }
}