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
            
            // Build array of item references:
            foreach($data as $key => &$item) {
                $itemsByReference[$item['id']] = &$item;
                // Children array:
                $itemsByReference[$item['id']]['nodes'] = array();
            }
            
            // Set items as children of the relevant parent item.
            foreach($data as $key => &$item)  {
            //echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
                if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                    $itemsByReference [$item['parent_id']]['nodes'][] = &$item;
                }
            }

            return include("views/tree.php");
        }
        
        public function getTranslate(int $entry_id, string $lang)
        {
            $sql = "SELECT * FROM tree_entry_lang WHERE entry_id = '$entry_id' AND lang = '$lang'";
            $res = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
           
            $row = mysqli_fetch_assoc($res);

            return $row['name'];
        }
		
        public function showAjaxTree()
        {
			$data = [];

            $sql = "SELECT * FROM tree_entry";
            $res = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
           
            while( $row = mysqli_fetch_assoc($res) ) { 
                $tmp = array();
                $tmp['id'] = $row['entry_id'];
                $tmp['parent_id'] = $row['parent_entry_id'];
                array_push($data, $tmp); 
            }
            $itemsByReference = array();
            
            // Build array of item references:
            foreach($data as $key => &$item) {
                $itemsByReference[$item['id']] = &$item;
                // Children array:
                $itemsByReference[$item['id']]['nodes'] = array();
            }

            // Set items as children of the relevant parent item.
            foreach($data as $key => &$item)  {
            //echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
                if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                    $itemsByReference[$item['parent_id']]['nodes'][] = &$item;
                }
            }
            return json_encode($data);
        }
		
		public function fetchAjaxTreeNode($entry_id) {
			echo 'fetchAjaxTreeNode for entry_id ('.$entry_id.')<br>';
		}
}