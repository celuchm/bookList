<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Db
 *
 * @author mc
 */
class Db {
    
    private static $_instance = null;
    private  $_pdo,
             $_query,
             $_result = array(),
             $_count;
             


    private function __construct() {
       
            $this->_pdo = new PDO('mysql:host=127.0.0.1;dbname=toDo', 'root', 'test');
            
    }
    
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new Db();
        } 
        return self::$_instance;        
    }
      
    public function doDbAction($type, $table, $sqlConditions, $updateArray = null){
               
        $sql = $this->prepareSql($type, $table, $sqlConditions, $updateArray);     
        $preparedQuery = $this->prepareQuery($sql, array_values($sqlConditions));
        $this->executePreparedQuery($preparedQuery);
        return $this;
        
    }
    
    private function prepareSql($type, $table, $sqlConditions, $updateArray){
        
        $sql = "";
        $sqlConditionColumns = array_keys($sqlConditions);
        $sqlConditionValues = array_values($sqlConditions);    
        
        switch($type){
            case 'insert':
                $sql = $this->getInsertSql($table, $sqlConditionColumns, $sqlConditionValues);                   
            break;
            
            case 'select':                
                $sql = $this->getSelectSql($table, $sqlConditionColumns, $sqlConditionValues);                
            break;
        
            case 'update':
                $sql = $this->getUpdateSql($table, $sqlConditionColumns, $sqlConditionValues, $updateArray);
            break;
        }
        return $sql;        
    }
    
    private function getInsertSql($table, $sqlConditionColumns, $sqlConditionValues){
        $x = 1;      
            foreach($sqlConditionValues as $singleInsertValue){
                $questionMarkString .= '?';
                if($x < count($sqlConditionValues)) $questionMarkString .= ',';
                $x++;
            }
            return "insert into {$table} (".implode(',', $sqlConditionColumns).") values ( {$questionMarkString} )";       
    }
    
    private function getSelectSql($table, $sqlConditionColumns, $sqlConditionValues){
        $countWhereConditions = count($sqlConditionColumns);
        $sqlConditionString = "";
            for($i=0;$i<$countWhereConditions;$i++){
              $sqlConditionString .= $sqlConditionColumns[$i]." = ? ";
              if($i<$countWhereConditions-1) {
                  $sqlConditionString .= "and ";
              }
            }
            return "select * from {$table} where {$sqlConditionString}";  
    }
    
    private function getUpdateSql($table, $sqlConditionColumns, $sqlConditionValues, $updateArray = array()){
        
        $columnsToUpdate = array_keys($updateArray);
        $valuesToUpdate  = array_values($updateArray);
        
        $countColumnsToUpdate = count($columnsToUpdate);
        $sqlColumnsUpdateString = "";
            for($i=0;$i<$countColumnsToUpdate;$i++){
              $sqlColumnsUpdateString .= $columnsToUpdate[$i]." = '".$valuesToUpdate[$i]."'";
              if($i<$countColumnsToUpdate-1) {
                  $sqlColumnsUpdateString .= " , ";
              }
            }
        
        $countWhereConditions = count($sqlConditionColumns);
        $sqlConditionString = "";
            for($i=0;$i<$countWhereConditions;$i++){
              $sqlConditionString .= $sqlConditionColumns[$i]." = ? ";
              if($i<$countWhereConditions-1) {
                  $sqlConditionString .= "and ";
              }
            }
            return "update {$table} set {$sqlColumnsUpdateString} where {$sqlConditionString}";  
                
        
    }
    
    private function prepareQuery($sql, $bindValues){        
        $prepare = $this->_pdo->prepare($sql);      
          
        $i=1;
          foreach($bindValues as $value){
              $prepare->bindValue($i, $value);
              $i++;
          }                
          return $prepare;
    }
    
    private function executePreparedQuery($preparedQuery){
        $preparedQuery->execute();
        $this->_result = $preparedQuery->fetchAll(PDO::FETCH_ASSOC);
        $this->_count = $preparedQuery->rowCount();   
        return $preparedQuery;
    }
    
    public function select($sql){
        $this->_query = $sql;
        foreach($this->_pdo->query($this->_query) as $row){
            $this->_result[] = $row;
        }
        $this->_count = count($this->_result);
        return $this;
              
    }
    
    
    
    function get_query() {
        return $this->_query;
    }

    function get_result() {
        return $this->_result;
    }

    function get_count() {
        return $this->_count;
    }
    
    function get_first_row(){
        return $this->_result[0];
    }
    
    
    


    
}
