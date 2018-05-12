<!DOCTYPE html>
<html lang="en">

<head>
    <title>Arkila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/favicon.ico">
    <link rel="Stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="col-6">
                <img class="photo" alt="logo" src="./images/samplePhoto3.jpg">
            </div>
            <div class="col-6">
                <div id="login">
                    <img class="logo-login" alt="logo" src="./images/sampleLogo.png">
                    <h4 class="center" id="account">SERVICE PROVIDER</h4>
                    <%
                    String username=(String)session.getAttribute("username");

                    //redirect user to home page if already logged in
                    if(username!=null){
                        response.sendRedirect("home.jsp");
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
                    <form id="loginform" class="form-horizontal" role="form" method="post" action="loginRequestHandler.jsp">
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                        <button id="btn-login" type="submit" class="btn btn-success" value="Login">Login  </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
