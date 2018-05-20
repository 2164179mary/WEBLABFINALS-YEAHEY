/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com;

import java.io.IOException;
import java.io.InputStream;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import javax.servlet.ServletException;
import javax.servlet.annotation.MultipartConfig;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.Part;

/**
 *
 * @author asus
 */
//@WebServlet("/PostService")
@MultipartConfig(maxFileSize = 20848820)
public class PostService extends HttpServlet {
    
    private String URL = "jdbc:mysql://localhost:3306/rental";
    private String User = "root";
    private String Pass = "";
    
    protected void doPost(HttpServletRequest request,
            HttpServletResponse response) throws ServletException, IOException {
        
        PrintWriter out = response.getWriter();
        
        String servicename=request.getParameter("servicename");
        String price=request.getParameter("price");
        String description=request.getParameter("description");
        String spID=request.getParameter("spID");
        String category=request.getParameter("category");
        String gender=request.getParameter("gender");
        String age=request.getParameter("age");
        String occasion=request.getParameter("occasion");
        
        InputStream inputStream = null;
        String message = null;
        Connection con=null;
        
        Part filePart = request.getPart("image");
        if (filePart != null) {            
            // obtains input stream of the upload file
            inputStream = filePart.getInputStream();
        }
        try {
            DriverManager.registerDriver(new com.mysql.jdbc.Driver());
            con=DriverManager.getConnection(URL, User, Pass);
                        
            String query="INSERT INTO service(serviceName, price, image, "
                    + "description, category, spID, gender, age, occasion) "
                    + "VALUES(?,?,?,?,?,?,?,?,?)";
            PreparedStatement pst = con.prepareStatement(query);
            
            pst.setString(1, servicename);
            pst.setString(2, price);
            pst.setBlob(3, inputStream);
            pst.setString(4, description);
            pst.setString(5, category);
            pst.setString(6, spID);
            pst.setString(7, gender);
            pst.setString(8, age);
            pst.setString(9, occasion);
            
            int row = pst.executeUpdate();
            if (row > 0) {
                out.println("<p>File uploaded and saved into database.</p>");
                response.sendRedirect("index.jsp");
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
            out.print(ex);
        } 
    }
}
