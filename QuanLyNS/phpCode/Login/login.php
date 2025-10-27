    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <style>
            body {
                background-color: lightgreen;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                flex-direction: column;
                overflow: hidden;
            }  
            div {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }
            label {
                width: 100px;
                text-align: left;
                margin-right: 10px;
            }
            input {
                width: 200px;
            }
            button {
                margin-right: 10px;
            }
            [name="buttons"] {
                justify-content: center;
            }
        </style>
        <script>
            function checkLogin(event){
                const username = document.f1.textBox.value;
                const password = document.f1.password.value;
                if(isEmpty(username) && isEmpty(password)){
                    showError("Vui lòng nhập đầy đủ thông tin trước khi đăng nhập!");
                    document.f1.textBox.focus();
                    event.preventDefault();
                    return false
                }
                else if(isEmpty(username)){
                    showError("Vui lòng nhập tài khoản!");
                    document.f1.textBox.focus();
                    event.preventDefault();
                    return false
                }
                else if(isEmpty(password)){
                    showError("Vui lòng nhập mật khẩu!")
                    document.f1.password.focus()
                    event.preventDefault();
                    return false
                }
                return true
                // else {
                //     showError("Đăng nhập thành công!")
                //     return true
                // }
            }
            function isEmpty(val){
                return !val || val.trim() === "";
            }
            function showError(msg){
                alert(msg);
            }
        </script>
    </head>
    <body>
        <h1>Login</h1>
        <form action="xuliLogin.php" name="f1" onsubmit="return checkLogin(event)" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" name="textBox">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            <div name="buttons">
                <button type="submit">OK</button>
                <button type="reset">Reset</button>
            </div>
        </form>
        
    </body>
    </html>
