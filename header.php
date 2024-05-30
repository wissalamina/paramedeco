<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> sahatidom </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="css/header.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
</head>
<body>
    <!-- Start Header -->
    <div class="header">
        <div class="container">
            <a href="#" class="logo">
                <img src="img/sihatiLOGO.png" alt="Sihatidom Logo">
            </a>
            <div class="main-box">
                <ul class="main-nav">
                    <li> <a class="active" href="#aceuil">Aceuil</a> </li>
                    <li> <a href="#propo">A propos</a> </li>
                    <li> <a href="#service">Services </a> </li>
                    <li> <a href="#team">Equipes </a> </li>
                    <li> <a href="#contact">Contact</a> </li>
                </ul>
                <button>
                    <a href="login.php" class="special-box">Rendez-vous</a>
                </button>
            </div>
        </div>
    </div>
    <!-- End Header -->
    <style>

        /* Start Variables */
:root {
    --main-color: #00C2E8;
    --main-alt-color: #939393;
    --white-color: white;
    --main-transition: 0.3s;
}
/* End Variables */

/* Start Global Rules */
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 0;
    margin: 0;
}

body {
    font-family: "Open Sans", sans-serif;
}

a { 
    text-decoration: none;
    color: black;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

button {
    text-decoration: none;
    cursor: pointer;
    outline: none;
    border: 1px white solid;
    border-radius: 6px;
    background: transparent;
}

.container {
    padding-left: 15px;
    padding-right: 15px;
    margin-left: auto;
    margin-right: auto;
}

    /* Small */
@media (min-width: 768px) {
    .container {
        width: 750px;
    }
}
    /* Medium */
@media (min-width: 992px) {
    .container {
        width: 970px;
    }
}
    /* Large */
@media (min-width: 1200px) {
    .container {
        width: 1170px;
    }
}
/* End Global Rules */

/* Start Header */
.header {
    width: 100%;
    background-color: #00C2E8;
    padding: 15px 0;
}

.header .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.header .logo img {
    width: 250px;
    height: 90px;
    margin-top: 35px;
}

.header .main-box {
    display: flex;
    align-items: center;
}

.header .main-nav {
    display: flex;
    margin-right: 20px;
}

.header .main-nav li {
    list-style: none;
}

.header .main-nav li a {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 78px;
    position: relative;
    color: var(--white-color);
    padding: 0 30px;
    overflow: hidden;
    font-size: 17px;
    font-weight: 500;
    transition: var(--main-transition);
    z-index: 20;
}

.header .main-nav li a:hover,
.header .main-nav li a.active {
    color: var(--main-color);
    border-bottom: 1px solid var(--main-color);
}

/* Start special box */ 
.header .container button {
    text-decoration: none;
    cursor: pointer;
    outline: none;
    border: 1px white solid;
    border-radius: none;
    background-color: transparent;
}

.special-box {
    width: fit-content;
    height: auto;
    float: left;
    transition: .5s linear;
    position: relative;
    display: block;
    overflow: hidden;
    padding: 15px;
    text-align: center;
    background: transparent;
    text-transform: uppercase;
    font-weight: 900;
    color: var(--white-color);
    transition: var(--main-transition);
}

.special-box:before {
    position: absolute;
    content: '';
    left: 0;
    bottom: 0;
    height: 4px;
    width: 100%;
    border-bottom: 4px solid transparent;
    border-left: 4px solid transparent;
    border-radius: none;
    box-sizing: border-box;
    transform: translateX(100%);
}

.special-box:after {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    border-top: 4px solid transparent;
    border-right: 4px solid transparent;
    border-radius: none;
    box-sizing: border-box;
    transform: translateX(-100%);
}

.special-box:hover {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    color: var(--main-color);
    border-radius: none;
}

.special-box:hover:before {
    border-color: var(--main-color);
    height: 100%;
    transform: translateX(0);
    transition: .3s transform linear, .3s height linear .3s;
}

.special-box:hover:after {
    border-color: var(--main-color);
    height: 100%;
    transform: translateX(0);
    transition: .3s transform linear, .3s height linear .5s;
}
/* End special box */

        </style>
</body>
</html>
<a href="deconnexion_patient.php">Se deconnecter</a>
