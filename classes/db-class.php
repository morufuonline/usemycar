<?php  
   
    class DB {  
      
        protected $db_name = "usemycar";  
        protected $db_user = "root";  
        protected $db_pass = "";  
        protected $db_host = "localhost";  
        public $connection = '';
         
        public function connect() {  
            $this->connection = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);  
            mysqli_select_db($this->connection, $this->db_name);  
      
            return true;  
        }
        
        public function disconnect() {  
            mysqli_close($this->connection);
        }  
      
      public function query($query="") {
            $result = null;
            if(trim($query) != ''){            
                $result = mysqli_query($this->connection, $query);            
                if(!$result){
                   $result = null;
                }
            }            
            return $result;            
        }
        
         
        public function select($table, $where, $columns ='*', $order='', $limit='') {
            
            $sql = "SELECT $columns FROM $table $where $order $limit";
            
            $result = mysqli_query($this->connection, $sql);
            
            if($result){
                return $result;
            }else{
                return null;
            }
        }
        
        public function select_count($table, $where, $as='count') {
            
            $sql = "SELECT count(*) as $as FROM $table $where";
            
            $result = mysqli_query($this->connection, $sql);
            
            if($result){
                return $result;
            }else{
                return null;
            }
        }
        
        
        public function select_single($table, $where, $columns='*', $order='') {
           
            $fetch_columns = "";
            $sql = "";
            
            if($columns == '*'){
                $sql = "SELECT * FROM $table $where $order";
            }else{
                foreach ($columns as $column) {  
                   $fetch_columns .= ($columns == "") ? "" : ", ";  
                   $fetch_columns .= $column;    
                }
            
                $sql = "SELECT $fetch_columns FROM $table $where $order"; 
            }
            
            $result = mysqli_query($this->connection, $sql);
            
            if($result){
                return $result;
            }else{
                return null;
            }
        }  
      
          
        public function update($data, $table, $where) {
            $sqlString = "UPDATE $table SET ";
            foreach ($data as $key => $value) {  
                $sqlString .= "$key = '$value',";  
            }
            
            $sqlString = substr($sqlString, 0, -1);
            $sqlString .= " WHERE $where";
          
            if(mysqli_query($this->connection, $sqlString)){
                return true;  
            }else{
                return false;
            }
            
        }  
      
        
        public function insert($data, $table) {  
      
            $columns = "";  
            $values = "";  
      
            foreach ($data as $column => $value) {  
                $columns .= ($columns == "") ? "" : ", ";  
                $columns .= $column;  
                $values .= ($values == "") ? "" : ", ";  
                $values .= $value;  
            }  
      
            $sql = "insert into $table ($columns) values ($values)";  
            
            mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));  
      
            return mysqli_insert_id($this->connection);  
        }  
		
        public function insert2($data, $table) {  
      
            $columns = "";  
            $values = "";  
      
            foreach ($data as $column => $value) {  
				$columns .= ($columns == "") ? "" : ", ";  
                $columns .= $column;  
                $values .= ($values == "") ? "" : ", ";  
                $values .= "'".$value."'"; 
            } 
      
            $sql = "insert into $table ($columns) values ($values)";  
            
            mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));  
      
            return mysqli_insert_id($this->connection);  
        } 
      
      
        public function delete($table, $where) {       
            
            $sql = "DELETE FROM $table WHERE $where";  
             
           if(mysqli_query($this->connection, $sql)){            
                return true;        
           }else{
                die(mysqli_error($this->connection));  
           }
        }
        
    }     
	
?>