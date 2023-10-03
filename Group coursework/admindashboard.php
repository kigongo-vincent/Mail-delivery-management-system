<?php session_start();
if (!isset($_SESSION['login-id'])) {
    header('Location: adminlogin.html');
} else {
    $username = $_SESSION['username'];
    include './connect.php';
    $query1 = mysqli_query($conn, "select distinct p_o_box from mail");
    $query2 = mysqli_query($conn, "select * from staff");
    $query3 = mysqli_query($conn, "select * from mail where mail_status = 0");
    $query4 = mysqli_query($conn, "select * from mail where mail_status = 1");
    $query5 = mysqli_query($conn, "select * from admin_inbox");
    $messages = 0;
    $clients = 0;
    $delivered = 0;
    $undelivered = 0;
    $staff = 0;
    while ($row = mysqli_fetch_assoc($query5)) {
        $messages = $messages + 1;
    }
    while ($row = mysqli_fetch_assoc($query3)) {
        $delivered = $delivered + 1;
    }
    while ($row = mysqli_fetch_assoc($query4)) {
        $undelivered = $undelivered + 1;
    }
    while ($row = mysqli_fetch_assoc($query2)) {
        $staff = $staff + 1;
    }
    while ($row = mysqli_fetch_assoc($query1)) {
        $clients = $clients + 1;
    }

    try {
        $total = $delivered + $undelivered;
        $undelivered = round(($undelivered / $total) * 100, 2);
        $delivered = round(($delivered / $total) * 100, 2);
    } catch (\Throwable $th) {
        //throw $th;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./chart.min.js"></script>
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'poppins';
            transition: .2s;
            font-weight: lighter;
        }

        :root {
            --bg-dark: #252A4A;
            --bg-very-dark: #202342;
            --bg-light: #343965;
            --red: #FF4C87;
            --blue: #36A7FD;
            --purple: #824AFE;
            --dark-purple: #844CFE;
            --white: #F0F8FF;
            --bg-very-light-dark: #202341;
        }

        body {
            background-color: var(--bg-dark);
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
            grid-template-rows: .2fr .4fr .2fr 1fr;
            height: 100vh;
            padding-right: 40px;
            gap: 10px;
            color: var(--white);
            overflow: hidden;
        }

        .main-div {
            grid-column: 2/5;
            background-color: var(--bg-light);
            height: 85%;
            position: relative;
            align-self: top;
        }

        .dull {
            opacity: .8;
        }

        .employees {
            grid-column: 5/6;
            min-width: 260px;
            height: 80%;
            font-size: .9rem;
            align-self: top;
            background-color: var(--bg-very-light-dark);
        }

        .round {
            border-radius: 5px;

        }

        .spacing {
            padding: 10px 20px;
        }

        .sidebar {
            grid-row: 1/5;
            padding: 20px;
            color: aliceblue;
            overflow: hidden;
            height: 100vh;
            background-color: var(--bg-very-dark);

        }

        .sidebar-hide {
            width: 0;
            padding: 0;
        }

        .navbar {
            grid-row: 1/2;
            grid-column: 2/6;
            justify-content: space-between;
        }

        .hero {
            grid-column: 2/4;

        }

        .purple-text {
            color: var(--purple);
        }

        .social-media {
            background: linear-gradient(#252a4a70, #202342dc), url(./images/Mask\ Group\ 20.jpg);

            background-position: center;
            background-size: cover;
            grid-column: 4/6;
            display: flex;
            flex-direction: column;
            align-items: start;
            justify-content: space-around;

        }

        .light {
            background: linear-gradient(#cfd0e5c3, #cfd0e5c3), url(./images/Mask\ Group\ 20.jpg);

        }

        .purple {
            background-color: var(--purple);
        }

        .red {
            background-color: var(--red);
        }

        .green {
            background-color: var(--blue);
        }

        .fit {
            position: absolute;
            width: 100%;
        }

        .trim {
            overflow: hidden;
        }

        .parent {
            position: relative;
        }

        .icons {
            height: 20px;
            margin: 0 10px;
        }

        .h-align {
            display: flex;
            align-items: center;
        }

        .t-input {
            background: transparent;
            border: none;
            outline: none;
            color: var(--white);
        }

        .search {
            width: 240px;
            background-color: var(--bg-light)
        }

        input::-webkit-input-placeholder {
            color: var(--white);
            opacity: .4;
        }

        .full-round {
            border-radius: 500px;
        }

        .notification p {
            position: absolute;
            height: 10px;
            width: 10px;
            font-size: 9px;
            text-align: center;
            font-weight: bold;
            padding: 5px;
            background-color: var(--purple);
            top: -10px;
            right: -30px;
        }

        .child {
            position: absolute;
        }

        .v-align {
            display: flex;
            align-items: center;
        }

        .a-h-align {
            left: 50%;
            transform: translateX(-50%);
        }

        .a-v-align {
            top: 50%;
            transform: translateY(-50%);
        }

        .notification {
            transform: translateY(-10px);
        }

        .last-nav-item {
            width: 300px;
            justify-content: space-between;
        }

        .switch {
            background-color: var(--bg-light);
            width: 40px;
        }

        .thumb {
            width: 20px;
            height: 20px;
            position: absolute;
            transform: translateX(20px);
            background-color: var(--white);
        }

        .line,
        .doughnut {
            width: 300px;
            height: 190px;
            padding: 30px;
            margin: 5px;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;

        }

        .line {
            border-left: 5px solid var(--bg-dark);
        }

        .text-center {
            text-align: center;
        }

        .img-container {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            overflow: hidden;
            margin-right: 10px;
            background-image: url(./images/user.svg);
            background-position: bottom;
            background-repeat: no-repeat;
        }

        .profile-pic {
            width: 50px;
        }

        .very-dull {
            opacity: .4;
        }

        .v-space {
            margin: 25px 0;
        }

        .overlay-scroll {
            overflow-y: scroll;
        }

        .overlay-scroll::-webkit-scrollbar {
            display: none;

        }

        .circle {
            height: 8px;
            width: 8px;
            margin: 0 5px;
            transform: translateY(3px);
        }

        .end-to-end {
            justify-content: space-between;
        }

        .profile-pic-container {
            width: 100px;
            height: 100px;
        }

        .profile-pic-container img {
            width: 100px;
        }

        .ribbon {
            border: 2px solid var(--purple);
            width: 100px;
            padding: 3px;
            margin: 10px;
        }

        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        .icons-large {
            width: 25px;
            margin-right: 15px;
        }

        ul {
            list-style: none;
        }

        .my-list {
            height: 60vh
        }

        .profile-data {
            border: 1px solid var(--dark-purple);
            width: 100%;
            height: 100%;
            padding-left: 10%;
        }

        .edit-profile {
            border-left: 1px solid #824AFE;
            border-right: 1px solid #834afe4f;
            border-top: 1px solid #824AFE;
            border-bottom: 1px solid #834afe68;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.206);
            background-color: var(--bg-light);
            padding: 50px 30px;
            border-radius: 5px;
            font-size: .8rem;
            position: absolute;
            transform: scaleY(0);
            transform-origin: top;
            bottom: 20%;
            left: 20%;
        }

        .no-mails {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .input {
            background: transparent;
            border-radius: 4px;
            height: 35px;
            width: 100%;
            outline: none;
            color: var(--white);

            border: 1px solid rgba(112, 128, 144, 0.846);
        }

        .input[type=email],
        .input[type=password],
        .input[type=text] {
            padding: 0 10px;
        }

        .input:focus {
            border-color: var(--dark-purple);
        }

        .zero-border {
            border: none;
            color: var(--white);
            width: 100%;
            height: 35px;
            border-radius: 4px;
        }

        input[type=file]::-webkit-file-upload-button {
            background-color: var(--blue);
            width: 100%;
            height: 35px;
            border: none;
            border-radius: 4px;
            color: var(--white);
        }

        .extra {
            width: 250px;
        }

        .show-form {
            transform: scaleY(1);
        }

        .mails {
            position: absolute;
            height: 100%;
            width: 100%;
        }

        .mail {
            background-color: var(--bg-dark);
            display: flex;
            padding: 20px;
            display: flex;
            align-items: center;
            height: 20px;
            position: relative;
            font-size: .9rem;
            margin: 2px 0;

        }

        .mail p:nth-of-type(1) {
            position: absolute;
            left: 2%;
        }

        .mail p:nth-of-type(2) {
            position: absolute;
            left: 25%;
            max-width: 150px;
            overflow: hidden;

        }

        .mail p:nth-of-type(3) {
            position: absolute;

            left: 50%;
        }

        .mail p:nth-of-type(4) {
            position: absolute;

            left: 75%;
        }

        .mail:first-child {
            background-color: var(--bg-very-dark);
            opacity: .5;

        }

        a {
            text-decoration: none
        }

        a:link,
        a:visited,
        a:active {
            color: var(--white)
        }

        .delete {
            position: absolute;
            right: 2px;
        }

        .delete-confirm {
            position: absolute;
            background-color: var(--bg-light);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            width: 400px;
            left: 50%;
            top: 50%;
            border-radius: 10px;
            transform: translate(-50%, -50%);
            height: 0;
            overflow: hidden;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.112), -10px -10px 15px rgba(0, 0, 0, 0.112);

        }

        .confirm-show {
            height: 150px;
        }

        .delete-confirm div {
            display: flex;
            margin-top: 10px;
        }

        .delete-confirm div button {
            border: none;
            color: var(--white);
            padding: 10px 50px;
            border-radius: 4px;
            margin: 10px;
        }

        .messages {
            height: 200px;
            width: 100%;
        }

        .message h2 {
            margin-left: 60px;
        }

        .button {
            width: 380px;
        }

        .add-user {
            background-color: var(--bg-light);
            padding: 40px 60px;
            overflow: hidden;
            height: 350px;
            position: absolute;
            top: 30%;
            left: 30%;
            transform: scaleX(0);
            transform-origin: right;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.073), -10px -10px 15px rgba(0, 0, 0, 0.067);
        }

        .pointer {
            cursor: pointer;
        }

        .showAddUser {
            transform: scaleX(1);

        }

        .fixed-color {
            color: aliceblue;
        }

        .error {
            border-color: var(--red);
            color: var(--red);
        }

        .no-error {
            border-color: var(--blue);
            color: var(--blue);
        }

        .add-mail {
            position: absolute;
            top: 25%;
            left: 30%;
            padding: 30px 60px;
            background-color: var(--bg-light);
            border-radius: 4px;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.1), -10px -10px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transform: scaleX(0);
            transform-origin: left;
        }

        .add-mail input {
            margin: 5px 0;
        }

        .transformMail {
            transform: scaleX(1);
        }

        .sidebar-hide {
            grid-template-columns: 0fr 1fr 1fr 1fr .8fr;
            width: 95vw;
            padding-right: 30px;
        }

        .movethumb {
            transform: translateX(0px);
            transition: 0s;
        }

        .faqs {
            background-color: var(--bg-light);
            padding: 2px 20px;
            border-radius: 3px;
        }

        :not(input) {
            cursor: pointer;
        }

        .sidebar ul li {
            margin: 25px 0;
            opacity: .5;

        }

        .sidebar ul li:hover {
            opacity: 1;
            transition: .3s
        }
    </style>
</head>

<body class="">
    <div class='sidebar pointer'>
        <div class="logo h-align end-to-end">
            <span class="h-align">
                <h3 class="purple-text">PAVILIONEE</h3>
                <div class="circle red full-round icons"></div>
            </span>
            <img src="./images/bars.svg" alt="" class="icons" onclick="hideSidebar()">
        </div>
        <div class="profile spacing text-center">
            <div class="ribbon full-round">
                <div class="profile-pic-container trim full-round">
                    <img src="./upload/0.jpg" alt="">
                </div>
            </div>
            <h5 id="adminname"></h5>
        </div>
        <div class="menu">
            <p class="very-dull space-around">MAIN</p>
            <ul class="overlay-scroll trim my-list">
                <li class="h-align v-space end-to-end ">
                    <span class="h-align">
                        <img src="./images/298756_dashboard_icon.svg" alt="" class="icons-large">
                        <p class="purple-text"><a href="admindashboard.php">Dashboard</a></p>
                    </span>
                </li>
                <li class="h-align v-space end-to-end">
                    <span class="h-align">
                        <img src="./images/house.svg" alt="" class="icons-large">
                        <p><a href="admindashboard.php">
                                Home page
                            </a></p>
                    </span>
                    <img src="./images/arrow-right-long.svg" alt="" class="icons very-dull">
                </li>
                <li id="profile" class="h-align v-space end-to-end">
                    <span class="h-align">
                        <img src="./images/user.svg" alt="" class="icons-large">
                        <p>Profile</p>
                    </span>
                    <img src="./images/arrow-right-long.svg" alt="" class="icons very-dull">
                </li>
                <li class="h-align v-space end-to-end">
                    <span class="h-align">
                        <img src="./images/settings.svg" alt="" class="icons-large">
                        <p id="edit-my-data">Edit profile</p>
                    </span>
                    <img src="./images/arrow-right-long.svg" alt="" class="icons very-dull">
                </li>
                <li class="h-align v-space end-to-end" onClick="showAdduser()">
                    <span class="h-align">
                        <img src="./images/user-group.svg" alt="" class="icons-large">
                        <p>Add User</p>
                    </span>
                    <img src="./images/arrow-right-long.svg" alt="" class="icons very-dull">
                </li>
                <li class="h-align v-space end-to-end" id="mails">
                    <span class="h-align">
                        <img src="./images/envelope.svg" alt="" class="icons-large">
                        <p>Mails</p>
                    </span>
                    <img src="./images/arrow-right-long.svg" alt="" class="icons very-dull">
                </li>
                <li id="hidden">
                </li>
                <li class="h-align v-space end-to-end" onclick="fetchClients()">
                    <span class="h-align">
                        <img src="./images/user-group.svg" alt="" class="icons-large">
                        <p>Clients</p>
                    </span>
                    <img src="./images/arrow-right-long.svg" alt="" class="icons very-dull">
                </li>
                <li class="h-align v-space end-to-end" onclick="fetchMessages()">
                    <span class="h-align">
                        <img src="./images/inbox.svg" alt="" class="icons-large">
                        <p>Messages</p>
                    </span>
                    <img src="./images/arrow-right-long.svg" alt="" class="icons very-dull">
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar h-align">
        <div class="search h-align spacing full-round">
            <img src="./images/search.svg" alt="" class="icons">
            <input type="text" placeholder="search for mails" class="t-input" oninput="searchResults()" id="search">
        </div>
        <div class="last-nav-item v-align">
            <div class="h-align">
                <!--   <div class="switch icons full-round" onClick = "mode()">
                    <div class="thumb full-round" id = 'thumb'></div>
                </div> -->
                <p class='faqs'>FAQs</p>
            </div>
            <div class="notification parent" onclick="fetchMessages()">
                <img src="./images/bell.svg" alt="" class="icons child">
                <p class="full-round child"><?php echo $messages ?></p>
            </div>

            <div class="logout h-align" onClick="logout()">
                <img src="./images/mono-exit.svg" alt="" class="icons">
                <p>Logout</p>
            </div>

        </div>
    </div>
    <div class="hero round spacing">
        <h1>Dashboard</h1>
        <p class="dull">
            Welcome aboard, <span id="userad"></span>
        </p>
    </div>
    <div class="social-media trim round spacing parent">
        <h4>Social Media links for Assistance</h4>
        <img src="./images/Group 19.svg" alt="" class="icons dull">
    </div>
    <div class="red round spacing delivered fixed-color">
        <h1><?php echo $delivered ?>%</h1>
        <p class="dull">Undelivered Mails</p>
    </div>
    <div class="purple round spacing fixed-color">
        <h1><?php echo $undelivered ?>%</h1>
        <p class="dull">Delivered Mails</p>
    </div>
    <div class="green round spacing fixed-color">
        <h1><?php echo $staff ?></h1>
        <p class="dull">Active Employee(s)</p>
    </div>
    <div class="purple round spacing fixed-color">
        <h1><?php echo $clients ?>  </h1>
        <p class="dull">Client(s)</p>
    </div>
    <div class="main-div round v-align">
        <div class="doughnut">
            <p class="dull spacing text-center">Mail Delivery Standings</p>
            <canvas id="doughnut"></canvas>
        </div>
        <div class="line">
            <p class="dull spacing text-center">Mail Deliveries per Employee</p>
            <canvas id="line"></canvas>
        </div>
    </div>
    <div class="employees spacing round overlay-scroll">
        <p class="dull spacing">All Employees</p>
    </div>
    <script>
        function fetchuserdata() {
            const employees = document.querySelector(".employees")
            fetch('fetchuserdata.php')
                .then((res) => res.json())
                .then((data) => {
                    let userdataoutput = ""
                    data.forEach(element => {
                        userdataoutput += `
    <div class=" v-align v-space">
                    <div class="img-container">
                        <img src="./upload/${element.staffID}.jpg" alt="" class="profile-pic">
                    </div>
                    <span>
                         <p>${element.username}</p>
                        <p class="very-dull">${element.email}</p>
                    </span>
                </div>
    `
                    })
                    employees.innerHTML += userdataoutput
                })
        }
    </script>
    <form class="edit-profile" action="./updateadmin.php" enctype="multipart/form-data" method="post" onsubmit="updateform()">
        <table cellspacing='10'>
            <legend class="very-dull">Edit Bio Data</legend>
            <tr>
                <td>
                    username
                </td>
                <td>
                    <input type="text" class="input extra" placeholder="insert username" name='uname' id="aname">
                </td>
                <td>
                    Date Of Birth
                </td>
                <td>
                    <input type="date" class="input" name="dob" id="dob">
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="email" class="input extra" name="email" id="email">
                </td>
                <td colspan="2">Select a profile picture (optional)</td>
            </tr>
            <tr>
                <td>
                    New password
                </td>
                <td>
                    <input type="password" class="input extra" id="password" name="adminpass">
                </td>
                <td colspan="2"><input type="file" name="upload" id="image"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><input type="text" class="input extra" name="gender" id="gender"></td>
                <td><input type="submit" id="submit" value="save" name="submit" class="purple zero-border"></td>
                <td><input type="reset" value="Cancel" class="zero-border red" id="cancel"></td>
            </tr>

        </table>
    </form>
    <div class="delete-confirm">

    </div>
    </div>
    <form action="./adduser.php" id="add-user" onsubmit="userform()" method="post">
        <table class="add-user round">
            <tr>
                <td>Username</td>
            </tr>
            <tr>
                <td><input type="text" class="input button" id="user-name" name="user-name"></td>
            </tr>
            <tr>
                <td>
                    <p>Email</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="email" class="input button" id="user-email" name="user-email">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Add user" class="zero-border green message " id="user-submit" name="submit">
                </td>

            </tr>
            <tr>

                <td>
                    <input type="reset" onclick="removeusererrror()" value="Clear fields" class="zero-border red message" id="cancel-add-user">
                </td>

            </tr>
        </table>
    </form>
    <form action="addmails.php" class="add-mail" onsubmit="mailform()" method="post">
        <table class=" round">
            <tr>
                <td>Reciever's Name</td>
            </tr>
            <tr>
                <td><input type="text" class="input button" id="reciever-name" name="reciever-name"></td>
            </tr>
            <tr>
                <td>P.O BOX</td>
            </tr>
            <tr>
                <td><input type="text" class="input button" id="po-box" name="po-box"></td>
            </tr>
            <tr>
                <td>
                    <p>Contact</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="input button" id="contact" name="contact">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Add Mail" class="zero-border green message " id="mail-submit">
                </td>

            </tr>
            <tr>

                <td>
                    <input type="reset" onclick="removeError()" value="Clear Fields" class="zero-border red message">
                </td>

            </tr>
        </table>
    </form>
    <script>
        //doughnut chart
        Chart.defaults.global.defaultFontFamily = 'poppins'
        Chart.defaults.global.defaultFontColor = 'rgba(240, 248, 255, 0.811)'

        function drawDoughnut() {
            fetch('fetchmailsnum.php')
                .then((res) => res.json())
                .then((dat) => {
                    const firstChart = document.getElementById("doughnut")
                        .getContext("2d");
                    const myFirstChart = new Chart(firstChart, {
                        type: "doughnut",
                        data: {
                            labels: Array("delivered", "undelivered"),
                            datasets: [{
                                data: dat,
                                backgroundColor: ["#202342", "aliceblue"],
                                borderWidth: [0, 0],
                            }, ],
                        },
                        options: {
                            maintainAspectRatio: false,
                            /* responsive: true, */
                            cutoutPercentage: 70,
                            stroke: false,
                        },
                    });
                })
        }
        //line
        function drawLine() {
            fetch('fetchfigures.php')
                .then((res) => res.json())
                .then((data) => {
                    const secondChart = document.getElementById("line").getContext("2d");
                    const mySecondChart = new Chart(secondChart, {
                        type: "line",
                        data: {
                            labels: data['names'],
                            datasets: [{
                                data: data['numbers'],
                                label: 'No of mails delivered',
                                backgroundColor: "#202342",
                                borderWidth: [0, 0],
                            }, ],
                        },
                        options: {
                            maintainAspectRatio: false,
                            stroke: false,
                        },
                    });
                })
        }
    </script>
    <script>
        //mails toggle
        const mails = document.getElementById("mails")
        const hiddenMails = document.getElementById("hidden")
        mails.addEventListener("click", () => {
            if (hiddenMails.innerHTML === '') {
                hiddenMails.innerHTML = `
                     <li class="spacing" onClick = "fetchMails()">
                        View All Mails
                    </li>
                    <li class="spacing" onClick = "addmail()" >
                        Add Mail
                    </li>
            `
            } else {
                hiddenMails.innerHTML = ''
            }
        })

        //profile
        const mainDiv = document.querySelector(".main-div")
        const profile = document.getElementById("profile")
        profile.addEventListener("click", () => {
            fetch('./fetchadmindata.php')
                .then((res) => res.json())
                .then((data) => {
                    let adminmailsoutput = ""

                    data.forEach(element => {
                        adminmailsoutput = `
            <div class="profile-data round h-align">
            <div class="ribbon full-round">
                <div class="profile-pic-container full-round trim">
                <img src="upload/${element.adminID}.jpg" alt="">
                </div>
            </div>
            <div class="details spacing">
                <h1 class="spacing">${element.username} </h1>
            <p class="spacing dull">${element.email} </p>
            <p class="very-dull spacing">Born, ${element.dob}</p>
            <p class="very-dull spacing">${element.gender}</p>
            </div>
                </div>
            `
                    })
                    mainDiv.innerHTML = adminmailsoutput
                })
        })
        //edit my data
        const editProfile = document.querySelector(".edit-profile")
        const edit = document.getElementById("edit-my-data")
        edit.addEventListener("click", () => {
            editProfile.classList.toggle("show-form")
        })
    </script>
    <script>
        //form validation



        function updateform() {
            const uname = document.getElementById('aname')
            const password = document.getElementById('password')
            const email = document.getElementById('email')
            const dob = document.getElementById('dob')
            const gender = document.getElementById('gender')
            if (!((uname.value).length > 0)) {
                event.preventDefault()
                uname.value = "please provide a name"
                uname.classList.add("error")
            }
            if (!(gender.value == 'male' || gender.value == 'female')) {
                event.preventDefault()
                gender.classList.add("error")
                gender.value = 'please input the right gender'
            }
            if ((password.value).length < 4) {
                event.preventDefault()
                password.type = "text"
                password.classList.add("error")
                password.value = 'few password characters'
            }
            if (!((dob.value).length > 0)) {
                event.preventDefault()
                dob.classList.add("error")
            }
            if (!((email.value).includes('@'))) {
                event.preventDefault()
                email.classList.add("error")
                email.value = 'please provide the correct email'
            }
        }
        //cancel button
        const cancel = document.getElementById("cancel")
        cancel.addEventListener("click", () => {
            const uname = document.getElementById('aname')
            const password = document.getElementById('password')
            const email = document.getElementById('email')
            const dob = document.getElementById('dob')
            const gender = document.getElementById('gender')
            uname.classList.remove("error")
            gender.classList.remove("error")
            dob.classList.remove("error")
            password.classList.remove("error")
            email.classList.remove("error")
            password.type = "password"

        })

        function fetchMails() {
            fetch('fetchmails.php')
                .then((res) => res.json())
                .then((data) => {

                    let undeliveredmailsoutput = ""
                    data.forEach(element => {
                        let today = new Date().getTime()
                        let sent = new Date(element.date_Delivered).getTime()
                        let added = new Date(element.date_Added).getTime()
                        let delivered = Math.floor((today - sent) / (3600 * 1000 * 24))
                        let passedby = Math.floor((today - added) / (3600 * 1000 * 24))
                        if (delivered == 0) {
                            delivered = 'Less than a'
                        }
                        if (passedby === 0) {
                            passedby = 'Less than a'
                        }
                        undeliveredmailsoutput += `
    <div class="mail">
    <p>${element.client_name}</p>
        <p>${element.p_o_box}</p>
     <p>${passedby}  ${passedby > 1 ? 'Days':'Day'} Ago</p>
     <p style = "color : ${element.date_Delivered ? '#36A7FD':'#FF4C87' }">${element.date_Delivered ? delivered +( delivered > 1 ? ' Days Ago': ' Day Ago'): `Not yet Delivered`}</p>
    </div>
    `

                    })
                    mainDiv.innerHTML = `
  <div class="mails overlay-scroll">
  <div class="mail">
  <p>Reciever's Name</p>
      <p>P.O BOX</p>
   <p>Added</p>
  <p>Delivered</p>
  </div>
  ${undeliveredmailsoutput}
  </div>
  `
                })
        }

        function searchResults() {

            event.preventDefault()
            const search = document.getElementById("search").value
            let searchData = {
                search: search
            }
            fetch('search.php', {
                    method: 'POST',
                    body: JSON.stringify(searchData),
                    headers: {
                        'Content-type': 'application/json'
                    }
                })
                .then((res) => res.json())
                .then((data) => {

                    if (data.length > 0) {
                        let searchoutput = ''
                        data.forEach(element => {
                            let today = new Date().getTime()
                            let sent = new Date(element.date_Delivered).getTime()
                            let delivered = Math.floor((today - sent) / (3600 * 1000 * 24))
                            if (delivered == 0) {
                                delivered = 'Less than a'
                            }


                            searchoutput += `
        <div class="mail">
        <p>${element.client_name}</p>
        <p>${element.p_o_box}</p>
        <p style = "color: ${element.username ? '': '#FF4C87'}">${element.username ? element.username : 'Not Yet delivered'}</p>
        <p style = "color : ${element.date_Delivered ? '#36A7FD':'#FF4C87' }">${element.date_Delivered ? delivered +( delivered > 1 ? ' Days Ago': ' Day Ago'): `Not yet Delivered`}</p>
        <img id=${element.mailID} src="./images/S_TBDelete_22_N@2x.svg" alt="" class="icons-large delete" onClick = "confirmDelete()">
    </div>
        `
                        })
                        mainDiv.innerHTML = `
  <div class="mails overlay-scroll">
  <div class="mail">
  <p>Reciever's Name</p>
      <p>P.O BOX</p>
   <p>Delivered By</p>
  <p>Delivered</p>
  </div>
  ${searchoutput}
  </div>
  `
                    } else {
                        mainDiv.innerHTML = "<h1 class= 'no-mails'>No Mails Found</h1>"
                    }
                })




        }
        const deleteConfirm = document.querySelector(".delete-confirm")

        function confirmDelete() {
            deleteConfirm.classList.add("confirm-show")
            deleteConfirm.innerHTML = `
            <p>Are you sure you want to delete this Mail</p>
      <div>
        <button id="${event.target.id}" class="purple" onClick = "deleteMail()">Confirm</button><button id="kill" class="red" onclick="kill()">Cancel</button>
            `
        }

        function deleteMail() {
            deleteConfirm.classList.remove("confirm-show")
            let mail = event.target.id
            let mailId = {
                mid: mail
            }
            fetch('deletemymail.php', {
                    method: 'POST',
                    body: JSON.stringify(mailId),
                    headers: {
                        'Content-type': 'application/json'
                    }
                })
                .then((res) => res.json())
                .then((data) => {
                    alert(data)
                    window.location = 'admindashboard.php'
                })
        }

        function kill() {
            deleteConfirm.classList.remove("confirm-show")
        }

        function fetchClients() {
            fetch('fetchclients.php')
                .then((res) => res.json())
                .then((data) => {
                    let clientoutput = ""
                    data.forEach(element => {
                        clientoutput += `
    <div class="mail">
    <p>${element.client_name}</p>
    <p>${element.p_o_box}</p>
    <p>${element.contact}</p>
    <img id src="./images/user.svg" alt="" class="icons delete">
    </div>
    `
                    })
                    mainDiv.innerHTML = `
  <div class="mails overlay-scroll">
  <div class="mail">
  <p>Name of Client</p>
  <p>P.O BOX</p>
  <p>Contact</p>
  </div>
  ${clientoutput}
  
  </div>
  `
                })
        }




        function fetchMessages() {
            fetch('./fetchmessages.php')
                .then((res) => res.json())
                .then((data) => {

                    let output = ''
                    data.forEach(e => {
                        let today = new Date().getTime()
                        let sent = new Date(e.date).getTime()

                        let delivered = Math.floor((today - sent) / (3600 * 1000 * 24))
                        if (delivered <= 0) {
                            delivered = 'Less than one '
                        }
                        output += `
<div class="message">
        <div class=" v-align v-space">
            <div class="img-container">
                <img src="./upload/${e.staffID}.jpg" alt="" class="profile-pic">
            </div>
            <span>
                <p>${e.username}</p>
                <p class="very-dull">${e.email}</p>
                
            </span>
            
        </div>
        <span class="h-align end-to-end"><h2>${e.body}</h2><p class="very-dull"><small>${delivered > 1? delivered + '  Days Ago':delivered + '  Day Ago'}</small></p></span>
    </div>
`
                    });
                    mainDiv.innerHTML = `
            <div class="messages spacing overlay-scroll">
    <h2 class="purple-text">Messages</h2>
                ${output}
</div>
            `

                })

        }
    </script>
    <script>
        const userName = document.getElementById("user-name")
        const userEmail = document.getElementById("user-email")
        const addUser = document.querySelector(".add-user")

        function userform() {
            if (!((userEmail.value).includes('@'))) {
                userEmail.classList.add("error")
                userEmail.value = 'please input a valid email'
                event.preventDefault()
            }
            if (!((userName.value).length > 0)) {
                userName.classList.add("error")
                userName.value = 'you provided less characters for the username'
                event.preventDefault()
            }


        }

        function removeusererrror() {
            userEmail.classList.remove("error")
            userName.classList.remove("error")
        }
        /*    function hideAdduser(){
               addUser.classList.remove("showAddUser")
           } */
        function showAdduser() {
            addUser.classList.toggle("showAddUser")
        }
    </script>
    <script>
        function mailform() {
            const RName = document.getElementById("reciever-name")
            const pobox = document.getElementById("po-box")
            const contact = document.getElementById("contact")

            if ((RName.value).length < 4) {
                RName.value = "you provided few characters"
                RName.classList.add("error")
                event.preventDefault()

            }
            if ((pobox.value).length < 4) {
                pobox.value = "please provide more than 10 characters"
                pobox.classList.add("error")
                event.preventDefault()
            }
            if ((contact.value).length < 10) {
                contact.value = "please provide more than 10 characters"
                contact.classList.add("error")
                event.preventDefault()
            } else {

            }

        }

        function removeError() {
            const RName = document.getElementById("reciever-name")
            const pobox = document.getElementById("po-box")
            const contact = document.getElementById("contact")
            RName.classList.remove("error")
            pobox.classList.remove("error")
            contact.classList.remove("error")
        }

        function addmail() {
            let add = document.querySelector(".add-mail")
            add.classList.toggle("transformMail")
        }
        let sidebarHide = document.querySelector(".sidebar")
        const body = document.querySelector("body")

        function hideSidebar() {
            body.classList.toggle("sidebar-hide")
            sidebarHide.style.opacity = '0'
            alert('Double click anywhere to show the navigation')

        }
        /*     let navbar = document.querySelector(".navbar")
            navbar.addEventListener("click", ()=>{
               body.classList.remove("sidebar-hide")
               sidebarHide.style.opacity = '1'
            }) */
        window.addEventListener("dblclick", () => {
            body.classList.remove("sidebar-hide")
            sidebarHide.style.opacity = '1'
        })

        function getUsername() {
            const username = document.getElementById("adminname")
            const userad = document.getElementById("userad")
            fetch('./adminusername.php')
                .then((res) => res.json())
                .then((data) => {
                    username.textContent = data
                    userad.textContent = data
                })
        }

        function logout() {
            var ask = confirm("Are you sure you want to Logout")
            if (ask) {
                window.location = 'adminlogout.php'
            }
        }




        window.addEventListener("DOMContentLoaded", () => {
            fetchuserdata()
            drawDoughnut()
            drawLine()
            getUsername()

        })
    </script>
</body>

</html>