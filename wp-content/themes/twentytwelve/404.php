<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

//get_header(); ?>
<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
   
    <meta content="origin" name="referrer">
    <title>Server Error · MTBDoz</title>
    <style type="text/css" media="screen">
      body {
        background-color: #f1f1f1;
        margin: 0;
      }
      body,
      input,
      button {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      }

      .container { margin: 50px auto 40px auto; width: 600px; text-align: center; }

      a { color: #4183c4; text-decoration: none; }
      a:hover { text-decoration: underline; }

      h1 { letter-spacing: -1px; line-height: 60px; font-size: 60px; font-weight: 100; margin: 0px; text-shadow: 0 1px 0 #fff; }
      p { color: rgba(0, 0, 0, 0.5); margin: 10px 0 10px; font-size: 18px; font-weight: 200; line-height: 1.6em;}

      ul { list-style: none; margin: 25px 0; padding: 0; }
      li { display: table-cell; font-weight: bold; width: 1%; }

      .logo { display: inline-block; margin-top: 35px; }
      .logo-img-2x { display: none; }
      @media
      only screen and (-webkit-min-device-pixel-ratio: 2),
      only screen and (   min--moz-device-pixel-ratio: 2),
      only screen and (     -o-min-device-pixel-ratio: 2/1),
      only screen and (        min-device-pixel-ratio: 2),
      only screen and (                min-resolution: 192dpi),
      only screen and (                min-resolution: 2dppx) {
        .logo-img-1x { display: none; }
        .logo-img-2x { display: inline-block; }
      }

      #suggestions {
        margin-top: 35px;
        color: #ccc;
      }
      #suggestions a {
        color: #666666;
        font-weight: 200;
        font-size: 14px;
        margin: 0 10px;
      }

      #parallax_wrapper {
        position: relative;
        z-index: 0;
      }
      #parallax_field {
        overflow: hidden;
        position: absolute;
        left: 0;
        top: 0;
        height: 380px;
        width: 100%;
      }
      #parallax_illustration {
        display: block;
        margin: 0 auto;
        width: 940px;
        height: 380px;
        position: relative;
        overflow: hidden;
      }
      #parallax_illustration #parallax_sign {
        position: absolute;
        top: 25px;
        left: 582px;
        z-index: 10;
      }
      #parallax_illustration #parallax_octocat {
        position: absolute;
        top: 66px;
        left: 431px;
        z-index: 8;
      }
      #parallax_illustration #parallax_error_text {
        display: block;
        width: 400px;
        height: 144px;
        position: absolute;
        top: 165px;
        left: 152px;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size: 14px;
        line-height: 18px;
        background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/img/oops.png');
        background-repeat: no-repeat;
        padding: 64px 0 0 106px;
        color: #183913;
        text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.30);
        z-index: 5;
      }
      #parallax_field #parallax_bg {
        overflow: hidden;
        width: 105%;
        position: absolute;
        top: -20px;
        left: -20px;
        z-index: 1;
      }
      #parallax_illustration #parallax_error_text span {
        display: block;
        margin-left: 12px;
      }
    </style>
  </head>
  <body>

    <div id="parallax_wrapper">
      <div id="parallax_field">
        <img alt="" class="js-plaxify" data-xrange="20" data-yrange="20" height="415" id="parallax_bg" width="980" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/back.jpg">
      </div>

      <div id="parallax_illustration">
        <img alt="" class="js-plaxify" data-xrange="10" data-yrange="10" height="204" id="parallax_octocat" width="175" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/bablo.png" style="top: 66.5486px; left: 430.151px;">

        <img alt="500 Error" class="js-plaxify" data-invert="true" data-xrange="20" data-yrange="40" height="181" id="parallax_sign" width="211" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/banners.png" style="top: 22.8056px; left: 583.698px;">

        <p id="parallax_error_text" class="js-plaxify" data-xrange="25" data-yrange="25" style="top: 176.871px; left: 150.378px;">
        </p>
      </div>

      <span id="error_500"></span>
    </div>

    <div class="container">
      <p><strong>Looks like something went wrong!</strong></p>

      <p>We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing.</p>

      <div id="suggestions">
        — <a href="<?php echo get_home_url(); ?>">Back To Home</a> —
        
      </div>

      <a href="<?php echo get_home_url(); ?>" class="logo logo-img-1x">
        <img width="202" height="32" title="" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo.png">
      </a>

      
    </div>  

</body></html>