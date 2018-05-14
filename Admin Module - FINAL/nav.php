<!DOCTYPE html>
<body lang="en">

<head>
    <title>Arkila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <link rel="Stylesheet" type="text/css" href="css/styles.css">
</head>
<div class="container">
    <div class="content">
        <div class="col-2">
            <div id='cssmenu' class="fade-in">
                <ul class="fade-inn">
                    <li>
                        <img src="images/Arkila-Logo-1.png" alt="logo">
                        <p>Hi, ADMIN</p>
                        <form action="logout.php">
                            <div>
                                <button class="dashboard" type="submit" name="logout_user"> Logout </button>
                            </div>
                        </form>
                    </li><br><br>
                    <li>
                        <a href="FetchDB.php" target="_self"><img src="images/dashboard.png" alt="DASHBOARD"><br><p>Dashboard</p></a>

                    </li>
                    <li>
                        <a href="TMonitoring.php" target="_self"><img src="images/transactions.png" alt="TRANSACTIONS"><br><p>Transaction Monitoring</p></a>
                    </li>
                    <li>
                        <a href="userManagement.php" target="_self"><img src="images/users.png" alt="USER"><br><p>User<br>Management</p></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
<html>
