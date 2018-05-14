<%-- 
    Document   : InserService
    Created on : May 12, 2018, 7:38:40 AM
    Author     : GROUP1
--%>

<jsp:useBean id="account" class="com.Accounts" scope="session"/>
<jsp:setProperty name="account" property="*"/>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Insert Service</title>
        <link rel="icon" type="image/png" href="./images/favicon.ico">
        <link rel="Stylesheet" type="text/css" href="./css/styles.css">
    </head>
    <body>
        <form action="PostService" method="POST" enctype="multipart/form-data">
            <label for="servicename">Service Name:</label>
            <input type="text" name="servicename" placeholder="Service Name">
            
            <br>
            <label for="price">Price:</label>
            <input type="number" name="price" placeholder="Price">
            
            <br>
            <label for="image">Image:</label>
            <input type="file" name="image">
            
            <br>
            <label for="description">Description:</label>
            <input type="text" name="description" placeholder="Description">
            
            <br>
            <label for="category">Category:</label>
            <input type="radio" name="category" value="Attire">Attire
            <input type="radio" name="category" value="Costume">Costume
            
            <br>
            <label for="spID">SP ID:</label>
            <input type="text" name="spID" value="<%=account.getUsername()%>" readonly="readonly">
            
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
    </body>
</html>
