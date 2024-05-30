<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styl.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="bag-add-outline"></ion-icon></span>
                        <span class="title">Sihati Dom</span>
                    </a>
                </li>
                <li>
                    <a href="admin.html">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="equipe_medical.php"> <!-- Lien vers l'équipe médicale -->
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Equipe médicale</span> <!-- Texte pour l'équipe médicale -->
                    </a>
                </li>
                <li>
                    <a href="heures.php">
                        <span class="icon"><ion-icon name="time-outline"></ion-icon></span>
                        <span class="title">Horaires</span>
                    </a>
                </li>
                <li>
                    <a href="patients.php"> <!-- Lien vers la page des patients -->
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Patients</span> <!-- Texte pour les patients -->
                    </a>
                </li>
                <li>
                    <a href="rendezvous.php">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <span class="title">Rendez-vous</span>
                    </a>
                </li>
                <li>
                    <a href="actsparamedicaux.php">
                        <span class="icon"><ion-icon name="bag-add-outline"></ion-icon></span>
                        <span class="title">Les acts paramedicaux</span>
                    </a>
                </li>
                <li>
                    <a href="changement_mot_de_passe.php">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <span class="title">Mot de passe</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Se deconnecter</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
       </div> 
       </div>   
    </div>   
     <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script> 
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function(){
            navigation.classList.toggle('active')
            main.classList.toggle('active')
        }
    </script>
    </body>
    </html>
