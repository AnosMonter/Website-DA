<div class="Admin-User-Manager">
    <div class="Noitifications">
        <?php
        if (isset($_GET['Error_Message'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] . '</div>';
        } else if (isset($_GET['Success_Message'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . '</div>';
        }
        ?>
    </div>
    <div class="Admin-User-Manager-Page">
        <h1>USER MANAGER</h1>
        <div class="Table-User-Manager">
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <?php
                    if (isset($_SESSION['admin_u']) == 0 || isset($_SESSION['admin_a']) == 0) {
                        echo '<th>Action</th>';
                    }
                    ?>
                </tr>
                <?php
                $List_U = '';
                foreach ($List_Users as $user) {
                    $List_U .= '<tr>
                            <td>' . $user['ID'] . '</td>
                            <td>' . $user['Name'] . '</td>
                            <td>' . $user['Email'] . '</td>';
                    $List_U.= $user['Status'] == 0 ? '<td> Active </td>' :'<td> Blocked </td>';
                    if ($user['Role'] == 0) {
                        $List_U .= '<td> Admin </td>';
                    } else if ($user['Role'] == 1) {
                        $List_U .= '<td> Manager </td>';
                    } else {
                        $List_U .= '<td> User </td>';
                    }

                    if (isset($_SESSION['admin_u']) == 0 || isset($_SESSION['admin_a']) == 0) {
                        $List_U .= '
                            <td><a href="admin.php?Admin_Action=users&User_Action=edit&ID=' . $user['ID'] . '">Edit</a> | <a href="admin.php?Admin_Action=user_manager&User_Action=delete&ID=' . $user['ID'] . '">Delete</a></td>
                        ';
                    }
                    $List_U .= '</tr>';
                }
                echo $List_U;
                ?>
            </table>

        </div>
    </div>
</div>