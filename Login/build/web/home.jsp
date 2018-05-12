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
    </body>
</html>