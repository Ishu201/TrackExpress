<!DOCTYPE html>
<html lang="en">

<head>
  <title>Track Express</title>

  <?php include('links.php') ?>

  <?php
  include('../models/Support_model.php');
  $obj = new Support;
  $result = $obj->get_list();
  $result2 = $obj->get_list();
  ?>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/datepicker.sass">

  <style>
    .card-bordered {
      border: 1px solid #ebebeb;
    }

    .card {
      border: 0;
      border-radius: 0px;
      margin-bottom: 30px;
      -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
      -webkit-transition: .5s;
      transition: .5s;
    }

    .padding {
      padding: 3rem !important
    }

    body {
      background-color: #f9f9fa
    }

    .card-header:first-child {
      border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
    }


    .card-header {
      display: -webkit-box;
      display: flex;
      -webkit-box-pack: justify;
      justify-content: space-between;
      -webkit-box-align: center;
      align-items: center;
      padding: 15px 20px;
      background-color: transparent;
      border-bottom: 1px solid rgba(77, 82, 89, 0.07);
    }

    .card-header .card-title {
      padding: 0;
      border: none;
    }

    h4.card-title {
      font-size: 17px;
    }

    .card-header>*:last-child {
      margin-right: 0;
    }

    .card-header>* {
      margin-left: 8px;
      margin-right: 8px;
    }

    .btn-secondary {
      color: #4d5259 !important;
      background-color: #e4e7ea;
      border-color: #e4e7ea;
      color: #fff;
    }

    .btn-xs {
      font-size: 11px;
      padding: 2px 8px;
      line-height: 18px;
    }

    .btn-xs:hover {
      color: #fff !important;
    }




    .card-title {
      font-family: Roboto, sans-serif;
      font-weight: 300;
      line-height: 1.5;
      margin-bottom: 0;
      padding: 15px 20px;
      border-bottom: 1px solid rgba(77, 82, 89, 0.07);
    }


    .ps-container {
      position: relative;
    }

    .ps-container {
      -ms-touch-action: auto;
      touch-action: auto;
      overflow: hidden !important;
      -ms-overflow-style: none;
    }

    .media-chat {
      padding-right: 64px;
      margin-bottom: 0;
    }

    .media {
      padding: 16px 12px;
      -webkit-transition: background-color .2s linear;
      transition: background-color .2s linear;
    }

    .media .avatar {
      flex-shrink: 0;
    }

    .avatar {
      position: relative;
      display: inline-block;
      width: 36px;
      height: 36px;
      line-height: 36px;
      text-align: center;
      border-radius: 100%;
      background-color: #f5f6f7;
      color: #8b95a5;
      text-transform: uppercase;
    }

    .media-chat .media-body {
      -webkit-box-flex: initial;
      flex: initial;
      display: table;
    }

    .media-body {
      min-width: 0;
    }

    .media-chat .media-body p {
      position: relative;
      padding: 6px 8px;
      margin: 4px 0;
      background-color: #f5f6f7;
      border-radius: 3px;
      font-weight: 100;
      color: #9b9b9b;
    }

    .media>* {
      margin: 0 8px;
    }

    .media-chat .media-body p.meta {
      background-color: transparent !important;
      padding: 0;
      opacity: .8;
    }

    .media-meta-day {
      -webkit-box-pack: justify;
      justify-content: space-between;
      -webkit-box-align: center;
      align-items: center;
      margin-bottom: 0;
      color: #8b95a5;
      opacity: .8;
      font-weight: 400;
    }

    .media {
      padding: 16px 12px;
      -webkit-transition: background-color .2s linear;
      transition: background-color .2s linear;
    }

    .media-meta-day::before {
      margin-right: 16px;
    }

    .media-meta-day::before,
    .media-meta-day::after {
      content: '';
      -webkit-box-flex: 1;
      flex: 1 1;
      border-top: 1px solid #ebebeb;
    }

    .media-meta-day::after {
      content: '';
      -webkit-box-flex: 1;
      flex: 1 1;
      border-top: 1px solid #ebebeb;
    }

    .media-meta-day::after {
      margin-left: 16px;
    }

    .media-chat.media-chat-reverse {
      padding-right: 12px;
      padding-left: 64px;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: reverse;
      flex-direction: row-reverse;
    }

    .media-chat {
      padding-right: 64px;
      margin-bottom: 0;
    }

    .media {
      padding: 16px 12px;
      -webkit-transition: background-color .2s linear;
      transition: background-color .2s linear;
    }

    .media-chat.media-chat-reverse .media-body p {
      float: right;
      clear: right;
      background-color: #48b0f7;
      color: #fff;
    }

    .media-chat .media-body p {
      position: relative;
      padding: 6px 8px;
      margin: 4px 0;
      background-color: #f5f6f7;
      border-radius: 3px;
    }


    .border-light {
      border-color: #f1f2f3 !important;
    }

    .bt-1 {
      border-top: 1px solid #ebebeb !important;
    }

    .publisher {
      position: relative;
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      padding: 12px 20px;
      background-color: #f9fafb;
    }

    .publisher>*:first-child {
      margin-left: 0;
    }

    .publisher>* {
      margin: 0 8px;
    }

    .publisher-input {
      -webkit-box-flex: 1;
      flex-grow: 1;
      border: none;
      outline: none !important;
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: Roboto, sans-serif;
      font-weight: 300;
    }

    .publisher-btn {
      background-color: transparent;
      border: none;
      color: #8b95a5;
      font-size: 16px;
      cursor: pointer;
      overflow: -moz-hidden-unscrollable;
      -webkit-transition: .2s linear;
      transition: .2s linear;
    }

    .file-group {
      position: relative;
      overflow: hidden;
    }

    .publisher-btn {
      background-color: transparent;
      border: none;
      color: #cac7c7;
      font-size: 16px;
      cursor: pointer;
      overflow: -moz-hidden-unscrollable;
      -webkit-transition: .2s linear;
      transition: .2s linear;
    }

    .file-group input[type="file"] {
      position: absolute;
      opacity: 0;
      z-index: -1;
      width: 20px;
    }

    .text-info {
      color: #48b0f7 !important;
    }
  </style>



  <script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
</head>

<body>

  <?php include('header.php') ?>
  <!-- END nav -->

  <section style="background-image: url('<?php echo $web_assets_base_url; ?>images/rails3.jpg');height:450px !important;background-size:cover" data-stellar-background-ratio="0.5">
    <div class="overlay" style="background-color: rgba(0,0,0,.25);width:100%;height:100%"></div>
    <div class="container">
      <div class="row no-gutters slider-text  justify-content-start" style="position:absolute;top:40%;width:100%">
        <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Train Schedule <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">About Us</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section" style="background-color: #f2f2f2;">
    <div class="container">
      <div class="row d-flex mb-5 contact-info">
        <div class="col-md-4">
          <div class="row mb-5">
            <div class="col-md-12">
              <div class="border w-100 p-4 rounded mb-2 d-flex" style="background-color:white;border:1px solid #cccccc !important">
                <div class="icon mr-3">
                  <span class="icon-map-o"></span>
                </div>
                <p><span>Address:</span> Colombo Fort railway station, Colombo, Sri Lanka</p>
              </div>
            </div>

            <div class="col-md-12" style="margin-top:10px">
              <div class="border w-100 p-4 rounded mb-2 d-flex" style="background-color:white;border:1px solid #cccccc !important">
                <div class="icon mr-3">
                  <span class="icon-mobile-phone"></span>
                </div>
                <p><span>Phone:</span> <a href="tel://1234567920">+94 11 4 600 111</a></p>
              </div>
            </div>

            <div class="col-md-12" style="margin-top:10px">
              <div class="border w-100 p-4 rounded mb-2 d-flex" style="background-color:white;border:1px solid #cccccc !important">
                <div class="icon mr-3">
                  <span class="icon-envelope-o"></span>
                </div>
                <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@trackexpress.com</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8 block-9 mb-md-5">


          <div class="col-md-12" style="background-color:white; box-shadow: 5px 5px 10px #888;">
            <div class="card card-bordered">
              <div class="card-header" style="border-color:#b3b3b3 !important;">
                <h4 class="card-title"><strong>Customer Support</strong></h4>
              </div>
              <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">

                <?php if (isset($_SESSION['customerID'])) {  ?>
                  <?php
                  $cid = $_SESSION['customerID'];
                  $result3 = $obj->get_message($cid);
                  while ($row_des2 = $result3->fetch_array()) {
                    $type = $row_des2['from'];
                    if ($type == 'admin') {
                  ?>
                      <div class="media media-chat">
                        <img class="avatar" src="<?php echo $web_assets_base_url; ?>images/logo.png" alt="...">
                        <div class="media-body">
                          <p style="color:white;background-color:#8b95a5 !important;"><?php echo $row_des2['message']; ?></p>
                          <p class="meta"><time datetime="2018"><?php echo $row_des2['time']; ?></time></p>
                        </div>
                      </div>
                    <?php } else { ?>

                      <div class="media media-chat media-chat-reverse">
                        <div class="media-body">
                          <p style="color:white;background-color:#B30F00 !important;width:80%"><?php echo $row_des2['message']; ?></p>
                          <p class="meta"><time datetime="2018"><?php echo $row_des2['time']; ?></time></p>
                        </div>
                      </div>
                  <?php }
                  } ?>

                <?php } ?>



                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                  <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                  <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                </div>
              </div>

              <form action="../controllers/Support.php?status=add&id=<?php echo $_SESSION['customerID']; ?>" method="post" style="width: 100%">
                
                <div class="publisher bt-1 border-light" style="border-color:#b3b3b3 !important;">
                  <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                  <input class="publisher-input" name="message" type="text" placeholder="Write something">
                  <input type="hidden" name="cusid" value="<?php echo $_SESSION['customerID']; ?>">
                  <button type="submit" class="publisher-btn text-info" style="color:#B30F00 !important;font-size:20px"><i class="fa fa-paper-plane"></i></button>
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>

    </div>
  </section>


  <?php include('footer.php') ?>

  <?php include('scripts.php') ?>




</body>

</html>