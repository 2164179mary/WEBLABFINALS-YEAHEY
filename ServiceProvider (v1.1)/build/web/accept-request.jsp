<%-- 
    Document   : service-req
    Created on : 05 13, 18, 9:09:52 PM
    Author     : GROUP1
--%>

<%@page import="java.io.*"%>
<%@page import="java.sql.*"%>
<jsp:useBean id="account" class="com.Accounts" scope="session"/>
<jsp:setProperty name="account" property="*"/>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>

<%
    session.setAttribute("username",account.getUsername());
    try {
        Class.forName("com.mysql.jdbc.Driver");
        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/rental", "root", "");
        
        PreparedStatement pst;
        String customer=(String)session.getAttribute("customer");
        String service=(String)session.getAttribute("service");
        pst = con.prepareStatement("UPDATE customer_service NATURAL JOIN service "
                + "SET status='accepted' WHERE spID='"+account.getUsername()+"'"
                        + "AND customerID='"+customer+"' AND serviceID='"+service+"'");
        pst.executeUpdate();
        response.sendRedirect("home.jsp");
        
    } catch(Exception e) {
        e.printStackTrace();
    }         
%>