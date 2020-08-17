<!-- If form is submit -->
<?php
    if( isset( $_POST['url'] )){

        //stock URL in variable
        $url = $_POST['url'];

        //Check if $url is a validate URL 
        if( !filter_var($url, FILTER_VALIDATE_URL) ){

            //redirect and display error message
            header('location:../?error=true&message=Adresse URL non valide');
            exit();
        }

        //SHORT URL
        $shortcut = crypt($url, time() );

        //Is SHORT URL Already exist
        $bdd = new PDO('mysql:host=localhost;dbname=shorten_url;charset=utf8','root','root');
        $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE url = ?');
        $req->execute(array($req));

        while($result = $req->fetch()){

            if($result['x'] != 0){
                header('location: ../?error=true&messsage=Adresse déjà raccourcie');
                exit();
            }
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design/style.css">
    <link rel="icon" href="design/pictures/favico.png">
</head>

<body>
    <!-- section hello -->
    <section id="hello">

        <!-- container -->
        <div class="container">

            <!-- header -->
            <header>
                <img src="design/pictures/logo.png" alt="logo" id="logo">
            </header>

            <!-- Value proposition -->
            <h1>URL trop longue ? raccourcissez-là.</h1>
            <h2>Largement meilleur et plus court que les autres !</h2>

            <!-- Form -->
            <form action="index.php" method="post">
                <input type="url" name="url" placeholder="entrez l'url a raccourcir">
                <input type="submit" value="raccourcir">
            </form>

            <?php
                //If variable GET error and message exist
                if(isset($_GET['error']) && isset($_GET['message']) ){
                    
            ?>

            <div class="center">
                <div id="result">
                    <b>
                        <?php
                            echo htmlspecialchars($_GET['message']);
                            }
                        ?>
                    </b>
                </div>
            </div>

        </div>
    </section>

    <!-- Section Brands -->
    <section id="brands">

        <!-- container -->
        <div class="container">

            <h3>Ces marques nous font confiance</h3>
            <img src="design/pictures/1.png" alt="1" class="picture">
            <img src="design/pictures/2.png" alt="2" class="picture">
            <img src="design/pictures/3.png" alt="3" class="picture">
            <img src="design/pictures/4.png" alt="4" class="picture">

        </div>

    </section>

    <!-- FOOTER -->
    <footer>
        <img src="design/pictures/logo2.png" alt="logo" id="logo"><br>
        2018 © Bitly<br>
        <a href="#">Contact</a> - <a href="#">À propos</a>
    </footer>


</body>

</html>