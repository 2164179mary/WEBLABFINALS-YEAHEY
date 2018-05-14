<%@page import="sun.misc.BASE64Encoder"%>
<%@page import="javax.imageio.ImageIO"%>
<%@page import="java.awt.image.BufferedImage"%>
<%@page import="com.Service"%>
<%@page import="java.util.ArrayList"%>
<%@page import="java.io.*"%>
<%@page import="java.sql.*"%>
<jsp:useBean id="account" class="com.Accounts" scope="session"/>
<jsp:setProperty name="account" property="*"/>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>

<%
        String imageString = null;
        ByteArrayOutputStream bos = new ByteArrayOutputStream();
        String type = "png";
    try {
        Class.forName("com.mysql.jdbc.Driver");
        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/rental", "root", "");
        PreparedStatement ps = con.prepareStatement("SELECT customerID, serviceID, servicename, "
                + "price, image, description, requested FROM customer_service "
                + "NATURAL JOIN service WHERE spID=? AND status='accepted'");
        ps.setString(1, account.getUsername());
        
        ArrayList<Service> list = new ArrayList<Service>();
        Service service;
        ResultSet rs = ps.executeQuery();
        
        while(rs.next()){
            session.setAttribute("username",account.getUsername());
            service = new Service(rs.getString(1),rs.getString(2),rs.getString(3),rs.getString(4),
                    rs.getBlob(5),rs.getString(6),rs.getString(7));
            list.add(service);            
        }
        
        for(int i=0; i < list.size();i++) {
            out.println("<p>"+list.get(i).getCustomerID()+"</p>");
            out.println("<p>"+list.get(i).getServicename()+"</p>");
            out.println("<p>"+list.get(i).getPrice()+"</p>");
            InputStream in = list.get(i).getImage().getBinaryStream();
            BufferedImage image = ImageIO.read(in);
            ImageIO.write(image, type, bos);
            byte[] imageBytes = bos.toByteArray();

            BASE64Encoder encoder = new BASE64Encoder();
            imageString = encoder.encode(imageBytes);
            out.println("<img src='data:image/png;base64 ,"+imageString+"' alt='Service Image' />");
            out.println("<p>"+list.get(i).getDescription()+"</p>");
            out.println("<p>"+list.get(i).getRequested()+"</p>");
            out.println("<a href='accept-request.jsp'><button>Accept</button></a>");
            out.println("<a href='deny-request.jsp'><button>Deny</button></a>");
            out.println("<hr>");
            session.setAttribute("service",list.get(i).getServiceID());
            session.setAttribute("customer",list.get(i).getCustomerID());
        }
    } catch(Exception e) {
            e.printStackTrace();
    }
%>