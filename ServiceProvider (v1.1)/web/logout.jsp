<SCRIPT type="text/javascript">
    window.history.forward();
    function noBack() { window.history.forward(); }
</SCRIPT>
<BODY onload="noBack();"
    onpageshow="if (event.persisted) noBack();" onunload="">
<%
session.invalidate();
response.sendRedirect("index.jsp");
%>
</BODY>