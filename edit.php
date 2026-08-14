<!DOCTYPE html>

<head>
    <link rel="icon" type="image/x-icon" href="icon2.png">
    <title>CERTIFICATE MAINTANCE SYSTEM</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
        }

        .parent {
            display: flex;
        }

        .child {
            width: 100%;
            padding-left: 40%;
        }

        .out {
            padding-left: 30%;
        }

        input[type=text],
        input[type=password] {

            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: none;
            border-bottom: 2px solid #32be8f;
        }

        .div {
            padding-left: 16%;
        }
    </style>
</head>

<body>
    <a href="studentdetailss.php" class="n"><button type="button" class="btn" id="btn1" style="width: 10%;">Back</button></a>
    <center>
        <h2>Assigning Class Teachers</h2>
    </center><br>
    <div class="out">
        <form method='POST' action='update.php'>
            <center>
                <div class="child">
                    <label for="branch"><b>Branch</b></label><br>
                    <input type="text" placeholder="Enter Branch (Ex: CSE)" name="branch" id="uname" required><br>

                    <label for="year"><b>Year</b></label><br>
                    <input type="text" placeholder="Enter year (Ex: 1st year)" name="year" id="psw" required><br>

                    <label for="name"><b>Faculty Name</b></label><br>
                    <input type="text" placeholder="Enter Faculty Name" name="name" id="name" required><br>

                    <input type='submit' class='btn' value='Update' name='submit' style="width: 50%;">

                </div>

            </center>
        </form>
        <div class='div'>
            <a href="counsellor.php" class="n"><button type="button" class="btn" id="btn1" style="width: 25%;">Assign Counsellor</button>
                <a href="classincharge.php" class="n"><button type="button" class="btn" id="btn1" style="width: 25%;">Assign Class Incharge</button>
        </div>
</body>



</html>