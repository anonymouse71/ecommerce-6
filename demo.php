<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            #container3 {
                float:left;
                width:100%;
                background:green;
                position: initial;
                left: 0%;
                
            }
            #container2 {
                float:left;
                width:100%;
                background:yellow;
                position:absolute;
                left:0%;
            }
            #container1 {
                float:left;
                width:100%;
                background:red;
                position:absolute;
                left:0%;
            }
            #col1 {
                float:left;
                width:30%;
            }
            #col2 {
                float:left;
                width:40%;
            }
            #col3 {
                float:left;
                width:30%;
            }
        </style>
    </head>
    <body>
        <div id="container3">
            <div id="container2">
                <div id="container1">
                    <div id="col1">Column 1</div>
                    <div id="col2">Column 2</div>
                    <div id="col3">Column 3</div>
                </div>
            </div>
        </div>
    </body>
</html>
