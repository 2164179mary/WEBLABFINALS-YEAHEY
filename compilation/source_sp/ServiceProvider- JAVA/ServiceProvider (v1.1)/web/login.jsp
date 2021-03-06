<!DOCTYPE html>
<html lang="en">

<head>
    <title>Arkila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <link rel="Stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="col-6">
                <img class="photo" alt="logo" src="images/samplePhoto3.jpg">
            </div>
            <div class="col-6">
                <div id="login">
                    <img class="logo-login" alt="logo" src="images/sampleLogo.png">
                    <h4 class="center" id="account">PROPRIETOR</h4>
                    <%
                        String username=(String)session.getAttribute("username");

                        //redirect user to home page if already logged in
                        if(username!=null){
                            response.sendRedirect("index.jsp");
                        }

                        String status=request.getParameter("status");

                        if(status!=null){
                            if(status.equals("false")){
                                   out.print("Incorrect login details!");                       
                            }
                            else{
                                out.print("Some error occurred!");
                            }
                        }
                        %>
                        
                    <form method="post" action="loginRequestHandler.jsp">
                        <input id="user" type="text" name="username" placeholder="username">
                        <input id="password-login" type="password" name="password" placeholder="password">
                        <button id="login-button" type="submit" name="log_in_user"> Login </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
