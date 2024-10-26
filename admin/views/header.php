<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Store</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/all.css">
</head>

<body>
    <div class="header-admin">
        <div class="Content-Admin">
            <a href="admin.php" class="Admin-Logo">
                Admin<span>Panel</span>
            </a>
            <nav class="Admin-Page">
                <ul>
                    <li><a href="admin.php?Admin_Action=dashboard">Dashboard</a></li>
                    <li><a href="admin.php?Admin_Action=products">Products</a></li>
                    <li><a href="admin.php?Admin_Action=categories">Categories</a></li>
                    <li><a href="admin.php?Admin_Action=users">Users</a></li>
                    <li><a href="admin.php?Admin_Action=backtoindex">Back To Index</a></li>
                    <?php echo isset($_SESSION['admin_a'])? '<li><a href="admin.php?Admin_Action=logoutadmin">Logout Admin</a></li>':'' ?>
                </ul>
            </nav>
            <div class="Login-Account">
                
            </div>
        </div>
    </div>