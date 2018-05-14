<html>
    <head>
        <title>Login System</title>
    </head>
 
    <body>
        <%
        String username=(String)session.getAttribute("username");
        
        //redirect user to login page if not logged in
        if(username==null){
            response.sendRedirect("index.jsp");
        }
        %>
    
        <p>Welcome <%=username%></p>   
        <a href="logout.jsp">Logout</a>
        <a href="post.jsp">Post Service</a>
        <a href="servicereq.jsp">Show Service Requests</a>
        <a href="show-accepted-req.jsp">Show Accepted Requests</a>
    </body>
</html>