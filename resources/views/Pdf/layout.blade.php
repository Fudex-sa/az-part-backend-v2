<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
<meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align:center;            
        }

        .logo{
            width: 200px;
            height:100px;
            border: 2px solid #dcdcdc;
        }
        table{
            padding:3px;
            text-align:right;
        }
        table th{
            text-align:center;
            background:#DCDCDC;
            padding:3px;
        }
        table td{
            padding:3px;                        
            border:1px solid #DCDCDC;
        }
        table tr{
            border:1px solid #DCDCDC;
        }
    </style>
    
</head>

<body>
    <div class="text-center">
       <!-- <img src="http://az.parts/templates/images/logo.png" class="logo"/> -->
       AZ Parts
    </div>
    @yield('content')
 
        <hr/>
        <footer>
            <p> جميع حقوق الطبع محفوظه ل AZ Parts {{ date('Y') }} </p>
        </footer>
</body>

</html>
