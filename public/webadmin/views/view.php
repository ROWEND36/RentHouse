<!DOCTYPE html>

<html lang="en">

<head>
  <title> </title>
  <meta charset="UTF-8">
  <meta name="Description" content="Offering training on the modern technologies.">
  <meta name="Keyword" content="Computer, Training, Computer Networking, Cyber Security, Digital Forensic,">
  <meta name="viewport" content="width=device-width scale=1.0">

  <script src="/js/eruda.min.js" type="text/javascript" charset="utf-8"></script>
  <script>eruda.init([])</script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://kit.fontawesome.com/bbd45143cf.js" crossorigin="anonymous"></script>
</head>

<body>

  <style>
  
  .card{
    overflow: auto;
  }
  table{
    width: 100%;
    margin: 10px 0;
  }
  tr:nth-child(even){
    background: #ddd;
  }
  .result-key {
    color: #2196f3;
    font-weight: bold;
  }
  .result-value{
    font-size: 0.95em;
  }
  </style>
  <!--NAVBAR SECTION-->
  <header>
    <nav class="navbar navbar-expand-lg bg-dark">
      <div class="container-fluid">
        <a href="#" class="navbar-brand ml-3">Eddy<span style="color:#00E8E8">:)sy</span></a>
      </div>
    </nav>
  </header>

  <div id="app" class="container">
    <h5 class='m-4'>Please wait....</h5>
  </div>

  <footer>
    <div class="section-5 text-center mt-auto">
      <hr>
      <h5 style="color: aquamarine;"> Eddysy Solutions&copy;</h5>
    </div>
  </footer>


  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    var $_DATA_ =  <?php
    require "paths.php";
    $json = "null";
    try {
      require $PRIVATE . "lib/list.php";
      $data = listAll("emails");
      $json = json_encode($data);
    } catch (APIError $e) {
    }
    echo $json;
    ?>;
 </script>
 <script src="/js/web_api.js"></script>
 <script src="/js/view.js"></script>

</body>


</html>