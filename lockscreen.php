<?php
    if (!isset($_SESSION)) session_start();

    if (isset($_SESSION['USR_ID']))
    {
        require(__DIR__ . '/access.php');
        require_once(__DIR__ . '/config.php');

        $USR_ID = $_SESSION['USR_ID'];

        $SQL    = " SELECT SU.USR_PHOTO, SU.USR_NAME, SL.LVL_NAME
                      FROM SYS_USERS SU
                      JOIN SYS_LEVEL SL ON SU.USR_FK_LEVEL = SL.LVL_ID
                     WHERE USR_ID = '$USR_ID'
                  ";

        $RESULT = mysqli_query($CONN1, $SQL);

        if (mysqli_num_rows($RESULT) > 0)
        {
            while ($PHOTO = mysqli_fetch_array($RESULT))
            {
                if (empty($PHOTO['USR_PHOTO']))
                {
                    $IMG = 'dist/img/user.png';
                } else
                {
                    $IMG = 'dist/img/' . $PHOTO['USR_PHOTO'] . '';
                }
            }
        }

        $SQL = " SELECT SES_FK_USER,
                        MAX( SES_LOGIN ) AS LOGIN
                   FROM SYS_SESSION
                  WHERE SES_FK_USER = '$USR_ID'
               ";

        $RESULT = mysqli_query($CONN1, $SQL);
        $RESP = mysqli_fetch_array($RESULT);
        $LOGIN = $RESP['LOGIN'];

        mysqli_query($CONN1, " UPDATE SYS_SESSION
                                  SET SES_LOGOUT  = NOW(),
                                      SES_TIME    = TIMEDIFF( NOW(), '$LOGIN' )
                                WHERE SES_LOGIN   = '$LOGIN'
                                  AND SES_FK_USER = '$USR_ID'
                    ");

        mysqli_close($CONN1);
        $LOGIN  = $_SESSION['USR_LOGIN'];
        $NAME   = $_SESSION['USR_NAME'];
        session_unset();
        session_destroy();

        if ($NAME == '' OR NULL)
        {

            session_unset();
            session_destroy();
            header("Location: login/login.php");
            exit();

        }

    } else
    {

        session_unset();
        session_destroy();
        header("Location: login/login.php");
        exit();

    }
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title><?= $title; ?>&nbsp;[ Acesso ao Sistema ]</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="dist/img/icons/favicon.ico" />
        <!--===============================================================================================-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <!--===============================================================================================-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/login/css/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/login/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" href="/login/css/style.css">
        <!--===============================================================================================-->
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
    </head>

    <body class="img js-fullheight hold-transition lockscreen" style="background-image: url(../dist/img/sis/bg1.jpg); background-size: cover; width: 100%; height: 100vh;">
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5  animated pulse myForm">
                        <img class="img-logo" src="dist/img/sis/logo.png">
                        <img class="img-title" src="dist/img/sis/sisadv.png"><br />
                        <h3 style="color: aliceblue;">Sua sessão expirou por inatividade!</h3><br />
                        <h5 style="color: antiquewhite;">Você ficou 60 minutos inativo e, para sua segurança, finalizamos a sua sessão. Por favor, entre novamente.<br /></h5>
                    </div>
                </div>
                <div class="row justify-content-center">

                    <div class="login-wrap p-0">

                        <div class="lockscreen-wrapper">
                            <div class="lockscreen-logo">

                            </div><!-- User name -->
                            <div class="lockscreen-name text-right"><?= $NAME; ?></div>

                            <!-- START LOCK SCREEN ITEM -->
                            <div class="lockscreen-item"><!-- lockscreen image -->

                                <div class="lockscreen-image">
                                    <img src="<?= $IMG; ?>" />
                                </div><!-- /.lockscreen-image -->

                                <!-- lockscreen credentials (contains the form) -->
                                <form class="lockscreen-credentials" name="login" action="/access/authentication.php" method="POST">
                                    <div class="input-group">
                                        <input class="form-control" type="hidden" name="USR_LOGIN" value="<?= $LOGIN; ?>">
                                        <input class="form-control" style="color: rgb( 58, 100, 140 ) !important;" type="password" name="USR_PASS" placeholder="Senha" onchange="login.submit()" autofocus required />
                                        <div class="input-group-append">
                                            <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.lockscreen credentials -->

                            </div>
                            <!-- /.lockscreen-item -->
                            <div class="help-block text-center">
                                Digite sua senha para entrar novamente,<br />
                                ou faça login como um usuário diferente.
                            </div>
                            <div class="text-center">
                                <br />
                                <a href="login/login.php" style="color: rgb( 248, 235, 214 );" onmouseover="this.style.color='rgb( 253, 224, 139 )'" onmouseout="this.style.color='rgb( 248, 235, 214 )'">Trocar de usuário <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            <div class="lockscreen-footer text-center">

                            </div>
                        </div><!-- /.center -->

                        <?php
                        $IP = $_SERVER['REMOTE_ADDR'];
                        echo '<div class="w-100 mt-5 text-center"><span style="font-size: 1.0em; font-weight: 600; letter-spacing: 0.1em; color: rgb(248, 248, 242);">&mdash; IP: ' . $IP . ' &mdash;</span></div>';
                        ?>
                        <div class="fixed-bottom text-center">
                            <p>&copy; 2005-<?= date("Y"); ?> by <a href="https://1bit.dev.br" style="color: rgb( 134, 144, 153 );" onmouseover="this.style.color='rgb( 248, 248, 226 )'" onmouseout="this.style.color='rgb( 134, 144, 153 )'">1bit.dev.br</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <!--===============================================================================================-->
        <script src="js/animsition.min.js"></script>
        <!--===============================================================================================-->

    </body>

</html>