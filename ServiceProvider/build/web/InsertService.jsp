<%-- 
    Document   : InserService
    Created on : May 12, 2018, 7:38:40 AM
    Author     : asus
--%>

<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Insert Service</title>
    </head>
    <body>
        <form action="PostService" method="POST" enctype="multipart/form-data">
            <input type="text" name="servicename" placeholder="Service Name">
            <input type="number" name="price" placeholder="Price">
            <input type="file" name="image">
            <input type="text" name="description" placeholder="Description">
            <input type="text" name="category" placeholder="Category">
            <input type="number" name="spID" placeholder="SP ID">
            <input type="text" name="gender" placeholder="Gender">
            <input type="text" name="age" placeholder="Age">
            <input type="text" name="occasion" placeholder="Occasion">
            <input type="submit" value="Save">
        </form>
    </body>
</html>
