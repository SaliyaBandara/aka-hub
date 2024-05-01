<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorChat");
$calendar = new CalendarComponent();
?>
<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">

            <!-- ===VIRAJITH=== -->


            <div class="main-container">
                <div class="wrapper-user">
                    <section class="users">
                        <!-- <div class="search">
                            <span class="text">Select an user to start chat</span>
                            <input type="text" placeholder="Enter name to search...">
                            <button><i class='bx bx-search-alt-2'></i></button>
                        </div> -->
                        <div class="users-list" id="userList">

                        </div>
                    </section>

                </div>
                <div class=" wrapper-chat">
                    <section class="chat-area" id="chat-area" style="opacity: 0">
                        <div class="header">
                            <!-- <header>
                                <img src="https://www.davidchang.ca/wp-content/uploads/2020/09/David-Chang-Photography-Headshots-Toronto-61-1024x1024.jpg" alt="">
                                <div class="details">
                                    <span>Virajith Dissanayaka</span>
                                    <p>Active Now</p>
                                </div>
                            </header> -->
                        </div>
                        <div class="chat-box">
                            <!-- <div class="chat outgoing">
                                <div class="details">
                                    <p>Hello, How can I help you today?</p>
                                </div>
                            </div>
                            <div class="chat incoming">
                                <img src="https://www.davidchang.ca/wp-content/uploads/2020/09/David-Chang-Photography-Headshots-Toronto-61-1024x1024.jpg" alt="">
                                <div class="details">
                                    <p>Hello, I need help with my assignment</p>
                                </div>
                            </div>
                            <div class="chat outgoing">
                                <div class="details">
                                    <p>Okay, I can help you with that. Please provide me with the details</p>
                                </div>
                            </div> -->
                        </div>
                        <form action="#" class="typing-area">
                            <input type="text" id="messageInput" placeholder="Type a message here...">
                            <button type="submit"><i class='bx bxl-telegram'></i></button>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="calendarContainor">
                <?php echo $calendar->render(); ?>
            </div>
        </div>
    </div>

    <style>
        .main-grid .left {
            width: 75% !important;
            height: 150vh;

        }

        .main-grid .right {
            flex-grow: 1;
            height: 150vh;
        }

        .threeCardDiv {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            height: 175px;
            width: 100%;
            z-index: +5;
            color: white;
            padding: 25px;
        }

        .cardTotalUsers {
            width: 27%;
            height: 100%;
            background-color: #2684FF;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            text-align: center;
            display: flex;
            margin-left: 50px;
        }

        .cardTotalUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .cardActiveUsers {
            width: 27%;
            height: 100%;
            background-color: #ff9b2d;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .cardActiveUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .cardNewUsers {
            width: 27%;
            height: 100%;
            background-color: #2684FF;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            margin-right: 50px;
            display: flex;
        }

        .cardNewUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .divUsersContainor {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            /* Display cards vertically */
        }

        .card {
            width: 100%;
            /* Make cards take full width */
            height: 150px;
            width: 550px;
            margin-left: 90px;
            margin-right: 150px;
            background-color: #f0f0f0;
            margin-bottom: 20px;
            /* Increase vertical space between cards */
            padding: 20px;
            box-sizing: border-box;
        }

        .sub-container {
            display: flex;
            flex-direction: row;
            background: #fff;
        }
    </style>
    <style>
        .main-container {
            display: flex;
            flex-direction: row;
            background: #fff;
            width: 85%;
            /* height: 199px ; */
            border-radius: 16px;
            margin-left: 100px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f7f7f7;
        }

        /* .wrapper {
            display: flex;
            flex-direction: row; 
            background: #fff;
           
            border-radius: 16px;
            box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                        0 32px 64px -48px rgba(0,0,0,0.5);
        } */
        .wrapper-user {
            width: 50%;
        }

        .wrapper-chat {
            width: 60%;
            background: #f3f3f3;
            border-radius: 16px;
        }

        /* SignUp form CSS code */
        .form {
            padding: 25px 30px;
        }

        .form header {
            font-size: 25px;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
        }

        .form form {
            margin: 20px 0;
        }

        .form form .error-txt {
            color: #721c24;
            background: #f8d7da;
            padding: 8px 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #f5c6cb;
        }

        .form form .name-details {
            display: flex;
        }

        form .name-details .field:first-child {
            margin-right: 10px;
        }

        form .name-details .field:last-child {
            margin-left: 10px;
        }

        .form form .field {
            display: flex;
            position: relative;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .form form .field label {
            margin-bottom: 2px;
        }

        .form form .field input {
            outline: none;
        }

        .form form .input input {
            height: 40px;
            width: 100%;
            border: 1px solid #ccc;
            padding: 0 10px;
            font-size: 16px;
            border-radius: 5px;
        }

        .form form .image input {
            font-size: 17px;
        }

        .form form .button input {
            margin-top: 13px;
            height: 45px;
            border: none;
            font-size: 17px;
            font-weight: 400;
            background: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .form form .field i {
            position: absolute;
            right: 15px;
            color: #ccc;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .form .link {
            margin: 10px 0;
            text-align: center;
            font-size: 17px;
        }

        .form .link a {
            color: #333;
        }

        .form .link a:hover {
            text-decoration: underline;
        }

        /* Users area CSS */
        .users {
            padding: 25px 30px;
        }

        .users .header {
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            justify-content: space-between;
            text-decoration: none;
            border-bottom: 1px solid #e6e6e6;
        }

        .users-list a {
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            justify-content: space-between;
            text-decoration: none;
            border-bottom: 1px solid #e6e6e6;
        }

        .wrapper-user img,
        .wrapper-chat img {
            object-fit: cover;
            border-radius: 50%;
        }

        :is(.users, .users-list) .content {
            display: flex;
            align-items: center;
        }

        .users .header .content img {
            height: 50px;
            width: 50px;
        }

        :is(.users, .users-list) .details {
            color: #000;
            margin-left: 15px;
        }

        :is(.users, .users-list) .details span {
            font-size: 18px;
            font-weight: 500;
        }

        :is(.users, .users-list) .details p {
            font-size: 15px;
            color: #666;
            margin-top: 3px;
        }

        .users .header .logout {
            color: #fff;
            font-size: 17px;
            padding: 7px 15px;
            background: #333;
            border-radius: 5px;
            text-decoration: none;
            /* margin-left: 1000px; */
        }

        .users .search {
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .users .search {
            margin: 20px 0;
            display: flex;
            position: relative;
            align-items: center;
            justify-content: space-between;
        }

        .users .search .text {
            font-size: 18px;
        }

        .users .search input {
            position: absolute;
            height: 42px;
            width: calc(100% - 50px);
            border: 1px solid #ccc;
            padding: 0 13px;
            font-size: 16px;
            border-radius: 5px;
            outline: none;
        }

        .users .search button {
            width: 47px;
            height: 42px;
            border: none;
            outline: none;
            color: #fff;
            background: #333;
            cursor: pointer;
            font-size: 17px;
            border-radius: 0 5px 5px 0;
        }

        .users-list {
            max-height: 580px;
            overflow-y: auto;
        }

        :is(.users-list, .chat-box)::-webkit-scrollbar {
            width: 0px;
            display: flex;
        }

        .users-list a {
            /* display: inline; */
            margin-bottom: 5px !important;
            page-break-after: 10px;
            padding-right: 15px;
            /* border-bottom-color: #f1f1f1; */
            /* border-bottom:  1px solid #6c6c6c !important; */
            position: relative;
        }

        .users-list a:last-child {
            border: none;
            margin-bottom: 0px;
        }

        .users-list a .content img {
            height: 40px;
            width: 40px;
        }

        .users-list a .content p {
            color: #67676a;
        }

        .users-list a .status-dot i {
            margin-right: 30px;
        }

        .users-list a .status-dot {
            font-size: 12px;
            color: #468669;
            /* margin-left: 50px; */
            margin-right: 30px;
        }

        .users-list a .status-dot.offline {
            color: #ccc;
        }

        /* Chat area CSS part */
        .chat-area header {
            display: flex;
            align-items: center;
            padding: 18px 30px;
            margin-left: -20px;
        }

        .chat-area header .back-icon {
            font-size: 18px;
            color: #333;
        }

        .chat-area header img {
            height: 45px;
            width: 45px;
            margin: 0 15px;
        }

        .chat-area header span {
            font-size: 17px;
            font-weight: 500;
        }

        .chat-box {
            height: 550px;
            overflow-y: auto;
            background: #d9d9d9;
            padding: 10px 30px 20px 30px;
            box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
                inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
        }

        .chat-box .chat {
            margin: 15px 0;
        }

        .chat-box .chat p {
            word-wrap: break-word;
            padding: 8px 16px;
            box-shadow: 0 0 32px rgb(0 0 0 / 8%),
                0 16px 16px -16px rgb(0 0 0 / 10%);
        }

        .chat-box .outgoing {
            display: flex;
        }

        .outgoing .details {
            margin-left: auto;
            max-width: calc(100% - 130px);
        }

        .outgoing .details p {
            background: #333;
            color: #fff;
            border-radius: 18px 18px 0 18px;
        }

        .chat-box .incoming {
            display: flex;
            align-items: flex-end;
        }

        .chat-box .incoming img {
            height: 35px;
            width: 35px;
        }

        .incoming .details {
            margin-left: 10px;
            margin-right: auto;
            max-width: calc(100% - 130px);
        }

        .incoming .details p {
            color: #333;
            background: #fff;
            border-radius: 18px 18px 18px 0;
        }

        .chat-area .typing-area {
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
        }

        .typing-area input {
            height: 45px;
            width: calc(100% - 58px);
            font-size: 17px;
            border: 1px solid #ccc;
            padding: 0 13px;
            border-radius: 5px 0 0 5px;
            outline: none;
        }

        .typing-area button {
            width: 55px;
            border: none;
            outline: none;
            background: #333;
            color: #fff;
            font-size: 19px;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }
    </style>



</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    const searchBar = document.querySelector(".users .search input"),
        searchBtn = document.querySelector(".users .search button"),
        usersList = document.querySelector(".users-list"),
        chatArea = document.querySelector('.chat-area'),
        form = document.querySelector('.typing-area'),
        chatBox = document.querySelector('.chat-box');
        chatHeader = document.querySelector('.header');

        inputField = form.querySelector('.input-field'),
        sendBtn = form.querySelector('button'),

    chatBox.onmouseenter = ()=>{
        chatBox.classList.add("active");
    }
    chatBox.onmouseleave = ()=>{
        chatBox.classList.remove("active");
    }


    setInterval(() => {
        // console.log("hello world!");
        let xhr = new XMLHttpRequest(); //Creating XML object
        xhr.open("GET", "counselorChat/chat_users", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    // console.log(data);
                    usersList.innerHTML = data;
                } else {
                    console.error("Error fetching chat messages: " + xhr.status);
                }
            }
        }
        xhr.send();
    }, 500); 

    let user_id = null;

    function loadChatMessages(userId) {
        setInterval(() => {

            if (user_id != null)
                userId = user_id

            let xhr = new XMLHttpRequest();
            xhr.open("GET", `counselorChat/chat_messages/${userId}`, true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        // Populate the chat-box with the retrieved messages
                        chatBox.innerHTML = data;
                        loadChatHeader(userId)
                        // Scroll to the bottom of the chat-box
                        scrollToBottom();
                    } else {
                        console.error("Error fetching chat messages: " + xhr.status);
                    }
                }
            };
            xhr.send();
        }, 500);
    }

    function loadChatHeader(userId) {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `counselorChat/chat_header/${userId}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatHeader.innerHTML = data;
                    scrollToBottom();
                } else {
                    console.error("Error fetching chat messages: " + xhr.status);
                }
            }
        };
        xhr.send();
    }

  
    $(document).on("click", ".users-list .user-card", function() {
        selectedUserId = $(this).attr("userid");
        console.log("Selected user ID: " + selectedUserId);
        // Load chat messages for the selected user
        loadChatMessages(selectedUserId);
        user_id = selectedUserId;
        $(".chat-area").css("opacity", "1");
    });


    function sendChatMessage(userId, message) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", `counselorChat/insertChatMessages/${userId}`, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Message sent successfully");
                    updateChatMessages();
                } else {
                    console.error("Error sending message: " + xhr.status);
                }
            }
        };
        let data = `message=${encodeURIComponent(message)}`;
        xhr.send(data);
    }

    document.querySelector(".typing-area").addEventListener("submit", function(event) {
        event.preventDefault();
        let messageInput = document.querySelector(".typing-area input[type='text']");
        // console.log(messageInput);
        let message = messageInput.value.trim();
        if (message !== "" && selectedUserId !== null) {
            sendChatMessage(selectedUserId, message);
            messageInput.value = "";
        }
    });

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>