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
                            <a href="post-product.jsp" target="_self"><img src="images/add-square-button.png" alt="Post New Clothes" width="50px" height="50px"><br><p>Post New Clothes</p></a>
                        </li>
                        <li>
                            <a href="show-accepted-req.jsp" target="_self" class="active"><img src="images/clipboard.png" alt="Accepted Transaction" width="50px" height="50px"><br><p>Accepted Transaction</p></a>
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
                
                if(list.size() == 0){
                    out.println("<h1>There's no service requests...</h1>");}
                else{
                %>
                <div class='col-10' style='width:60%'>
                    <h1>Accepted Transactions</h1>
                <%    }
                for (int i = 0; i < list.size(); i++) { 
                %>            
                        <table class='showProduct'>
                            <tr>
                                <td>Customer Name</td>
                                <td><%=list.get(i).getCustomerName()%></td>
                            </tr>
                            <tr>
                                <td>Service Name</td>
                                <td><%=list.get(i).getServicename()%></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><%=list.get(i).getDescription()%></td>
                            </tr>
                            <tr>
                                <td>Requested</td>
                                <td><%=list.get(i).getRequested()%></td>
                            </tr>
                        </table>
                        <form method='POST' action='dispatch-product.jsp?serviceID=<%=i%>'>
                            <input type="submit" value='Dispatch Now' style='float:left;'>
                        </form>
                            <br><br><br>
                    <%
                    }
                    %>
                </div>
                <%  
            } catch (Exception e) {
                e.printStackTrace();
            }
            %>
        </div>
    </div>
</body>
</html>

