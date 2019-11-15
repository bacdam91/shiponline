<ul>
    <li>
        New users: <a href="shiponline.php">Home</a>
    </li>
    <?php if (!isset($_SESSION["CustomerID"])) { ?>
        <li>
            New users: <a href="register.php">Registration</a>
        </li>
        <li>
            Existing users: <a href="login.php">Login</a>
        </li>
    <?php } else { ?>
        <li>Account: <a href="./logout.php">Logout</a></li>
    <?php } ?>
    <li>
        Administrators: <a href="admin.php">Administation</a>
    </li>
</ul>