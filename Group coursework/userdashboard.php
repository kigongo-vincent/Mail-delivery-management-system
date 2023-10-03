<?php
session_start();
if(!isset($_SESSION['staffID'])){
    header('Location: userlogin.html');
}
else{
  try {
    include 'connect.php';
    $id = $_SESSION['staffID'];
    $query3 = mysqli_query($conn, "select * from mail where mail_status = 0");
    $query4 = mysqli_query($conn, "select * from mail where mail_status = 1 and staffID = '$id'");
    $undelivered = 0;
    $delivered = 0;
    while($row = mysqli_fetch_assoc($query3)){
        $undelivered = $undelivered + 1;
    }
    while($row = mysqli_fetch_assoc($query4)){
        $delivered = $delivered + 1;
    }
  } catch (\Throwable $th) {
    //throw $th;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'poppins';
        font-weight: normal;
        transition: .2s;

    }

    :root {
        --light: white;
        --semi-light: rgb(209, 226, 241);
        --grey: grey;
        --blue: #36A7FD;
        --purple: #824AFE;
    }

    .icons {
        width: 20px;
        margin:0px 20px;
    }

    body {
        height: 100vh;
        display: grid;
        background-color: var(--semi-light);
        grid-template-columns: .5fr 1fr 1fr;
        grid-template-rows: .1fr .2fr .7fr;
        gap: 10px;
        padding-bottom: 0;
        padding-right: 20px;
        overflow: hidden;
    }

    .sidebar {
        grid-row: 1/5;
        grid-column: 1/2;
        height: 100vh;
        color: aliceblue;
        position: relative;
        background-color: #202342;
    }

    .search-bar {
        width: 100%;
        padding: 5px 30px;
        border-radius: 5px;
        background-color:aliceblue;
        box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.03), -10px -10px 15px rgba(0, 0, 0, 0.041);


    }
    .search-bar input{
        border: none;
    }

    .shadow {
        box-shadow: 10px 10px 15px rgba(0, 0, 0, .1), -10px -10px 15px rgba(0, 0, 0, .1);
    }

    .center-v {
        display: flex;
        align-items: center;
    }

    .center-h {
        display: flex;
        justify-content: center;
    }

    .search {
        grid-column: 2/4;
        height:80%;
        
        align-self: center;
    }

    .main {
        grid-column: 2/4;
    }

  /*   .last {
        background-color: #343965;
        box-shadow: -10px -10px 15px rgba(64, 58, 255, 0.138);
        grid-column: 2/4;
        color: aliceblue;
        height: 80%;
        padding: 10px 30px;
    } */

/*     .h5 {
        font-size: .9rem;
        opacity: .6;
    } */

    .input {
        background: transparent;
        border: none;
        width: 90%;
        height: 40px;
        outline: none;
        color: grey
    }

    .purple {
        background-color:var(--blue);
        width: 50%;
                height: 90%;
                
    }

    .blue {
        background-color:var(--purple);
        width: 50%;
        height: 90%;
        transform: translateX(-100%);
    }

    .round {
        border-radius: 5px;
    }



    .trim {
        overflow: hidden;
    }

    .main {
        position: relative;
        border-radius: 3px;
    }


    .purple-text {
        color: var(--purple);
    }

    .icon {
        height: 15px;
        opacity: .5;
    }

    .about h4 {
        margin: 20px 0;
    }

    .company {
        width: 400px;
        display: flex;
        flex-direction: column;
        align-items: start;
        height: 120px;
        justify-content: space-around;
    }

    .delivered {
        padding: 10px 30px;
        color: aliceblue;
    }

    .delivered p {
        opacity: .8;
        font-size: .9rem;
    }

    small {
        opacity: .5;
        margin-right: 20px;
    }

    .input::placeholder {
        opacity: .5;
    }

    .profile img {
        width: 100px;
    }

    .profile {
        left: 50%;
        position: absolute;
        transform: translateX(-50%);
        top: 10%;
        text-align: center;
    }

    .img-container {
        width: 100px;
        height: 100px;
        border-radius: 100%;

        background-color: slateblue;
    }

    #user {

        margin: 20px 0;
        opacity: .6;
        font-size: 1rem;
    }

    .menu {
        position: absolute;
        top: 40%;
        left: 50%;
        width: 70%;
        transform: translateX(-50%);
    }

    .menu ul {
        list-style: none;
    }

    .menu ul li {
        display: flex;
        padding: 20px 0;
        
    }

    .menu ul li:hover {
        opacity: .7;
        cursor: pointer;
    }

    #title {
        position: absolute;
        top: 20px;
        color: #36a7fddb;
        left: 30px;
    }

    .mails {
        position: absolute;
        height: 100%;
        width: 100%;
        overflow-y: scroll;
    }
    .mails::-webkit-scrollbar{
            opacity:0;
    }

    .mail {
        background-color:aliceblue;
        display: flex;
        padding: 20px;
        color: #202342;
        display: flex;
        align-items: center;
        height: 20px;
        position: relative;
        font-size: .9rem;
        margin: 1px 0;

    }

    .mail:nth-of-type(1) {
        background-color: aliceblue;
        color: #36A7FD;
        font-weight: 1rem;
        position:sticky;
        border-radius: 100px;
        margin-bottom: 10px;
        top: 0;
        
    }

    .mark {
        left: 75%;
        position: absolute;
        border: none;
        background: transparent;
        color:#36A7FD;
        padding: 12px 50px;
        border-radius: 4px;
        border: 1px solid #36A7FD;
    }
    .mark:hover{
        background-color: #36A7FD;
        color: aliceblue;
        border: none;
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
        .mails::-webkit-scrollbar{
            opacity: 0;
        }
        .delete-confirm{
            background-color:aliceblue;
            position: absolute;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
line-height:2;
font-size:.9rem;
width: 400px;
left: 50%;
top: 50%;
border-radius: 5px;
transform: translate(-50%,-50%);
height: 0px;
overflow: hidden;
box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.112),-10px -10px 15px rgba(0, 0, 0, 0.112);
        }
        .delete-confirm div button{
    border: none;
    color: var(--white);
    padding: 10px 50px;
    border-radius: 4px;
    margin: 10px;
    color: aliceblue;
}
.delete-confirm p{
margin: 8px 0;
}
.delete-confirm div button:nth-of-type(1){
    background-color: #36A7FD;
}
.confirm-show{
    height: 150px;
}
.delete-confirm div button:nth-of-type(2){
    background-color:  #FF4C87;
}
.img{
    width: 130px;
}
.ribbon{
    width: 130px;
    height: 130px;
    border-radius: 100%;
    overflow: hidden;
    margin-right: 40px;
}
.profile-pic{
    overflow: hidden;
    border-radius: 100%;
    height: 130px;
    width: 130px;
    background-color: slateblue;
    border-radius: 7px;
}
.profile-data{
    color: #202342;
    line-height: 2;
    display: flex;

    align-items: center;
    background-color: aliceblue;
    height: 300px;
    width: 50%;
    padding: 0px 50px;
    border-radius: 10px;
    box-shadow: 10px 10px 20px rgba(91, 81, 227, 0.05), 10px 10px 20px rgba(91, 81, 227, 0.05);
}
.details p{
    line-height: 2;
    opacity: .8;
}
.details p:nth-of-type(1){
   font-size: 1.5rem;
   font-weight: bolder;
   opacity: 1
}
.error{
    border-color: #FF4C87;
    color: #FF4C87;
}
.no-error{
    border:1px solid #36A7FD;
    color: #36A7FD;
}
table{
    background-color: aliceblue;
    color: #202342;
    border-radius: 10px;
    position: absolute;
    padding: 50px 30px;
    top: 0;
    z-index: 10;
    padding:30px;
   font-size: .9rem;
    box-shadow: 10px 10px 15px rgba(33, 31, 82, 0.064),-10px -10px 15px rgba(51, 48, 150, 0.041);
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: none;
    

}
.show-table{
    display: block;
}

.input{
    border: 1px solid #84848481;
    width: 100%;
    height: 35px;
    border-radius: 3px;
    padding: 0 10px;
    margin: 4px 0;
}
.input:focus {
            border-color: #36A7FD;
}
input[type = date]{
    width: 88%;
}
input[type=file]::-webkit-file-upload-button {
            background-color: var(--blue);
            width: 100%;
            height: 35px;
            border: none;
            border-radius: 4px;
            color: var(--white);
            color: aliceblue;
        }
        .extra{
            width: 250px;
        }
        input[type = text], input[type =email]{
            width: 250px;
        }
        input[type = submit],input[type = reset]{
            border: none;
            height: 35px;
            width: 100%;
            background-color: #36A7FD;
            color: aliceblue;
            
        }
        input[type = reset]{
            background-color: #FF4C87;
        
        }
        .messages h3{
        color: #824AFE;
    }
        .img-message{
            height: 60px;
            width: 60px;
            overflow: hidden;
            border-radius: 100%;
            margin-right: 20px;
        }
        .img-message img{
            width: 60px;
        }
        .title{
            display: flex;
            align-items: center;
        }
        .message{
            height: 150px;
            width: 100%;
            display: flex;
            align-items: center;
            overflow-x: scroll;
            padding: 10px;
            overflow-y: hidden;
            margin-bottom: 20px;
        }
        .message::-webkit-scrollbar{
            opacity: 1;
        }

        .message::-webkit-scrollbar-track-piece{
            background-color: var(--semi-light);


        }
        .message::-webkit-scrollbar-thumb{
            background-color: aliceblue;
            border-radius: 100px;
        }
        
        
        .time{
            opacity: .6;
            font-size: .8rem;
            text-align: left;
        }
        .messages{
          padding: 20px 50px;
        }
        .header{
            margin-right: 30px;
        }
        .details-message p:last-child{
            opacity: .5;
            line-height: 2;
        }
        .msg-text{
            display: flex;
            flex-direction: column;
            width: 200px;
            flex-wrap: wrap;
            overflow: hidden;
        }
        .msg-body{
            background-color: aliceblue;
            min-height: 100px;
            min-width: 300px;
            padding:20px;
            margin: 8px;
            border-radius: 4px;
            justify-content: space-around;
            display: flex;
            overflow-y: hidden;
            flex-direction: column;
        }
        .space-between{
            margin: 20px 0;
        }
        .message-compose{
            background-color: aliceblue;
            width: 400px;
            height: 40px;
            overflow: hidden;
            border-radius: 100px;
            position: relative;
        }
        .message-compose input{
            left: 0;
            height: 100%;
            border: none;
            color: rgb(27, 27, 27);
            width: 70%;
            position: absolute;
            outline: none;
            background: transparent;
            padding-left: 20px;
        }
        .message-compose button{
            position: absolute;
            height: 100%;
            right: 0;
            border: none;
            background-color:slateblue;
            color: aliceblue;
            padding: 2px 20px;
        }
        :not(input){
                cursor:  pointer;
            }
            .ct{
                transform: translateX(-50%);
                position: absolute;
                left: 50%;
                top: 40%;
                color: aliceblue;
                text-shadow: 3px 3px 6px rgba(0,0,0,.2)

            }
            .v{
                color: slateblue;
                text-shadow: none;
                opacity: .5;
            }
</style>

<body>
    <div class="sidebar ">
        <p id="title">PAVILIONEE</p>
        <div class="profile">
            <div class="img-container trim">
                <img src="./upload/<?php echo $id?>.jpg" alt="">
            </div>
            <p id="user"></p>
        </div>
        <div class="menu">
            <ul>
                <li onclick="getUser()">
                    <img src="./images/user.svg" alt="" class="icons">
                    <p>My profile</p>
                </li>
                <li onclick="fetchMails()"><img src="./images/envelope.svg" alt="" class="icons">
                    <p>Mails</p>
                </li>
                <li onclick="editprofile()">
                    <img src="./images/settings.svg" alt="" class="icons">
                    <p>Account settings</p>
                </li>
                <li onclick="getMessages()">
                    <img src="./images/inbox.svg" alt="" class="icons">
                    <p>Messages</p>
                </li>
                <li onClick ='logout()'>
                    <img src="./images/mono-exit.svg" alt="" class="icons">
                    <p>Sign Out</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="search center-h">
        <div class="search-bar center-v">
            <img src="./images/search.svg" alt="" class="icons">
            <input type="text" class="input" placeholder="Search for mails by name of reciever"
            oninput="searchResults()" id="search"
            >
        </div>
    </div>
    <div class="purple round hidden center-v">
        <div class="delivered img-back">
            <h1>
                <?php echo $delivered ?>.00
            </h1>
            <p>Personally delivered Mail(s)</p>
        </div>
    </div>
    <div class="blue  round center-v">
        <div class="delivered img-back">
            <h1>
            <?php echo $undelivered ?>.00
            </h1>
            <p>Pending Mails</p>
        </div>
    </div>
    <div class="main trim">
       
    </div>
    
    <div class="delete-confirm">
     
    </div>
    <form class="edit-profile" action="updateuser.php" enctype="multipart/form-data" method="post" onsubmit="updateform()">
        <table cellspacing='10'>
            <tr>
                <td>
                    username
                </td>
                <td>
                    <input type="text" class="input extra" placeholder="insert username" name='staffname'id = 'username'>
                </td>
                <td>
                    Date Of Birth
                </td>
                <td>
                    <input type="date" class="input" name="staffdob" id="dob">
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="email" class="input extra" name="staffemail" id="email">
                </td>
                <td colspan="2">Select a profile picture (optional)</td>
            </tr>
            <tr>
                <td>
                    New password
                </td>
                <td>
                    <input type="password" class="input extra" id="pass" name="staffpass">
                </td>
                <td colspan="2"><input type="file" name="upload"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><input type="text" class="input extra" name="staffgender" id="gender"></td>
                <td><input type="submit" id="submit" value="save" name="submit" class="purple zero-border"></td>
                <td><input type="reset" value="Cancel" class="zero-border red" id="cancel"></td>
            </tr>

        </table>
     </form>
    <script>
        let deleteConfirm = document.querySelector(".delete-confirm")
          function confirmDelete(){
            let mail_id =event.target.id
            deleteConfirm.classList.add('confirm-show')
            deleteConfirm.innerHTML =  `
            <p>Confirm Mail Delivery</p>
      <div>
        <button id = ${mail_id} onClick = "mail()">Confirm</button><button onclick="kill()">Cancel</button>
            `
        }
        function mail(){
            let bdata = {
            id: event.target.id
        }
        fetch('editdata.php', {
            method: 'POST',
            body: JSON.stringify(bdata),
            headers:{
                'Content-type':'application/json'
            }
        })
        .then((res)=>res.json())
        .then((data)=>{
            alert(data)
            window.location = 'userdashboard.php'
        })
        }
        function kill(){
            deleteConfirm.classList.remove('confirm-show')
        }
        const main = document.querySelector('.main')
        let uName = document.getElementById('user')
        function getUser(){
            fetch('fetchstaffprofile.php')
            .then((res) => res.json())
            .then(data =>{
                main.innerHTML =`
            <div class="profile-data">
                <div class="ribbon">
                 <div class="profile-pic">
                   <img src="upload/<?php echo $id?>.jpg" alt="" class = 'img'>
                 </div>
                </div>
            <div class="details">
                <p>${data[0]}</p>
            <p class="spacing">${data[2]}</p>
            <p>${data[1] ? 'Born, ' + data[1] : 'NOT AVAILABLE'}</p>
            <p>${data[3] ? data[3]: 'NOT AVAILABE'}</p>
            </div>
                </div>
            `
            })
            
        }
        function getUsername(){
            fetch('fetchstaffprofile.php')
            .then((res) => res.json())
            .then(data =>{
              let uname = document.getElementById('user')
              uname.textContent = data[0]
            })
            
        }
    </script>
    <script>
          ///validate update form
         
        function updateform(){
            const uname = document.getElementById('username')
        const password = document.getElementById('pass')
        const email = document.getElementById('email')
        const dob = document.getElementById('dob')
        const gender = document.getElementById('gender')
            if((uname.value).length < 3){
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
            const uname = document.getElementById('username')
        const password = document.getElementById('pass')
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
        
function editprofile(){
    const edit = document.querySelector("table")
    edit.classList.toggle("show-table")
}
function getMessages(){
    fetch('mymessages.php')
    .then((res)=>res.json())
    .then((data)=>{
       if(data[0].length > 0){
         let output = ''
        data[0].forEach(element => {
            let today =new Date().getTime()
                let sent = new Date(element.date).getTime()
                
                let delivered = Math.floor((today - sent)/(3600 * 1000 *24))
                if(delivered <= 0){
                    delivered = 'Less than one '
                }
            output += `
            <div class="msg-body">
                        <p class="msg-text">
                           ${element.body}
                        </p>
                        <p class="time">
                        ${delivered > 1? delivered + '  Days Ago':delivered + '  Day Ago'}
                        </p>
                    </div>
            `
        });
        main.innerHTML = `
    <div class="messages">
        <div class="content">
            <div class="header">
                <h3 class="space-between">All Messages To</h3>
                <div class="title space-between">
                    <div class="img-message">
                        <img src="./upload/0.jpg" alt="">
                    </div>
                    <div class="details-message">
                        <p>${data[1]}</p>
                        <p>${data[2]}</p>
                    </div>
                </div>
              
                <div class="message">
                   ${output}
                </div>
            </div>
        </div>
        <div class="compose">
            <div class="message-compose">
                <input type="text" id = 'staffmessage'>
                <button class="send" onClick = 'send()'>send Message</button>
            </div>
        </div>
    </div>
    `
       }
       else{
        main.innerHTML = `
    <div class="messages">
        <div class="content">
            <div class="header">
                <h3 class="space-between">All Messages To</h3>
                <div class="title space-between">
                    <div class="img-message">
                        <img src="./upload/0.jpg" alt="">
                    </div>
                    <div class="details-message">
                        <p>${data[1]}</p>
                        <p>${data[2]}</p>
                    </div>
                </div>
              
                <div class="message">
                  <p>You Haven't sent any messages to the Administrator</p>
                </div>
            </div>
        </div>
        <div class="compose">
            <div class="message-compose">
                <input type="text" id = 'staffmessage'>
                <button class="send" onClick = 'send()'>send Message</button>
            </div>
        </div>
    </div>
    `
       }
    })
   
}
function send(){
    const input = document.getElementById('staffmessage').value
    if(input.length > 0){
            
    let msg = {
        sent: input
    }
  
    fetch('sendmessage.php',{
        method: 'post',
        body: JSON.stringify(msg),
        headers: {
            'Content-type': 'application/json'
        }
    })
    .then((res)=> res.json())
    .then((data)=>{
        getMessages()
    })
    }
    else{
        alert('you cannot send empty messages')
    }
}
function fetchMails(){
    setTimeout(()=>{
        fetch('fetchmailz.php')
    .then((res)=>res.json())
    .then((data)=>{
       if(data.length > 0){
        let output = ''

data.forEach((element)=>{
    output += `
    <div class="mail">
        <p>${element.client_name}</p>
        <p>${element.p_o_box}</p>
        <p>${element.date_Added}</p>
        <button class="mark" id = "${element.mailID}" onclick="confirmDelete()">
            Mark Mail
        </button>
    </div>
    `
})
main.innerHTML = `
<div class="mails">
    <div class="mail">
        <p>Name Of Reciever</p>
        <p>P.o box</p>
        <p>Date Added</p>
        <p>Mark mail as delivered</p>
    </div>
   ${output}
</div>
`
       }
       else{
        main.innerHTML = `
<div class="mails">
    <div class="mail">
        <p>Name Of Reciever</p>
        <p>P.o box</p>
        <p>Date Added</p>
        <p>Mark mail as delivered</p>
    </div>
   <h1 class = "ct">No mails to deliver</h1>
</div>
`
       }
    })
}, 10)
 
  
}

function searchResults(){
    let mysearch = document.getElementById("search").value
    const results = {
        search: mysearch
    }

   fetch('search2.php',{
        method: 'post',
        body: JSON.stringify(results),
        headers: {
            'Content-type' : 'application/json'
        }
    })
    .then((res)=>res.json())
    .then((data)=>{
  if(data.length > 0){
    let output = ''
        data.forEach(element => {
            output += `
            <div class="mail">
                <p>${element.client_name}</p>
                <p>${element.p_o_box}</p>
                <p>${element.date_Added}</p>
                <button class="mark" id= "${element.mailID}" onclick="confirmDelete()">
                    Mark Mail
                </button>
            </div>
            `
        });
        
        main.innerHTML = `
    <div class="mails">
            <div class="mail">
                <p>Name Of Reciever</p>
                <p>P.o box</p>
                <p>Date Added</p>
                <p>Mark mail as delivered</p>
            </div>
           ${output}
        </div>
    `
  }
  else{
    main.innerHTML = `${ mysearch.length  > 0 ? '<h2 class = "ct v">'+ mysearch +' currenlty has no pending mail</h2>': ''}`
  }
    })

}
function logout(){
    var ask = confirm('Are you sure you want to logout')
    if(ask){
        window.location = 'userlogout.php'
    }
}
window.addEventListener("DOMContentLoaded", ()=>{
    fetchMails()
    getUsername()
})
    </script>
</body>

</html>