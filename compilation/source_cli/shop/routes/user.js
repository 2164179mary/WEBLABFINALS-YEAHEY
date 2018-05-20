
//==========================| login |=============================
exports.login = function(req, res){
   var message = '';
   var sess = req.session; 

   if(req.method == "POST"){
      var post  = req.body;
      var name= post.user_name;
      var pass= post.password;
                 
      var sql="SELECT username, fName, lName, username, typeAccount FROM `account` inner join customer on username = customerID WHERE BINARY `username`='"+name+"' and password = '"+pass+"' and status = 'accepted'";                             
      db.query(sql, function(err, result){      
         if(result.length && result[0].typeAccount.toString() == 'customer'){
            req.session.userId = result[0].username;
            req.session.user = result[0];

            console.log(result[0].username + " is logged in.");

            res.redirect('/home/dashboard');
         }
         else{
			 console.log('sads');
            message = 'Wrong Credentials.';
            res.render('login.ejs',{message: message});
         }
                 
      });
   } else {
      res.render('login.ejs',{message: message});
   }
           
};

//==========================| DASHBOARD |=============================
exports.dashboard = function(req, res, next){
           
   var user =  req.session.user,   
   userId = req.session.userId;

   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT username, fName, lName, contactNum, username, password FROM `account` WHERE `username`='"+userId+"'";

   db.query(sql, function(err, result){
      res.render('dashboard.ejs', {user:user});    
   });       
};

//==========================| LOGOUT |=============================
exports.logout = function(req,res){
   req.session.destroy(function(err) {
      res.redirect("/");
   })
};

//==========================| PROFILE |=============================
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

//==========================| SHOW SERVICES |=============================
exports.services_attire = function(req,res){
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT serviceID, serviceName, price, image, age FROM service WHERE category='attire'";      
   db.query(sql, function(err, result){
      res.render('services.ejs',{data:result});
   });
};

exports.services_costume = function(req,res){
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT serviceID, serviceName,  price, image, age FROM service WHERE category='costume'";      
   db.query(sql, function(err, result){
      res.render('services.ejs',{data:result});
   });
};

//==========================| BEFORE SUBSCRIBE SERVICES |=============================
exports.beforesubscribe = function(req,res){
   var message = '';
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }
   if(req.method == "POST"){
      var post  = req.body;
      var serviceId = post.serviceId;
      var sql="SELECT * from service inner join sp using(spID) inner join account on spID = username WHERE `serviceID`='"+serviceId+"'";                             
      db.query(sql, function(err, result){ 
         if(result.length){
            message = serviceId;
            res.render('subscribe.ejs', {data:result, message: serviceId, user: userId});
         }
         else{
            message = 'No such Service ID';
            res.render('beforesubscribe.ejs',{message: message});
         }
                 
      });
   } else {
      res.render('index.ejs',{message: message});
   }         
};

//==========================| SUBSCRIBE SERVICES |=============================
exports.subscribe = function(req,res){
   var date = new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '');
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }
   if(req.method == "POST") {
      var post = req.body;
      var serviceId = post.serviceID;
      var noOfDays = post.noOfDays;

      var message = post.explore;
      console.log("Chosen service provider is: " + message);

      var sql = "INSERT INTO customer_service (serviceID, customerID, requested, noOfDays) VALUES ('"+message+"', '"+userId+"', '"+date+"', '"+noOfDays+"')";                             
      db.query(sql, function(err, result){      
         if(!err){
            console.log("New record added.");
            res.redirect("/home/dashboard");
            console.log("Redirecting to dashboard...");
         } else {
            console.log("Cannot add to record.");
         }           
      });
   }
};

//==========================| SEARCH |=============================
exports.search = function(req, res) {

   if(req.method == "POST") {
      var item = req.body.search;

      var sql = "SELECT serviceName, price, age, serviceID, image FROM service WHERE serviceName LIKE '%"+item+"%'";
      db.query(sql, function (err, result) {

      console.log(item);
      console.log(sql);
      console.log(result);

         if(result.length) {
            res.render('search.ejs', {data: result});
         } else {
            console.log('SEARCH NOT EQUAL');
         }   
      });
   }
};

//==========================| TRANSACTIONS |=============================
exports.transactions = function (req, res) {
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql = "SELECT serviceID, customerID, requested, noOfDays, status FROM customer_service";
   db.query (sql, function (err, result) {
         console.log("element.serviceID");

      res.render('transactions.ejs', {data: result});

   });
};