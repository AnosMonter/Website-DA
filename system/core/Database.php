<?php
class SQL_Database
{
    public function Connect_DB()
    {
        $Connect_DB = new Database_Model();
        return $Connect_DB->Connect();
    }
    /* =================================================== SQL Products ============================================== */
    public function Get_Products()
    {
        $sql = "SELECT * FROM products";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->execute();
        $List_Products = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Products;
    }

    public function Get_Product_By_ID($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $Product_Detail = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $Product_Detail;
    }

    public function Get_Product_By_Status($status)
    {
        $sql = "SELECT * FROM products WHERE Status = :status";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':status', $status);
        $stml->execute();
        $List_Products = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Products;
    }

    public function Search_Products_By_Name($key)
    {
        $sql = "SELECT * FROM products WHERE Name LIKE :key";
        $Key_Search = '%'.$key.'%';
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':key', $Key_Search);
        $stml->execute();
        $List_Products = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Products;
    }

    public function Get_Top_Products_By_Collum($Collum, $Top){
        $sql = "SELECT * FROM products ORDER BY $Collum DESC LIMIT $Top";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->execute();
        $List_Products = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Products;
    }

    public function Get_Random_Products_List($Limit){
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT :limited";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':limited', $Limit);
        $stml->execute();
        $List_Products = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Products;
    }
    /* =================================================== SQL Categories ============================================ */
    public function Get_Categories()
    {
        $sql = "SELECT * FROM categories";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->execute();
        $List_Categories = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Categories;
    }

    public function Get_Category_By_ID($id){
        $sql = "SELECT * FROM categories WHERE ID = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $Category_Detail = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $Category_Detail;
    }
    public function Get_Product_By_Category($id)
    {
        $sql = "SELECT * FROM products WHERE Cat_ID = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $List_Products = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Products;
    }

    public function Get_Product_By_Categories_Not_Product($id, $id_product_not){
        $sql = "SELECT * FROM products WHERE Cat_ID = :id AND ID!= :id_product_not";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->bindParam(':id_product_not', $id_product_not);
        $stml->execute();
        $List_Products = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Products;
        
    }

    /* ================================================ SQL User ===================================================== */

    public function Get_User()
    {
        $sql = "SELECT * FROM users";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->execute();
        $List_Users = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Users;
    }

    public function Get_User_By_ID($id)
    {
        $sql = "SELECT * FROM users WHERE ID = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $User_Detail = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $User_Detail;
    }

    public function Get_User_Not_ID($id){
        $sql = "SELECT * FROM users WHERE ID != :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $List_Users = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Users;
    }

    public function Update_Role_Status_User_By_ID($id, $role, $status){
        $sql = "UPDATE users SET Role = :role, Status = :status WHERE ID = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':role', $role);
        $stml->bindParam(':status', $status);
        $stml->bindParam(':id', $id);
        $stml->execute();
    }

    /* ================================================ SQL Comments ================================================= */


    public function Get_Comments()
    {
        $sql = "SELECT * FROM comments";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->execute();
        $List_Comments = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Comments;
    }

    public function Get_Comment_By_Product($id)
    {
        $sql = "SELECT * FROM comments WHERE ID_Product = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $List_Comments = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Comments;
    }

    public function Get_Comment_By_User($id){
        $sql = "SELECT * FROM comments WHERE ID_User = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $List_Comments = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Comments;
    }

    public function Get_Comment_By_Date($date){
        $sql = "SELECT * FROM comments WHERE Dates = :date";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':date', $date);
        $stml->execute();
        $List_Comments = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Comments;
    }

    public function Get_Comment_By_Key($Key){
        $sql = "SELECT * FROM comments WHERE Content LIKE :key";
        $Key_Search = '%'.$Key.'%';
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':key', $Key_Search);
        $stml->execute();
        $List_Comments = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Comments;
    }

    public function Add_Comment($id_Prd,$id_user ,$comment){
        $sql = "INSERT INTO comments(`ID_Product`,`ID_User`,`Comments`,`Dates`) VALUES(:id_prd, :id_user, :comment, CURDATE())";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id_prd', $id_Prd);
        $stml->bindParam(':id_user', $id_user);
        $stml->bindParam(':comment', $comment);
        $stml->execute();
    }

    public function Get_All_Comments_And_Users_By_Product($id){
        $sql = "SELECT comments.*, users.Name FROM comments INNER JOIN users ON comments.ID_User = users.ID Where comments.ID_Product = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $List_Comments_And_Users = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Comments_And_Users;
        
    }

    public function Delete_Comments_By_ID($id){
        $sql = "DELETE FROM comments WHERE ID = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
    }

    /* ================================================ SQL Orders ================================================= */

    public function Get_Orders(){
        $sql = "SELECT * FROM orders";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->execute();
        $List_Orders = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Orders;
    }

    public function Get_Order_By_User($id){
        $sql = "SELECT * FROM orders WHERE `User_ID` = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $List_Orders = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Orders;
    }

    public function Get_Order_By_Status($status){
        $sql = "SELECT * FROM orders WHERE Status_Order = :status";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':status', $status);
        $stml->execute();
        $List_Orders = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Orders;
    }

    public function Get_Order_By_Create_Date($date){
        $sql = "SELECT * FROM orders WHERE Create_Date = :date";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':date', $date);
        $stml->execute();
        $List_Orders = $stml->fetchAll(PDO::FETCH_ASSOC);
        return $List_Orders;
    }

    /* ================================================ SQL View ================================================= */

    public function Up_View_Product_By_ID($id){
        $Product = $this->Get_Product_By_ID($id);
        $Views = $Product[0]['View'] + 1;
        $sql = "UPDATE products SET View = :view WHERE ID = :id";
        $Connect_DB = $this->Connect_DB();
        $stml = $Connect_DB->prepare($sql);
        $stml->bindParam(':view', $Views);
        $stml->bindParam(':id', $id);
        $stml->execute();
    }
}
?>