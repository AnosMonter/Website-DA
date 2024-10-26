<?php
class Product_Processing_Model
{
    public $Database;
    public function __construct()
    {
        $this->Database = new Database_Model();
    }
    public function Add_Product()
    {
        if (isset($_POST['Product_Add'])) {/* 
            $sql = "SELECT * FROM categories";
            $List_Categories = $this->Database->Query($sql); */
            $Name_Product = $_POST['Name'];
            $Price = $_POST['Price'];
            $Sale = $_POST['Sale'];
            $Description = $_POST['Description'];
            $Detail = $_POST['Detail'];
            $Quantity = $_POST['Quantity'];
            $Status = $_POST['Status'];
            $Import_Date = !empty($_POST['Import_Date']) ? $_POST['Import_Date'] : date('Y-m-d');
            $Production_Date = empty($_POST['Production_Date']) ? '' : $_POST['Production_Date'];
            $Expiration_Date = empty($_POST['Expiration_Date']) ? '' : $_POST['Expiration_Date'];
            $Cat_ID = $_POST['Cat_ID'];
            $Image_Name = $_FILES['Image']['name'];
            $Image_Temp = $_FILES['Image']['tmp_name'];
            $Description_Detail = [$Description, $Detail];
            setcookie('Description_Detail', json_encode($Description_Detail), time() + 10, "/");
            $Return_Product = '&Name=' . $Name_Product . '&Price=' . $Price . '&Sale=' . $Sale . '&Quantity=' . $Quantity . '&Import_Date=' . $Import_Date . '&Production_Date=' . $Production_Date .
                '&Expiration_Date=' . $Expiration_Date . '&Cat_ID=' . $Cat_ID;
            if (empty($Name_Product)) {
                header('Location: admin.php?Admin_Action=products&Error_Message=Tên Sản Phẩm Không Được Để Trống' . $Return_Product);
                exit();
            } else if (empty($Price)) {
                header('Location: admin.php?Admin_Action=products&Error_Message=Giá Sản Phẩm Không Được Để Trống' . $Return_Product);
                exit();
            } else if (empty($Sale)) {
                header('Location: admin.php?Admin_Action=products&Error_Message=Giảm Giá Sản Phẩm Không Được Để Trống' . $Return_Product);
                exit();
            } else /* if (empty($Description)) {
                header('Location: admin.php?Admin_Action=products&Error_Message=Mô Tả Sản Phẩm Không Được Để Trống' . $Return_Product);
                exit();
            } else if (empty($Detail)) {
                header('Location: admin.php?Admin_Action=products&Error_Message=Chi Tiết Sản Phẩm Không Được Để Trống' . $Return_Product);
                exit();
            } else */ if (empty($Quantity)) {
                header('Location: admin.php?Admin_Action=products&Error_Message=Số Lượng Sản Phẩm Không Được Để Trống' . $Return_Product);
                exit();
            } else if (empty($Image_Name)) {
                header('Location: admin.php?Admin_Action=products&Error_Message=Ảnh Sản Phẩm Không Được Để Trống' . $Return_Product);
                exit();
            } else {
                $File_Dir = 'public/img/Products/';
                $New_Name_Image = 'Products' . $Name_Product . strrchr($Image_Name, '.');
                if (move_uploaded_file($Image_Temp, $File_Dir . $New_Name_Image) == false) {
                    header('Location: admin.php?Admin_Action=products&Error_Message=Không Thể Upload Ảnh Sản Phẩm' . $Return_Product);
                    exit();
                }
                $New_Product = [
                    'Name' => $Name_Product,
                    'Price' => $Price,
                    'Image' => $New_Name_Image,
                    'Sale' => $Sale,
                    'Description' => $Description,
                    'Detail' => $Detail,
                    'Quantity' => $Quantity,
                    'Status' => $Status,
                    'Import_Date' => $Import_Date,
                    'Production_Date' => $Production_Date,
                    'Expiration_Date' => $Expiration_Date,
                    'View' => 0,
                    'Cat_ID' => $Cat_ID
                ];
                $conn = $this->Database->Connect();
                $sql_add_prd = "INSERT INTO products 
                (Name, Price, Image, Sale, Description, Detail ,Quantity, Status, Import_Date, Production_Date, Expiration_Date, View, Cat_ID) 
                VALUES (:Name, :Price, :Image, :Sale, :Description, :Detail ,:Quantity, :Status, :Import_Date, :Production_Date, :Expiration_Date, :View, :Cat_ID)";
                $stmt = $conn->prepare($sql_add_prd);
                $stmt->bindParam(':Name', $New_Product['Name']);
                $stmt->bindParam(':Price', $New_Product['Price']);
                $stmt->bindParam(':Image', $New_Product['Image']);
                $stmt->bindParam(':Sale', $New_Product['Sale']);
                $stmt->bindParam(':Description', $New_Product['Description']);
                $stmt->bindParam(':Detail', $New_Product['Detail']);
                $stmt->bindParam(':Quantity', $New_Product['Quantity']);
                $stmt->bindParam(':Status', $New_Product['Status']);
                $stmt->bindParam(':Import_Date', $New_Product['Import_Date']);
                $stmt->bindParam(':Production_Date', $New_Product['Production_Date']);
                $stmt->bindParam(':Expiration_Date', $New_Product['Expiration_Date']);
                $stmt->bindParam(':View', $New_Product['View']);
                $stmt->bindParam(':Cat_ID', $New_Product['Cat_ID']);
                $stmt->execute();
                /* $this->Database->Insert_Value('products', $New_Product); */
                header('Location: admin.php?Admin_Action=products&Success_Message=Thêm Sản Phẩm Thành Công');
                exit();
            }
        }
    }
    public function Edit_Product()
    {
        if (isset($_POST['Edit_Product'])) {
            $Product_ID = $_POST['Product_ID'];
            $Name = $_POST['Name'];
            $Price = $_POST['Price'];
            $Sale = $_POST['Sale'];
            $Description = $_POST['Description'];
            $Detail = $_POST['Detail'];
            $Quantity = $_POST['Quantity'];
            $Status = $_POST['Status'];
            $Import_Date = $_POST['Import_Date'];
            $Production_Date = $_POST['Production_Date'];
            $Expiration_Date = $_POST['Expiration_Date'];
            $Cat_ID = $_POST['Cat_ID'];
            $Old_File = $_POST['Old_Image'];
            $Image_Name = $_FILES['Image']['name'];
            $Description_Detail = [$Description, $Detail];
            setcookie('Description_Detail', json_encode($Description_Detail), time() + 3600, "/");
            $Return_Product_Edit = '&Name=' . $Name . '&Price=' . $Price . '&Sale=' . $Sale .
                '&Quantity=' . $Quantity . '&Status=' . $Status . '&Import_Date=' . $Import_Date . '&Production_Date=' . $Production_Date .
                '&Expiration_Date=' . $Expiration_Date . '&Cat_ID=' . $Cat_ID;
            if (empty($_POST['Name'])) {
                header('Location: admin.php?Admin_Action=products&Products_Action=edit&Error_Message=Tên Sản Phẩm Không Được Để Trống' . $Return_Product_Edit . '&New_Image=' . $Old_File);
                exit();
            } else if (empty($_POST['Price'])) {
                header('Location: admin.php?Admin_Action=products&Products_Action=edit&Error_Message=Giá Sản Phẩm Không Được Để Trống' . $Return_Product_Edit . '&New_Image=' . $Old_File);
                exit();
            } else if (empty($_POST['Sale'])) {
                header('Location: admin.php?Admin_Action=products&Products_Action=edit&Error_Message=Giảm Giá Sản Phẩm Không Được Để Trống' . $Return_Product_Edit . '&New_Image=' . $Old_File);
                exit();
            } else if (empty($_POST['Quantity'])) {
                header('Location: admin.php?Admin_Action=products&Products_Action=edit&Error_Message=Số Lượng Sản Phẩm Không Được Để Trống' . $Return_Product_Edit . '&New_Image=' . $Old_File);
                exit();
            } else {
                if (!empty($Image_Name)) {
                    $Image_Check = 1;
                } else {
                    $Image_Check = 0;
                    $New_Name_Image = $Old_File;
                }
                $File_Dir = 'public/img/Products/';
                $Image_Temp = $_FILES['Image']['tmp_name'];
                if ($Image_Check == 1) {
                    if (file_exists($File_Dir . $Old_File)) {
                        unlink($File_Dir . $Old_File);
                    }
                    $New_Name_Image = 'Products' . $Name . strrchr($Image_Name, '.');
                    if (move_uploaded_file($Image_Temp, $File_Dir . $New_Name_Image) == false) {
                        header('Location: admin.php?Admin_Action=products&Products_Action=edit&Error_Message=Không Thể Upload Ảnh Sản Phẩm' . $Return_Product_Edit . '&New_Image=' . $Old_File);
                        exit();
                    }
                }
                $sql = "UPDATE products SET Image = :Image, Name = :Name, Price = :Price, Sale = :Sale, Description = :Description, 
                Detail = :Detail, Quantity = :Quantity, Status = :Status, Import_Date = :Import_Date, 
                Production_Date = :Production_Date, Expiration_Date = :Expiration_Date, Cat_ID = :Cat_ID WHERE ID = :id;";
                $connect = $this->Database->Connect();
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':Name', $Name);
                $stmt->bindParam(':Price', $Price);
                $stmt->bindParam(':Sale', $Sale);
                $stmt->bindParam(':Description', $Description);
                $stmt->bindParam(':Detail', $Detail);
                $stmt->bindParam(':Quantity', $Quantity);
                $stmt->bindParam(':Status', $Status);
                $stmt->bindParam(':Import_Date', $Import_Date);
                $stmt->bindParam(':Production_Date', $Production_Date);
                $stmt->bindParam(':Expiration_Date', $Expiration_Date);
                $stmt->bindParam(':Image', $New_Name_Image);
                $stmt->bindParam(':Cat_ID', $Cat_ID);
                $stmt->bindParam(':id', $Product_ID);
                $stmt->execute();
                header('Location: admin.php?Admin_Action=products&Products_Action=edit&Success_Message=Sửa Sản Phẩm Thành Công' . $Return_Product_Edit . '&New_Image=' . $New_Name_Image);
                exit();
            }
        }
    }
    public function Delete_Product($id)
    {
        $sql = "DELETE FROM products WHERE ID = :id";
        $sql_del_image = "SELECT * from products where ID = :id";
        $connect = $this->Database->Connect();
        $stmt1 = $connect->prepare($sql_del_image);
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();
        $row = $stmt1->fetchAll();
        $File_Dir = 'public/img/Products/';
        if (file_exists($File_Dir . $row[0]['Image'])) {
            if (unlink($File_Dir . $row[0]['Image']) === true) {
                $Del = ', Xóa Ảnh Thành Công';
            } else {
                $Del = ', Xóa Ảnh Thất Bại';
            };
        }
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: admin.php?Admin_Action=products&Success_Message=Xóa Sản Phẩm Thành Công' . $Del);
        exit();
    }
}
