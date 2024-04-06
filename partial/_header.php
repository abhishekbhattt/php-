<head>
<link rel="stylesheet" href="style1.css">
</head>
<body>
  
<?php 
session_start();
echo '<nav class="navbar py-3 navbar-expand-lg navbar-dark bg-dark  head">
<a class="navbar-brand text-danger " href="/forum"><strong>i-vision</strong></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto ">
    <li class="nav-item active">
      <a class="nav-link " href="/forum">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        Top categories
      </a>
      <div class="dropdown-menu">';

      $sql = "SELECT category_name , category_id FROM  `categories` LIMIT 3";
      $result = mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($result)){
        
        echo '<a class="dropdown-item" href="threadslist.php?catid='. $row['category_id'].'">'.$row['category_name'].'</a>';
      }
        
        echo '
      </li>
      <li class="nav-item">
      <a class="nav-link" href="contact.php"  >Contact</a>
      </li>
      </ul>
      <div class=" row mx-2">';
      
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
      {
        echo
        '<form class="form-inline my-2 my-lg-0 method="get" action="search.php">
        <p class = "text-light my-0 mx-2" >Welcome :</p>'.'<p class="text-success my-0 mx-2">'. $_SESSION['useremail'].'</p>
        '.'
          <input class="form-control mr-sm-2" name ="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0 " type="submit">Search</button>
         <a  href = "partial/_logout.php" class="btn btn-outline-success ml-2"  data-target="#loginmodal">Logout</a></form>';
      } 
      else{
        
      echo '<form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" disabled placeholder="login to Unlock search " aria-label="Search">
        <button class="btn btn-danger  my-2 my-sm-0 " disabled type="submit">Search</button>
      </form>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginmodal">Login</button>
  <button class="btn btn-outline-success mx-2 "data-toggle="modal" data-target="#signupmodal">Signup</button></div>
      ';}
echo '</div>
</nav>';


include 'partial/loginmodal.php';
include 'partial/signupmodal.php';

if(isset($_GET['signupsuccess'])&& $_GET['signupsuccess']=='true')
{
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['loggedinsuccess'])&& $_GET['loggedinsuccess']=='true')
{
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Successfully Loggedin
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>  
</body>