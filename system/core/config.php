<?php
class Database_Model{
    public $servername = "localhost";
        public $username = "root";
        public $password = "";
        public $databasename = 'dam';
        public $conn;
        
        public function Connect(){
            try{
                $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename.";charset=utf8",$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch(PDOException $e) {
                echo "<script>console.log('Kết Nối Database Thất Bại'" . $e->getMessage().")</script>";
            }
        }
        // Hàm truy vấn
        public function Query($sql){
            $conn = $this->Connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            $conn = null;
        }
        // Hàm thêm dữ liệu vào bảng chỉ định
        public function Insert_Value($table, $data) {
            $conn = $this->Connect();
            $sql = "INSERT INTO ".$table." (";
            foreach ($data as $key => $value) {
                $sql.= $key.",";
            }
            $sql = substr($sql, 0, -1);
            $sql.= ") VALUES (";
            foreach ($data as $key => $value) {
                $sql.= "'".$value."',";
            }
            $sql = substr($sql, 0, -1);
            $sql.= ");";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $conn = null;
            
        }
        // Hàm cập nhật dữ liệu vào bảng chỉ định
        public function Update_Values($table, $data, $where) {
            $conn = $this->Connect();
            $sql = "UPDATE ".$table." SET ";
            foreach ($data as $key => $value) {
                $sql.= $key."='".$value."',";
            }
            $sql = substr($sql, 0, -1);
            $sql.= " WHERE ";
            foreach ($where as $key => $value) {
                $sql.= $key."='".$value."' AND ";
            }
            $sql = substr($sql, 0, -5);
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $conn = null;
        }
        
        // Hàm xóa dữ liệu trong bảng chỉ định
        public function Delete_Values($table, $where) {
            $conn = $this->Connect();
            $sql = "DELETE FROM ".$table." WHERE ";
            foreach ($where as $key => $value) {
                $sql.= $key."='".$value."' AND ";
            }
            $sql = substr($sql, 0, -5);
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $conn = null;
        }

        public function Insert_Values($table,$data){
            $conn = $this->Connect();
            $sql = "INSERT INTO".$table."(";
            foreach ($data[0] as $key => $v){
                $sql.= $key.",";
            }
            $sql = substr($sql, 0, -1);
            $sql.= ") VALUES ";
            if (count($data) > 1){
                for ($i = 0; $i < count($data); $i++){
                    $sql .= "(";
                    foreach ($data[$i] as $key => $Data_Update){
                        $sql.= "'".$Data_Update."',";
                    }
                    $sql = substr($sql, 0, -1);
                    $sql.= "),";
                }
                $sql = substr($sql, 0, -1);
            } else {
                $sql.= "(";
                foreach ($data[0] as $key => $Data_Update){
                    $sql.= "'".$Data_Update."',";
                }
                $sql = substr($sql, 0, -1);
                $sql.= "),";
                $sql = substr($sql, 0, -1);
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $conn = null;
        }

        public function Disconnect(){
            $this->conn = null;
        }
}




?>