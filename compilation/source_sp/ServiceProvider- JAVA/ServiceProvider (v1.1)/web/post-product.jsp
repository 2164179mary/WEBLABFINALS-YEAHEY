<jsp:useBean id="account" class="com.Accounts" scope="session"/>
<jsp:setProperty name="account" property="*"/>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>Post Product</title>
</head>

<body>
    <%
        String username=(String)session.getAttribute("username");
        
        //redirect user to login page if not logged in
        if(username==null){
            response.sendRedirect("index.jsp");
        }
        %>
    <div class="container">
        <div class="content">
            <div class="col-2">
                <div id='cssmenu'>
                    <ul>
                        <li>
                            <p>Hi, <%=username%></p>
                            <a href='logout.jsp'><button class="dashboard" type="submit" name="logout_user"> Logout </button></a>
                        </li><br>
                        <li>
                            <a href="index.jsp" target="_self"><img src="images/alerts.png" alt="Rental Request" width="50px" height="50px" ><br><p>Rental Request</p></a>

                        </li>
                        <li>
                            <a href="post-product.jsp" target="_self" class="active"><img src="images/add-square-button.png" alt="Post New Clothes" width="50px" height="50px"><br><p>Post New Clothes</p></a>
                        </li>
                        <li>
                            <a href="show-accepted-req.jsp" target="_self"><img src="images/clipboard.png" alt="Accepted Transaction" width="50px" height="50px"><br><p>Accepted Transaction</p></a>
                        </li>
                        <li>
                            <a href="dispatched-products.jsp" target="_self"><img src="images/closet.png" alt="Dispatch Clothe" width="50px" height="50px"><br><p>See Dispatched Products</p></a>
                        </li>
                        <li>
                            <a href="transaction.jsp" target="_self"><img src="images/transactions.png" alt="Transaction" width="50px" height="50px"><br><p>Transaction Monitoring</p></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-10">
                <h1 class "center">New Clothes For Rent</h1>
                <form action="PostService" method="POST" enctype="multipart/form-data">
                    <label for="servicename">Service Name:</label>
                    <br>
                    <input type="text" name="servicename" placeholder="Service Name">

                    <br>
                    <label for="price">Price:</label>
                    <br>
                    <input type="number" name="price" placeholder="Price" min='1'>

                    <br>
                    <label for="image">Image:</label>
                    <br>
                    <input type="file" name="image">

                    <br>
                    <label for="description">Description:</label>
                    <br>
                    <textarea name="description" rows="5" cols="50"></textarea>
                    <!--<input type="text" name="description" placeholder="Description">-->

                    <br>
                    <label for="category">Category:</label>
                    <br>
                    <input type="radio" name="category" value="Attire">Attire
                    <br>
                    <input type="radio" name="category" value="Costume">Costume

                    <input type="hidden" name="spID" value="<%=account.getUsername()%>" readonly="readonly">

                    <br>
                    <label for="gender">Gender:</label><br>
                    <input type="radio" name="gender" value="Men">Men
                    <br>
                    <input type="radio" name="gender" value="Women">Women

                    <br>
                    <label for="age">Age:</label><br>
                    <input type="radio" name="age" value="Children">Children
                    <br>
                    <input type="radio" name="age" value="Teen">Teen
                    <br>
                    <input type="radio" name="age" value="Adult">Adult
                    <br>
                    <input type="radio" name="age" value="Senior">Senior

                    <br>
                    <label for="occasion">Occasion:</label><br>
                    <input type="radio" name="occasion" value="Wedding">Wedding
                    <br>
                    <input type="radio" name="occasion" value="Debut">Debut
                    <br>
                    <input type="radio" name="occasion" value="Halloween">Halloween
                    <br>
                    <input type="radio" name="occasion" value="Christmas">Christmas

                    <br>
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>
    </div>

</body>
<html>
