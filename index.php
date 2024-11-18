<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible content="IE="edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    list-style: none;
    scroll-behavior: smooth;
    font-family: 'Roboto', sans-serif;
}
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-image: linear-gradient(rgb(0, 0, 0, 0.3), rgb(0, 0, 0, 0.2)), url('./images/17.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    font-family: 'Roboto', sans-serif;
}
#logo {
    font-size: 36px;
    font-weight: 700;
    color: black;
    text-shadow: 0px 1px 1px black;
    margin-bottom: 5px;
}
#navbar form button {
    background: #ffa500;
    color: #f9f9f9;
    border: none;
}
.home {
    width: 100%;
    height: 100vh;
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

.home .content {
    text-align: center;
    padding-top: 50px; 
}


.changecontent::after{
    content: '';
color: #ffa500;
    font-weight: 600px;
    text-shadow: 0px 1px 1px black;
    animation: changetxt 10s infinite linear;
}
@keyframes changetxt{
    0%{ content:  "BMW";}
    10%{ content:  "MERCEDES";}
    20%{content:  "Audi";}
    30%{content:  "Fiat";}
    40%{content:  "Range Rover";}
    50%{content:  "Mazda";}
    60%{content:  "ferrari";}
    70%{ content:  "Kia";}
    80%{content:  "Symbol";}
    90%{content:  "clio";}
    80%{content:  "polo";}

    }
    .home .content h4 {
    color: white;
    font-size: 38px;
    font-weight: 500px;
    text-shadow: 0px 1px 1px black;
    margin-bottom: 10px; /
}
    .home .content h1 {
    color: white;
    font-size: 70px;
    font-weight: 600;
    text-shadow: 0px 1px 1px black;
    margin-top: 5px;
}
.home .content p{
    color: white;
    font-size: 15px;
    font-weight: 600px;
    text-shadow: 0px 1px 1px black;
    margin-bottom: 30px; 
    margin-top: 5px;
}
.home .content a{
    padding: 10px;
    background: white;
    color: black;
    letter-spacing: 2px;
    font-weight: 550px;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.5s;
}
.home .content a:hover{
    background: #ffa500;
    color:white;
}

@media (max-width:850px){
    .home{
        background-position: 50%;
    }
}

@media (max-width:450px){
    .home .content h1{
        font-size: 25px;   }
    .home .content h4{
        font-size: 25px;   }
    .home .content p{
        font-size: 25px;   }
}


#footer h1{
font-weight: 600;
padding-top: 30px;
text-shadow: 0px 0px 1px black;
}

#footer h1 span{ color: #ffa500;
}

.social-links i{
padding: 10px;
 border-radius: 5px; 
 font-size: 20px;
  background: black;
   color: white; 
   margin-left: 10px;
    margin-bottom: 10px;
     transition: 0.5s ease;
     cursor: pointer;
}
.social-links i:hover{
    background: #ffa500;
}

    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php" id="logo"><span></span>PrestigeCar Rental </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span><i class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search">
                <button class="btn btn-primary" type="button">Search</button>
            </form>
        </div>
    </div>
</nav>

    <?php  ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <div class="Home">
        <div class=" content"> 
            <h4> Agence de location de voiture</h4>
            
            <h1>Voiture <span class= "changecontent"></span></h1>
             <a href="sinscrire.php" > se connecter</a>
            
        </div>
    </div>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css? family=Roboto:<ght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</body>
</html>
