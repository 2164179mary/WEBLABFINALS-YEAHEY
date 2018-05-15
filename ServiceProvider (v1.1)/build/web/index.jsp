<%@page import="com.Service"%>
<%@page import="java.util.ArrayList"%>
<%@page import="java.io.*"%>
<%@page import="java.sql.*"%>
<jsp:useBean id="account" class="com.Accounts" scope="session"/>
<jsp:setProperty name="account" property="*"/>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
         pageEncoding="ISO-8859-1"%>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>Menu</title>
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
                            <a href="index.jsp" target="_self" class="active"><img src="images/alerts.png" alt="Rental Request" width="50px" height="50px" ><br><p>Rental Request</p></a>

                        </li>
                        <li>
                            <a href="post-product.jsp" target="_self"><img src="images/add-square-button.png" alt="Post New Clothes" width="50px" height="50px"><br><p>Post New Clothes</p></a>
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
            <%
                session.setAttribute("username", account.getUsername()); 
                try {
                    Class.forName("com.mysql.jdbc.Driver");
                    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/rental", "root", "");
                    PreparedStatement ps = con.prepareStatement("SELECT customer.customerID, "
                            + "CONCAT(fName, ' ', lName), service.serviceID, serviceName, image,"
                            + "price, description, requested, customer_service.status FROM customer INNER JOIN customer_service ON "
                            + "customer.customerID = customer_service.customerID INNER JOIN "
                            + "account ON account.username = customer.customerID INNER JOIN "
                            + "service ON customer_service.serviceID = service.serviceID WHERE "
                            + "spID = ? AND customer_service.status = 'pending'");
                    ps.setString(1, account.getUsername());

                    ArrayList<Service> list = new ArrayList<Service>();
                    Service service;
                    ResultSet rs = ps.executeQuery();

                    while (rs.next()) {
                        service = new Service(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4),
                                rs.getBlob(5), rs.getString(6), rs.getString(7), rs.getString(8), rs.getString(9));
                        list.add(service);
                    }
                    if(list.size() == 0){
                        out.println("<h1>No Pending Rentals</h1>");}
                    else{
                    
                    String[] str = new String[list.size()-1];%>
                    <div class="col-10 center">
                            <h1>List of Pending Rentals</h1>
                            <table class="pending-rental">
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Service Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Date Requested</th>
                                    <th>Status</th>
                                </tr>
                                <%    }
                    for (int i = 0; i < list.size(); i++) {%> 
                                <tr>
                                    <td><%=list.get(i).getCustomerName()%></td>
                                    <td><%=list.get(i).getServicename()%></td>
                                    <td><%=list.get(i).getPrice()%></td>
                                    <td><%=list.get(i).getDescription()%></td>
                                    <td><%=list.get(i).getRequested()%></td>
                                    <td class='td-btn'>
                                        <a href='accept-request.jsp?serviceID=<%=i%>'><input type="submit" value="Accept"></a>
                                        <a href='deny-request.jsp?serviceID=<%=i%>'><input type="submit" value="Deny">
                                    </td>
                                </tr>
                                <%}%>
                            </table>
                        </div>
                        
               <% } catch (Exception e) {
                    e.printStackTrace();
                }
            %>
            
        </div>
    </div>

</body>
<html>
