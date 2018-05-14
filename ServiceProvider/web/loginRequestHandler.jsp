<%@page import="com.Login"%>
<jsp:useBean id="account" class="com.Accounts" scope="session"/>
<jsp:setProperty name="account" property="*"/>
 
<%
String result=Login.loginCheck(account);
 
if(result.equals("true")){
    session.setAttribute("username",account.getUsername());
    response.sendRedirect("home.jsp");
}
 
if(result.equals("false")){
    response.sendRedirect("index.jsp?status=false");
}
 
if(result.equals("error")){
    response.sendRedirect("index.jsp?status=error");
}
 
%>