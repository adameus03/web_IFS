<?php
    class SQLHandler {
        public $conn;
        function __construct(){
            $this->conn=new mysqli("NIE POWIEM", "TEŻ NIE POWIEM", "TYM BARDZIEJ NIE POWIEM", "DOSYĆ");
        }
        function __destruct(){
            $this->conn->close();
        }
        function queryRowsGenerator($stmtBody, $param_types, $params){
            //echo "k";
            $stmt=$this->conn->prepare($stmtBody);
            //call_user_func_array([$stmt, 'bind_param'], array_merge([$param_types], $params)); TROUBLE
            //var_dump([ 'param_types'=>$param_types, 'params'=>$params ]);
            //throw new Exception('AAAAA');
            if(count($params)>0){
                $stmt->bind_param($param_types, ...$params);
            }
            $stmt->execute();
            $res=$stmt->get_result();
            while($row=$res->fetch_assoc()){
                yield $row;
            }
        }
        function queryRowsArray($stmtBody, $param_types, $params){
            $stmt=$this->conn->prepare($stmtBody);
            $stmt->bind_param($param_types, ...$params);
            $stmt->execute();
            $res=$stmt->get_result();
            $rows=[];
            while($row=$res->fetch_assoc()){
                $rows[]=$row;
            }
            return $rows;
        }
        function queryRow($stmtBody, $param_types, $params){
            $rows=$this->queryRowsGenerator($stmtBody, $param_types, $params);
            if(!$rows->valid()) return false;
            return $rows->current();
        }
        function execute($stmtBody, $param_types, $params){
            $stmt=$this->conn->prepare($stmtBody);
            $stmt->bind_param($param_types, ...$params);
            $stmt->execute();
        }
    }
?>
