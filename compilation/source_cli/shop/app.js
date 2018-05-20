/**
* Module dependencies.
*/
var express = require('express')
  , routes = require('./routes')
  , user = require('./routes/user')
  , http = require('http')
  , path = require('path');
//var methodOverride = require('method-override');
var session = require('express-session');
var app = express();
var mysql      = require('mysql');
var bodyParser=require("body-parser");
var connection = mysql.createConnection({
              host     : '192.168.5.41',
              user     : 'root1',
              password : '',
              database : 'rental'
            });
 
connection.connect();
 
global.db = connection;
 
app.use(express.static(__dirname + '/'));
// all environments
app.set('port', process.env.PORT || 8080);
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(express.static(path.join(__dirname, 'public')));
app.use(session({
              secret: 'keyboard cat',
              resave: false,
              saveUninitialized: true,
              cookie: { maxAge: 3600*24 }
            }));
 
// development only

 
app.get('/', routes.index); //call for main index page
app.get('/login', routes.login); //call for login page
app.post('/login', user.login); //call for login post
app.get('/home/dashboard', user.dashboard); //call for dashboard page after login
app.get('/home/logout', user.logout); //call for logout
app.get('/home/profile', user.profile); //to render users profile

app.get('/home/services_attire', user.services_attire); //to render users services
app.get('/home/services_costume', user.services_costume); //to render users services

app.get('/home/beforesubscribe', routes.beforesubscribe); 
app.post('/home/beforesubscribe', user.beforesubscribe); //call for beforesubscribe
app.post('/home/subscribe', user.subscribe); //call for subscribe
app.post('/home/search', user.search); //search functionality
app.get('/home/transactions', user.transactions);
//Middleware
app.listen(8080);
console.log("Server running on port 3000");
