<?php

class DB {

    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_result,
            $_options,
            $_dropQuery,
            $_columnName,
            $_ipNumber=null,
            $_count = 0,
            $_ugxAmount,
            $_track_order,
            $_columnCount = 0,
            $_columns = array(),
            $_columnTypes = array();

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $exc) {
            die($exc->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = false;
        if(is_string($params)){
            $starts_with = strtolower(substr(trim($params),0,5)); 
            if(!( $starts_with === "where")){
                $params = "WHERE ".$params;
            }
            $sql = $sql." ".$params;
            $params = array();
        }
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {
                // get records
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_columns = $this->columnNames();
                $this->_columnCount = $this->_query->columnCount();
                $this->_columnTypes = $this->columnTypes();
                $this->_count = $this->_query->rowCount();
            } else {
                print_r($this->_query->errorInfo());
                $this->_error = true;
            }
        }
        $sql="";
        return $this;
    }

    public function action($action, $table, $where = array()) {
        if (count($where) == 3) {
            $operators = array('=', '>', '<', '>=', '<=', 'LIKE');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    public function get($table, $where) {
        return $this->action("SELECT * ", $table, $where);
    }

    public function delete($table, $where) {
        return $this->action("DELETE ", $table, $where);
    }

    public function insert($table, $fields = array()) {
        if (count($fields)) {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
            foreach ($fields as $field) {
                $values.="?";
                if ($x < count($fields)) {
                    $values.=', ';
                }
                $x++;
            }
            // die($values);
            $sql = "INSERT INTO " . $table . " (`" . implode('`,`', $keys) . "` ) VALUES ({$values})";
            //echo $sql;
            if (!$this->query($sql, $fields)->error()) {
                return TRUE;
            }
        }
        return false;
    }

    public function update($table, $id, $fields,$updateWhere) {
        $set = '';
        $x = 1;
        foreach ($fields as $name => $value) {
            $set.="{$name}= ?";
            if ($x < count($fields)) {
                $set.=', ';
            }
            $x++;
        }
        //die($set);
        $sql = "UPDATE {$table} SET {$set} WHERE {$updateWhere}='$id'";
//        echo $sql;
        if(!$this->query($sql,$fields)->error()){
            return TRUE;
        }
    }

    public function results() {
        return $this->_result;
    }

    public function first() {
        return $this->results()[0];
    }

    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }
    
    private function columnNames(){
        $columns = array();
        $count = $this->_query->columnCount();
        for($i = 0; $i < $count; $i++){  
            $columns[] = $this->_query->getColumnMeta($i)['name'];
            
        }
        return $columns;
        //return array_values($this->_query->fetchAll(PDO::FETCH_ASSOC));
    }
    
    private function columnTypes(){
        $columns = array();
        $count = $this->_query->columnCount();
        for($i = 0; $i < $count; $i++){
            $columns[] = $this->_query->getColumnMeta($i)['pdo_type'];
        }
        return $columns;
        //return array_values($this->_query->fetchAll(PDO::FETCH_ASSOC));
    }
    
    public function columns() {
        return $this->_columns;
    }
    
    public function columnCount() {
        return $this->_columnCount;
    }
    
    /*  
        Populates a set of option elements within a select. 
        $tablename = table to query
        $id = column to use for the value attribute
        $name = column to use for the option
    */
    public function dropDowns($tableName,$id,$name){
        $this->_options="";
        $this->_dropQuery="";
        $this->_dropQuery= $this->query("SELECT * FROM $tableName ORDER BY $name ASC");
        $this->_options.="<option value=''>----SELECT----</option>";
        if($this->_dropQuery->count()){
            foreach ($this->_dropQuery->results() as $result){
                $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
            }
        }
        return $this->_options;
    }
    
    /*  
        Populates a set of option elements within a select and specifies
        which option to set as selected
        $tablename = table to query
        $id = column to use for the value attribute
        $name = column to use for the option
        $selected = option to set with selected attribute equal to 'selected'
    */
    public function dropDownsSelected($tableName,$id,$name,$selected){
        $this->_options="";
        $this->_dropQuery="";
        $this->_dropQuery= $this->query("SELECT * FROM $tableName ORDER BY $name ASC");
        $this->_options.="<option value=''>----SELECT----</option>";
        if($this->_dropQuery->count()){
            foreach ($this->_dropQuery->results() as $result){
            if((isset($selected) && !(empty($selected))) && $result->{$id} == $selected){
                $this->_options.="<option value='".$result->{$id}."' selected='selected'>".$result->{$name}."</option>";
            } else {
                $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
            }
          }
        }
        return $this->_options;
    }

    /*  
        Populates a set of option elements within a select where the query includes a WHERE
        clause
        $tablename = table to query
        $id = column to use for the value attribute
        $name = column to use for the option
        $where = array as ['column', 'operator', 'value']
    */
    public function dropDownWithWhere($tableName,$id,$name, $where){
        $this->_options="";
        $this->_dropQuery="";
        $this->_dropQuery= $this->query("SELECT * FROM $tableName ORDER BY $name ASC", $where);
        $this->_options.="<option value=''>----SELECT----</option>";
        if($this->_dropQuery->count()){
            foreach ($this->_dropQuery->results() as $result){
                $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
            }
        }
        return $this->_options;
    }
    
    /*  
        Populates a set of option elements within a select where the query includes a WHERE
        clause and specifies which option to set as selected='selected'
        $tablename = table to query
        $id = column to use for the value attribute
        $name = column to use for the option
        $where = array as ['column', 'operator', 'value']
        $selected = option to set with selected attribute equal to 'selected'
    */
    public function dropDownWithWhereAndSelected($tableName,$id,$name, $where, $selected){
        $this->_options="";
        $this->_dropQuery="";
        $this->_dropQuery= $this->query("SELECT * FROM $tableName ORDER BY $name ASC", $where);
        $this->_options.="<option value=''>----SELECT----</option>";
        if($this->_dropQuery->count()){
            foreach ($this->_dropQuery->results() as $result){
              if((isset($selected) && !(empty($selected)))){
                // array or value
                if(is_array($selected)){
                    if(in_array($result->{$id}, $selected)){
                        $this->_options.="<option value='".$result->{$id}."' selected='selected'>".$result->{$name}."</option>";
                    } else {
                        $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
                    }
                } else {
                    if($result->{$id} == $selected){
                        $this->_options.="<option value='".$result->{$id}."' selected='selected'>".$result->{$name}."</option>";
                    } else {
                        $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
                    }
                }
              } else {
                $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
              }
            }
        }
        return $this->_options;
    }

    /*
        Populates a set of option elements within a select where the query includes a WHERE
        clause
        $tablename = table to query
        $id = column to use for the value attribute
        $name = column to use for the option
        $where = array as ['column', 'operator', 'value']
    */
    public function dropDownWithWhereRaw($tableName,$id,$name, $where){
        $this->_options="";
        $this->_dropQuery="";
        $rawWhere = (is_array($where))? implode(",", $where): $where; 
        $this->_dropQuery= $this->query("SELECT * FROM $tableName WHERE $rawWhere ORDER BY $name ASC");
        $this->_options.="<option value=''>----SELECT----</option>";
        if($this->_dropQuery->count()){
            foreach ($this->_dropQuery->results() as $result){
                $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
            }
        }
        return $this->_options;
    }

    /*  
        Populates a set of option elements within a select where the query includes a WHERE
        clause and specifies which option to set as selected='selected'
        $tablename = table to query
        $id = column to use for the value attribute
        $name = column to use for the option
        $where = array as ['column', 'operator', 'value']
        $selected = option to set with selected attribute equal to 'selected'
    */
    public function dropDownWithWhereAndSelectedRaw($tableName,$id,$name, $where, $selected){
        $this->_options="";
        $this->_dropQuery="";
        $rawWhere = (is_array($where))? implode(",", $where): $where; 
        $this->_dropQuery= $this->query("SELECT * FROM $tableName WHERE $rawWhere ORDER BY $name ASC");
        $this->_options.="<option value=''>----SELECT----</option>";
        if($this->_dropQuery->count()){
            foreach ($this->_dropQuery->results() as $result){
              if((isset($selected) && !(empty($selected)))){
                // array or value
                if(is_array($selected)){
                    if(in_array($result->{$id}, $selected)){
                        $this->_options.="<option value='".$result->{$id}."' selected='selected'>".$result->{$name}."</option>";
                    } else {
                        $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
                    }
                } else {
                    if($result->{$id} == $selected){
                        $this->_options.="<option value='".$result->{$id}."' selected='selected'>".$result->{$name}."</option>";
                    } else {
                        $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
                    }
                }
              } else {
                $this->_options.="<option value='".$result->{$id}."'>".$result->{$name}."</option>";
              }
            }
        }
        return $this->_options;
    }
    //get field name
    public function getName($table,$id,$return,$idColumn)
    {
        $this->_query= $this->query("SELECT $idColumn,$return FROM $table where $idColumn='$id'");
        if($this->_query->count()){
            foreach ($this->_query->results() as $result){
            $this->_columnName=$result->{$return};
            }
        }else{
            $this->_columnName='NA';
        }
        return $this->_columnName;
    }
    
    //checking data already exists in the database
    public function checkRows($sql)
    {
        $this->_query=  $this->query($sql);
        if($this->count()>0)
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    //function for converting to uganda shillings
    public function convertToUGX($dollarValue)
    {
        $this->_query=  $this->query("SELECT  Currency_Name from jerm_currency");
        foreach ($this->_query->results() as $result){
            $this->_columnName=$result->Currency_Name;
            }
        $this->_ugxAmount=  (($this->_columnName)*($dollarValue));
        return $this->_ugxAmount;
    }
    
    //function for converting for tracking orders
    public function returnCount($sql_query)
    {
        $this->_columnName=0;
        $this->_query=  $this->query($sql_query);
        foreach ($this->_query->results() as $result){
            $this->_columnName++;
            }
        return $this->_columnName;
    }
    
   public function querySample($sql) {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {

            if ($this->_query->execute()) {
                // get meta data
                // Get records
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_columns = $this->columnNames();
                $this->_columnCount = $this->_query->columnCount();
                $this->_count = $this->_query->rowCount();
            } else {
                //print sql error
                print_r($this->_query->errorInfo());
                $this->_error = true;
            }
        }
//          returns array
        return $this->_result;
    }
    public function previous_id() {
        return $this->_pdo->lastInsertId();
    }
    
    
}

?>
