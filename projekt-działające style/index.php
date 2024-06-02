<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Arkadiusz Kapa">
    <meta name="description" content="Internetowa księgarnia">
    <meta name="keywords" content="księgarnia, książki, zakupy online">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Księgarnia Internetowa</title>
    <?php
    session_start();
    if($_SESSION['logged_in']==false){
        header("Location: logowanie.php");
        #Mam nadzieje ze podoba sie Pani moj projekt!
    }
    ?>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'includes/header.php'; 
    $role = $_SESSION['role'];?>
    
    <main>
        <div class="center-div">
            <div>
                <h1>WITAMY!</h1>
            </div>
            <div>
            <?php if ($role == 'client') { ?>
                <a href="przeglad.php" class="buttonW">Biblioteka</a>
                <?php } ?>
                
                <?php if ($role == 'admin') { ?>
                    <a href="przeglad.php" class="buttonW">Biblioteka</a>
                    <a href="dodaj_ksiazke.php" class="buttonW">Dodaj książkę</a>
                    <a href="usun_uzytkownika.php" class="buttonW">Usuń użytkownika</a>
                    <a href="dodaj_uzytkownia.php" class="buttonW">dodaj użytkownika</a>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
