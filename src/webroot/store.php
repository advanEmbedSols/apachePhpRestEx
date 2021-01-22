<!DOCTYPE html>
<!--Copyright 2021 - Kyle Johnson
/* This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <https://www.gnu.org/licenses/>.
-->
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<?php
  $cat_name = htmlspecialchars(trim(strip_tags($_GET["cat_name"])));
  echo "<title>Shop $cat_name</title>"
?>
  <!-- Bootstrap core CSS -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="/css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
       <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Services
            <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page Content -->
  <div class="container">

    <div class="row">
		<div class="col-lg-3">

        <h1 class="my-4">Program Support Inc.</h1>
        <div class="list-group">
          <a href="/ecommerce/it/" class="list-group-item">IT Services</a>
          <a href="/ecommerce/coding/" class="list-group-item">Coding Services</a> 
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9 top-banner">
       <?php
         $cat_name = htmlspecialchars(trim(strip_tags($_GET["cat_name"])));
         echo(" <p></p><h1 class=\"modal-title text-center\" >$cat_name</h2><p></p>");
      ?>
        <div class="row item-row">
        <p></p><p></p>
        <h3 class="modal-title text-center" >No Items found in this categories</p>
        <p></p><p></p>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Modal -->
   <div class="modal fade" id="detailItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="detailItemModalTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
             </div>
             <div class="modal-body" id="detailItemModalSlide">
                <div id="modalCarousel" class="carousel slide my-4" data-ride="carousel">
                   <ol id="modalCarouselIndicators" class="carousel-indicators">
                   </ol>
                   <div id="modalCarouselInner" class="carousel-inner" role="listbox">
                   </div>
                   <a class="carousel-control-prev" href="#modalCarousel" role="button" data-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>
                   </a>
                   <a class="carousel-control-next" href="#modalCarousel" role="button" data-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="sr-only">Next</span>
                   </a>
               </div>
            </div>

            <div class="modal-body" id="detailItemModalBody">
            </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
     </div>
   </div>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <?php
      $cat_name = htmlspecialchars(trim(strip_tags($_GET["cat_name"])));
      echo "<p id=\"cat_p\" hidden>$cat_name</p>";
   ?>

  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/js/store.js"></script>

</body>

</html>

