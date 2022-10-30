<?php
    
  include 'database_connection.php';
            



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clinic Panel MARA</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <style>
            .users {
              table-layout: fixed;
              border-collapse:separate; 
              border-spacing:0 15px; 
            }
            /* Column widths are based on these cells */
            .pic {
              width: 5%;
            }
            .text {
              width: 20%;
              text-align:left; 
            }

            .cover{
                width:200px;
                height:500px;
                background-color:#000000;
                float:right;
                overflow:auto;
            }
            #button {
              display: inline-block;
              background-color: #FF9800;
              width: 100px;
              height: 100px;
              text-align: center;
              border-radius: 4px;
              position: fixed;
              bottom: 30px;
              right: 30px;
              transition: background-color .3s, 
                opacity .5s, visibility .5s;
              opacity: 0;
              visibility: hidden;
              z-index: 1000;
            }
            #button::after {
              font-family: FontAwesome;
              font-weight: normal;
              font-style: normal;
              font-size: 2em;
              line-height: 50px;
              color: #fff;
            }
            #button:hover {
              cursor: pointer;
              background-color: #333;
            }
            #button:active {
              background-color: #555;
            }
            #button.show {
              opacity: 1;
              visibility: visible;
            }

            /*    */
            .masthead {
              position: relative;
              width: 100%;
              height: auto;
              min-height: 35rem;
              padding: 15rem 0;
              background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000000 100%), url("assets/img/Klinik_Panel_MARA.jpg");
              background-position: center;
              background-repeat: no-repeat;
              background-attachment: scroll;
              background-size: cover;
            }

            .masthead h2 {
              max-width: 20rem;
              font-size: 1rem;
            }
            @media (min-width: 768px) {
              .masthead h1 {
                font-size: 4rem;
                line-height: 4rem;
              }
            }
            @media (min-width: 320px) {
              .masthead {
                height: 100vh;
                background-size:100% 100%; 
                padding: 0;
              }
              .masthead h1 {
                font-size: 6.5rem;
                line-height: 6.5rem;
                letter-spacing: 0.8rem;
              }
              .masthead h2 {
                max-width: 30rem;
                font-size: 1.25rem;
              }
            }
            
            .ClinicImage{
            display: block;
            margin-left: auto;
            margin-right: auto;
            max-width:100%;
            max-height: 100%;
            }
            #power {
                background-color: Transparent;
                background-repeat:no-repeat;
                border: none;
                cursor:pointer;
                overflow: hidden;
                outline:none;
                color: white;
            }
            .modal-body{
              background: rgb(28,28,7);
              background: linear-gradient(180deg, rgba(28,28,7,1) 0%, rgba(42,110,235,1) 50%, rgba(28,28,7,1) 100%);

            }
            .modal-footer{
              background: rgb(131,58,180);
              background: linear-gradient(142deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);

            }


            
            
        </style> 
    </head>
    <body>
        <div id="loader"> </div>

        <div id="content">
        <!-- Navigation-->
          <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
              <div class="container">
                  
                  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                      Menu
                      <i class="fas fa-bars"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarResponsive">
                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item text-black-50"><a class="nav-link js-scroll-trigger" href="#about"><h3>Info</h3></a></li>
                          <li class="nav-item text-black-50"><a class="nav-link js-scroll-trigger" href="admin/adminLogin.php"><h3>Admin Login</h3></a></li>
                      </ul>
                  </div>
              </div>
          </nav>
          <!-- Masthead-->
          <header class="masthead">
              <div class="container d-flex h-50 align-items-center">
                  <div class="mx-auto text-center">
                      <h1 class="mx-auto my-0 text-uppercase"></h1>
                      <h2 class="text-white-50 mx-auto mt-2 mb-5"></h2>
                      
                  </div>
              </div>

              <section class=" text-center" id="Search">
                  <div class="container">
                      <div class="row">
                          <div class="col-lg-4 mx-auto">
                              <div>
                                  <h2 class="text-white mb-4"></h2>
                              </div>
                          </div>
                      </div>
                      <div class="row"> 
                          <div class="col-lg-5 mx-auto"> 
                              <div class="form-group">
                                      <h3 class="text-white-50 mx-auto mt-2 mb-5">Negeri</h3>
                                      <select class="form-control" id='state'name='state'>
                                        <option selected="" value="all" >Pilih Semua Negeri</option>

                                        <?php 


                                              $Statement = $conn -> prepare("SELECT * FROM kpmara.state");
                                              $Statement->execute();
                                              $state = $Statement->fetchAll(PDO::FETCH_ASSOC);
                          
                                              foreach($state as $x){

                                                  echo "<option value='  ".$x['state_code']."   '  > ".$x['state_name'] ."</option>";

                                              }
                                        ?>

                                      </select>
                              </div>
                          </div>
                          <div class="col-lg-5 mx-auto">
                              <div class="form-group city">
                                  <h3 class="text-white-50 mx-auto mt-2 mb-5">Bandar</h3>
                                  <select class="form-control" id='city' name='city'>
                                      <option selected="" value="all">Pilih semua bandar</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <br/>
                      <div class="row"> 
                          <div class="col-lg-7 mx-auto">
                              <button type="button" id="searchTime" class="btn btn-info">Carian</button>
                          </div>
                      </div>  
                      <br/>  
                      
                  </div>
              </section>
          </header>
          
          <section class="about-section text-center" id="results">
              <div class="container">
                  <div class="row" id="ListsHere">



                   </div>
              </div>
          </section>
          <button type="button" id="button"><i class="fas fa-angle-double-up fa-3x"></i></button>

          
     

          















          <!-- Easiest Part Copy Paste-->

          <!-- About right here -->
          <section class="projects-section bg-light" id="about">
              <div class="container">
                Here how's the story begin..... 
                <br/>
                In the world WHERE 2 Cheese...1 Man..
                <br/>
                1 Vision .... Appeared another man...
                <br/>
                And they murder each other...
                <br/>
                .....
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                Yeah thats it...they died what else you expect?
              </div>
          </section>
           <!--End About-->
          



          <!-- Contact-->
          <section class="contact-section bg-black">
              <div class="container">
                  <div class="row">
                      <div class="col-md-4 mb-3 mb-md-0">
                          <div class="card py-4 h-100">
                              <div class="card-body text-center">
                                  <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                  <h4 class="text-uppercase m-0">Address</h4>
                                  <hr class="my-4" />
                                  <div class="small text-black-50">The Gates To Heaven</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4 mb-3 mb-md-0">
                      </div>
                      <div class="col-md-4 mb-3 mb-md-0">
                          <div class="card py-4 h-100">
                              <div class="card-body text-center">
                                  <i class="fas fa-envelope text-primary mb-2"></i>
                                  <h4 class="text-uppercase m-0">MARA email for contacts</h4>
                                  <hr class="my-4" />
                                  <div class="small text-black-50">boiHeThicBoi!@gmail.com</a></div>
                              </div>
                          </div>
                      </div>
                      
                  </div>
                  
              </div>
          </section>
          <input type="hidden" name="state_id" id="state_id" />
          <input type="hidden" name="city_id" id="city_id" />
          
          <!-- Footer-->
          <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © B34$T CLAN 2020</div></footer>
          <!-- Bootstrap core JS-->
        </div>
          
        <script src="plugins/jquery/jquery.min.js"></script>
       
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        

        <script type="text/javascript">
            //Make neat buttons bois
            var btn = $('#button');

            $(window).scroll(function() {
              if ($(window).scrollTop() > 700) {
                btn.addClass('show');
              } else {
                btn.removeClass('show');
              }
            });

            btn.on('click', function(e) {
              e.preventDefault();
              $('html, body').animate({scrollTop:0}, '200');
            });
        
        </script>
        

        <script>
        //Force going back to the top
        window.onbeforeunload = function () {
          window.scrollTo(0, 0);
        }


        $(document).ready(function(){
            


            $("#state").change(function(){
                $('#city').empty();
                if($("#state").val()!=="all"){

                    var sid = $("#state").val();
                    var separate = "GetCity";
                    $.ajax({
                        url: 'admin/clinicAction.php',
                        method: 'post',
                        data: {sid:sid,separate:separate}             //pass data from right to left [ pass right data[recieve] into left using sid[to other page]]
                    }).done(function(City){
                        City = JSON.parse(City); // Change to object to use city1 . [city_id]/ [city_name]...etc
                        
                        
                            //Clears city content once done with one city
                        $('#city').append('<option selected="" value="all">Select All City</option>');
                        City.forEach(function(city1){       //Does the same like PHP for each
                                $('#city').append('<option value=' + city1.city_code + ' name = ' + city1.city_name + ' >' + city1.city_name + '</option>')  //Append same as concat but does it under <select id...>
                        })
                        
                    })
                }
                else{
                    $('#city').append('<option selected="" value="all" >Select All City</option>')  //Append same as concat but does
                    
                }

            })

            $('#searchTime').click(function(){
                var state = $("#state").val();
                var city =  $('#city').val();

                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#results").offset().top
                }, 1000);


                $("#ListsHere").empty();
                $.ajax({

                    url:'StandardClinic.php',
                    method:'post',
                    data:{state:state,city:city}
                }).done(function(Lists){

                    Lists = JSON.parse(Lists);
                    if(Lists==""){
                        
                        $("#ListsHere").append(
                                               '       <div>'+
                                               '             <br/><h2 class="text-white-50 ">Tiada Klinik Dijumpai Tolong!</h2>'+
                                               '       </div>'+
                                               '       <br/>' +
                                               '       <br/>' +
                                               '       <br/>' +
                                               '       <br/>' +
                                               '       <br/>' +
                                               '       <br/>' +
                                               '       <br/>' +
                                               '       <br/>' +
                                               '       <br/>' +
                                               '    </div>')
                                               
                            



                        
                    }
                    else{

                        Lists.forEach(function(clinics){

                            var fax = clinics.clinic_fax;

                            if(fax==""){
                                fax= "-";
                            }
                            
                            if(clinics.clinic_picture!=null){
                            $('#ListsHere').append('<div class="col-md-4">                                                                                                              ' +
                                                   '   <div class="text-white-50">'+clinics.clinic_name+'                                                             ' +
                                                   '   <br/>                                                                                                           ' +
                                                   '   <table class="users">                                                                                                            ' +
                                                   '        <tbody>                                                                                                                     ' +

                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class ="pic"> <span style=" color: Dodgerblue;"><i class="fas fa-search-location fa-2x"></i></span></td>        ' +
                                                   '                <td class="text"> '+clinics.clinic_address +'</td>                                                                  ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class="pic"> <i class="fas fa-phone fa-2x"></i></td>                                                            ' +
                                                   '                <td class="text">' +clinics.clinic_ph+'</td>                                                                        ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class="pic">  <span style=" color: MediumSeaGreen;"><i class="fas fa-fax fa-2x" "></i></span> </td>               ' +
                                                   '                <td class="text">' +fax+'</td>                                                                                      ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class="pic">  <span style="color:#eaeb2a"><i class="far fa-images fa-2x"></i></span> </td>               ' +
                                                   '                <td class="text"><button id="power" class="ViewImages" pictures="'+clinics.clinic_picture+'" style="center" data-toggle="modal" data-target="#modal">Click Me To View</button></td>                                                                                      ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '       </tbody>                                                                                                                     ' +
                                                   '    </table>                                                                                                                        ' +
                                                   '   ' +
                                                   '    <div>                                                                                                                           ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '</div>');
                            
                            
                          }
                          else{
                            $('#ListsHere').append('<div class="col-md-4">                                                                                                              ' +
                                                   '   <div class="text-white-50">'+clinics.clinic_name+'                                                             ' +
                                                   '   <br/>                                                                                                           ' +
                                                   '   <table class="users">                                                                                                            ' +
                                                   '        <tbody>                                                                                                                     ' +

                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class ="pic"> <span style=" color: Dodgerblue;"><i class="fas fa-search-location fa-2x"></i></span></td>        ' +
                                                   '                <td class="text"> '+clinics.clinic_address +'</td>                                                                  ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class="pic"> <i class="fas fa-phone fa-2x"></i></td>                                                            ' +
                                                   '                <td class="text">' +clinics.clinic_ph+'</td>                                                                        ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class="pic">  <span style=" color: MediumSeaGreen;"><i class="fas fa-fax fa-2x" "></i></span> </td>               ' +
                                                   '                <td class="text">' +fax+'</td>                                                                                      ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '            <tr>                                                                                                                    ' +
                                                   '                <td class="pic">  <span style="color:#eaeb2a"><i class="far fa-images fa-2x"></i></span> </td>               ' +
                                                   '                <td class="text"> No Image Found</td>                                                                                      ' +
                                                   '            </tr>                                                                                                                   ' +
                                                   '       </tbody>                                                                                                                     ' +
                                                   '    </table>                                                                                                                        ' +
                                                   '   ' +
                                                   '    <div>                                                                                                                           ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '   <br/>                                                                                                                            ' +
                                                   '</div>');






                          }
                        })

                    }

                })

                
            });
            
            $(".scroll-top").click(function() {
                $("html, body").animate({ 
                    scrollTop: 0 
                }, "slow");
                return false;
            });



            $(document).on('click', '.ViewImages', function(){

              var img = $(this).attr("pictures");
             
              if(img == 'null'){
                img = "NoImage.png";
              }
              

              var modal = document.getElementById("Picmodal");
                  
            // Get the image and insert it inside the modal - use its "alt" text as a caption
              var modalImg = document.getElementById("DaImage");
              



              modalImg.src = "uploads/"+ img ;
  



            })
            

        });

        </script>

        
    </body>
</html>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">


          <!--Body-->
          <div class="modal-body mb-0 p-0" id>

              <br/>
              <br/>

              <img class="ClinicImage" id="DaImage" src=""
                allowfullscreen></img>
            

          </div>

          <!--Footer-->
          <div class="modal-footer justify-content-center">


            <button type="button" class="btn btn-secondary btn-rounded btn-md ml-4" data-dismiss="modal">Tutup</button>

          </div>

        </div>
        <!--/.Content-->

      </div>
    </div>
