<<<<<<< HEAD
package com;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
 
public class Login {
        
    public static String loginCheck(Accounts account){
     
        try{
            Class.forName("com.mysql.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/rental", "root", "YES");
            PreparedStatement ps=con.prepareStatement("select username, username, password from account where username=? and BINARY password=? and typeAccount = 'sp'");
            ps.setString(1,account.getUsername());
            ps.setString(2,account.getPassword());
            
            ResultSet rs=ps.executeQuery();
            
            if(rs.next()){
                return "true";
            }
            else{
                return "false";
            }
        }catch(Exception e){
            e.printStackTrace();
        }
        
        return "error";
    }
=======
package com;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
 
public class Login {
        
    public static String loginCheck(Accounts account){
     
        try{
            Class.forName("com.mysql.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/rental", "root", "YES");
            PreparedStatement ps=con.prepareStatement("select username, username, password from account where username=? and BINARY password=? and typeAccount = 'sp'");
            ps.setString(1,account.getUsername());
            ps.setString(2,account.getPassword());
            
            ResultSet rs=ps.executeQuery();
            
            if(rs.next()){
                return "true";
            }
            else{
                return "false";
            }
        }catch(Exception e){
            e.printStackTrace();
        }
        
        return "error";
    }
>>>>>>> 2e0d50d2cd695dd3666a67abb1d1eea533a9a0e0
}