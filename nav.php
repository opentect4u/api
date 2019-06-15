<html>
    <head>
        <style>
            body{
                margin: 20px;
            }
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }

            li {
                float: left;
                border-right:1px solid #bbb;
            }

            li:last-child {
                border-right: none;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                background-color: #111;
            }

            .active {
                background-color: #4CAF50;
            }
        </style>
    </head>
    <body>

        <ul>
        <li><a class="active" href="dashboard.php">Home</a></li>
        <li><a href="addSociety.php">Add Society</a></li>
        <li><a href="setDate.php">Set Date</a></li>
        <li><a href="api.php" target=_blank>Manual Fire</a></li>
        <li style="float:right"><a href="logout.php">Logout</a></li>
        </ul>

    </body>
</html>
