<!DOCTYPE html>
<!-- saved from url=(0039)http://getbootstrap.com/examples/theme/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="http://getbootstrap.com/favicon.ico">-->

    <title>Logowanie</title>

	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
	integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
	crossorigin="anonymous"></script>

	<script src="../bootstrap.min.js"></script>
    <script src="../commons/userCommonActions.js"></script>
    <!-- Custom styles for this template -->
    <link href="../theme.css" rel="stylesheet">

  </head>

  <body onload="fill_menu($privileges)">
      <?php
            require_once "./lib/nusoap.php";
            $client = new nusoap_client("http://localhost/Rekrutacja/server.php");
            $err = $client->getError();
            if ($err) {
                echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
            }
            session_start();
            if (isset($_GET['logout'])) {
                session_destroy();
                header("Refresh:0; url=index.php");
            }
            if (isset($_SESSION['student'])) {
        ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.html">System rejestracji studentów</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" id="user_menu">
            <li><a href="">Syllabus</a></li>
            <li id="logout_btn" onclick="logout()"><a href="../index.html">Wyloguj</a></li>
          </ul>
        </div><!--/.nav-collapse -->

      </div>
    </nav>
<div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>System rekrutacji na studia wyższe na PK</h1>
        <p>Witamy na stronie glownej</p>
      </div>

	<footer class="footer">
      <div class="container">
        <p class="text-muted">Temporary content</p>
      </div>
    </footer>
  </div>
        <?php
            } else {
        ?>
        <!-- stronka bez logowania -->
        <?php
            }
        ?>
  </body>
</html>
