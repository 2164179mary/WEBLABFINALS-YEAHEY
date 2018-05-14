/*
* GET home page.
*/
 
exports.index = function(req, res){
    var message = '';
  res.render('index',{message: message});
 
};
exports.beforesubscribe = function(req, res){
	   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }
    var message = '';
  res.render('beforesubscribe',{message: message});
 
};
