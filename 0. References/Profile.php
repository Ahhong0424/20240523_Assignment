<?php session_start();?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Profile</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <style>
        body{
            background: linear-gradient(0.25turn, #3f87a6, #ebf8e1, #f69d3c);
        }
        
        .profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #f1f1f1;
        }
        
        .icon{
            border: 2px solid lightgrey;
            width: 15%;
            padding-bottom: 0.2px;
            margin-left: 30px;
            margin-top: 30px;
        }
        
        img.user {
            width: 100%;
        }
        
        hr {
            border: 1px solid lightgray;
            margin-bottom: 25px;
        }
        
        .user-information{
            border: 2px solid lightgrey;
            width: 60%;
            padding-bottom: 200px;
            margin-left: 250px;
            margin-top: 1px;
        }
        
        .ra{
            border: 2px solid lightgrey;
            padding: 18%;
        }
    </style>
    <body>
    <div class="profile">   
        <div class="icon">
            <a target="_blank" href="profile.jpg">
            <img src="profile.jpg" alt="User" class="user">
            </a>
        </div><br>
       
        <hr>
        <h1 style="margin-left: 30px;">Recent activities</h1>
        <div class="ra">
            
        </div>
    </div> 
    </body>
</html>
