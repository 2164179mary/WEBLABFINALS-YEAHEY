<%-- 
    Document   : service-req
    Created on : 05 13, 18, 9:09:52 PM
    Author     : GROUP1
--%>

<%@page import="java.util.Calendar"%>
<%@page import="java.util.ArrayList"%>
<%@page import="com.Service"%>
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
                
        Calendar now = Calendar.getInstance();
        int day = now.get(Calendar.DAY_OF_MONTH);
        int month = now.get(Calendar.MONTH) + 1;      
        String monthStr = ((month < 10) ? "0" : "") + month;
        int hour = now.get(Calendar.HOUR);
        int minute = now.get(Calendar.MINUTE);
        int second = now.get(Calendar.SECOND);
        String dispatch = (now.get(Calendar.YEAR)+"-"+monthStr+"-"+day+" "+hour+":"+minute+":"+second);
        
        PreparedStatement ps = con.prepareStatement("SELECT customer.customerID, "
                + "CONCAT(fName, ' ', lName), service.serviceID, serviceName, image,"
                + "price, description, requested, customer_service.status FROM customer INNER JOIN customer_service ON "
                + "customer.customerID = customer_service.customerID INNER JOIN "
                + "account ON account.username = customer.customerID INNER JOIN "
                + "service ON customer_service.serviceID = service.serviceID WHERE "
                + "spID = ? AND customer_service.status = 'accepted'");
        ps.setString(1, account.getUsername());

        ArrayList<Service> list = new ArrayList<Service>();
        Service service;
        ResultSet rs = ps.executeQuery();

        while (rs.next()) {
            service = new Service(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4),
                    rs.getBlob(5), rs.getString(6), rs.getString(7), rs.getString(8), rs.getString(9));
            list.add(service);
        }
        
        String customer=(String)list.get(Integer.parseInt(request.getParameter("serviceID"))).getCustomerID();
        String serviceID=(String)list.get(Integer.parseInt(request.getParameter("serviceID"))).getServiceID();
        String advancepayment = request.getParameter("advancepayment"); 
        ps = con.prepareStatement("UPDATE customer_service NATURAL JOIN service "
                + "SET dispatch='"+dispatch+"', status='dispatched' WHERE spID='"+account.getUsername()+"'"
                        + "AND customerID='"+customer+"' AND serviceID='"+serviceID+"'");
        ps.executeUpdate();
        
        response.sendRedirect("show-accepted-req.jsp");
        
    } catch(Exception e) {
        e.printStackTrace();
    }         
%>