//-----------------------------------------------login page call------------------------------------------------------
exports.login = function(req, res){
   var message = '';
   var sess = req.session; 

   if(req.method == "POST"){
      var post  = req.body;
      var name= post.user_name;
      var pass= post.password;
     
      var sql="SELECT username, fName, lName, username, typeAccount FROM `account` WHERE BINARY `username`='"+name+"' and password = '"+pass+"'";                             
      db.query(sql, function(err, results){      
         if(results.length && results[0].typeAccount.toString() == 'customer'){
            req.session.userId = results[0].username;
            req.session.user = results[0];
            console.log(results[0].id);
            res.redirect('/home/dashboard');
         }
         else{
            message = 'Wrong Credentials.';
            res.render('index.ejs',{message: message});
         }
                 
      });
   } else {
      res.render('index.ejs',{message: message});
   }
           
};
//-----------------------------------------------dashboard page functionality----------------------------------------------
           
exports.dashboard = function(req, res, next){
           
   var user =  req.session.user,   
   userId = req.session.userId;
    console.log('dddd='+user);
   console.log('ddd='+userId);
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT username, fName, lName, contactNum, username, password FROM `account` WHERE `username`='"+userId+"'";

   db.query(sql, function(err, results){
      res.render('dashboard.ejs', {user:user});    
   });       
};
//------------------------------------logout functionality----------------------------------------------
exports.logout = function(req,res){
   req.session.destroy(function(err) {
      res.redirect("/login");
   })
};
//--------------------------------render user details after login--------------------------------
exports.profile = function(req, res){

   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT username, fName, lName, contactNum, username, password FROM `account` WHERE `username`='"+userId+"'";          
   db.query(sql, function(err, result){  
      res.render('profile.ejs',{data:result});
   });
};
//---------------------------------show my services----------------------------------
exports.services = function(req,res){
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT customerID, serviceName, requested, dispatch, image, noOfDays, returned, status from customer inner join customer_service using (customerID) WHERE `customerID`='"+userId+"'";      
   db.query(sql, function(err, results){
      res.render('services.ejs',{data:results});
   });
};
//---------------------------------Before Subscribe services----------------------------------
exports.beforesubscribe = function(req,res){
//    console.log('hahha');
    var message = '';
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }
    
//   res.render('beforesubscribe.ejs');
    
   if(req.method == "POST"){
      var post  = req.body;
      var serviceId= post.serviceId;
     
      var sql="SELECT * from service inner join sp using(spID) inner join account on spID = username WHERE `serviceID`='"+serviceId+"'";                             
      db.query(sql, function(err, results){      
         if(results.length>0){
             message = serviceId;
            res.render('subscribe.ejs', {data:results});
             
         }
         else{
            message = 'NO HJKHGJIH';
            res.render('beforesubscribe.ejs',{message: message});
         }
                 
      });
   } else {
      res.render('index.ejs',{message: message});
   }         
};
//---------------------------------Subscribe services----------------------------------
exports.subscribe = function(req,res){
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
      var sql="SELECT * from service inner join sp using(spID) inner join account on spID = username WHERE `serviceID`='"+serviceId+"'";                             
      db.query(sql, function(err, results){      
         if(results.length){
            console.log('DONE :) <3 <3 <3');
            res.send('donedfs');
            
         }
         else{
            message = 'NO HJKHGJIHJ';
            res.render('beforesubscribe.ejs',{message: message});
         }
                 
      });
    }
};