<?php 
/*
 * Fayl menjr Akbarali tomonidan yozildi.
 * Yozilgan sana: 15-mart 2021 yil
 * E-mail: Akbarali@uzhackersw.uz
 * Telegram: @kbarali
 * Those who want to sponsor: Webmoney WMR: R853215959425, Webmoney WMZ: Z401474330355, Webmoney WMY: Y194307290426
 * If you want to sponsor and do not have a Webmoney wallet, write to my e-mail or Telegram
 * Github repository: https://github.com/akbarali1/file-menjr
 * Johncms theme link: https://johncms.com/forum/?type=topic&id=12302
 * Johncms Profile Link: https://johncms.com/profile/?user=38217
 * Uzfor theme link: https://uzfor.uz/view.php?id=90892&page=1
 * Uzfor Profile link: https://uzfor.uz/profile.php?user=87
 */
  $loginpage = 'loginpage'; 
  require 'classes/yadro.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File manager <?=V?></title>
  </head>
  <style>/*! CSS Used from: http://betta.questa.uz/themes/questa/assets/css/bootstrap.min.css?v=1615321073 */ :root{--bs-blue:#0d6efd;--bs-indigo:#6610f2;--bs-purple:#6f42c1;--bs-pink:#d63384;--bs-red:#dc3545;--bs-orange:#fd7e14;--bs-yellow:#ffc107;--bs-green:#198754;--bs-teal:#20c997;--bs-cyan:#0dcaf0;--bs-white:#fff;--bs-gray:#6c757d;--bs-gray-dark:#343a40;--bs-primary:#0d6efd;--bs-secondary:#6c757d;--bs-success:#198754;--bs-info:#0dcaf0;--bs-warning:#ffc107;--bs-danger:#dc3545;--bs-light:#f8f9fa;--bs-dark:#212529;--bs-font-sans-serif:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--bs-font-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--bs-gradient:linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));} *,::after,::before{box-sizing:border-box;} @media (prefers-reduced-motion:no-preference){ :root{scroll-behavior:smooth;} } body{margin:0;font-family:var(--bs-font-sans-serif);font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent;} [tabindex="-1"]:focus:not(:focus-visible){outline:0!important;} h1{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;} h1{font-size:calc(1.375rem + 1.5vw);} @media (min-width:1200px){ h1{font-size:2.5rem;} } ul{padding-left:2rem;} ul{margin-top:0;margin-bottom:1rem;} a{color:#0d6efd;text-decoration:underline;} a:hover{color:#0a58ca;} button{border-radius:0;} button:focus:not(:focus-visible){outline:0;} button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;} button{text-transform:none;} [type=button],[type=submit],button{-webkit-appearance:button;} ::-moz-focus-inner{padding:0;border-style:none;} .row{--bs-gutter-x:1.5rem;--bs-gutter-y:0;display:flex;flex-wrap:wrap;margin-top:calc(var(--bs-gutter-y) * -1);margin-right:calc(var(--bs-gutter-x)/ -2);margin-left:calc(var(--bs-gutter-x)/ -2);} .row>*{flex-shrink:0;width:100%;max-width:100%;padding-right:calc(var(--bs-gutter-x)/ 2);padding-left:calc(var(--bs-gutter-x)/ 2);margin-top:var(--bs-gutter-y);} @media (min-width:576px){ .col-sm-auto{flex:0 0 auto;width:auto;} } .form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;} @media (prefers-reduced-motion:reduce){ .form-control{transition:none;} } .form-control:focus{color:#212529;background-color:#fff;border-color:#86b7fe;outline:0;box-shadow:0 0 0 .25rem rgba(13,110,253,.25);} .form-control::-webkit-input-placeholder{color:#6c757d;opacity:1;} .form-control::-moz-placeholder{color:#6c757d;opacity:1;} .form-control::placeholder{color:#6c757d;opacity:1;} .form-control:disabled{background-color:#e9ecef;opacity:1;} .btn{display:inline-block;font-weight:400;line-height:1.5;color:#212529;text-align:center;text-decoration:none;vertical-align:middle;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;} @media (prefers-reduced-motion:reduce){ .btn{transition:none;} } .btn:hover{color:#212529;} .btn:focus{outline:0;box-shadow:0 0 0 .25rem rgba(13,110,253,.25);} .btn:disabled{pointer-events:none;opacity:.65;} .btn-dark{color:#fff;background-color:#212529;border-color:#212529;} .btn-dark:hover{color:#fff;background-color:#1c1f23;border-color:#1a1e21;} .btn-dark:focus{color:#fff;background-color:#1c1f23;border-color:#1a1e21;box-shadow:0 0 0 .25rem rgba(66,70,73,.5);} .btn-dark:active{color:#fff;background-color:#1a1e21;border-color:#191c1f;} .btn-dark:active:focus{box-shadow:0 0 0 .25rem rgba(66,70,73,.5);} .btn-dark:disabled{color:#fff;background-color:#212529;border-color:#212529;} .fade{transition:opacity .15s linear;} @media (prefers-reduced-motion:reduce){ .fade{transition:none;} } .fade:not(.show){opacity:0;} .nav{display:flex;flex-wrap:wrap;padding-left:0;margin-bottom:0;list-style:none;} .nav-link{display:block;padding:.5rem 1rem;text-decoration:none;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;} @media (prefers-reduced-motion:reduce){ .nav-link{transition:none;} } .nav-tabs{border-bottom:1px solid #dee2e6;} .nav-tabs .nav-link{margin-bottom:-1px;background:0 0;border:1px solid transparent;border-top-left-radius:.25rem;border-top-right-radius:.25rem;} .nav-tabs .nav-link:focus,.nav-tabs .nav-link:hover{border-color:#e9ecef #e9ecef #dee2e6;isolation:isolate;} .nav-tabs .nav-link.active{color:#495057;background-color:#fff;border-color:#dee2e6 #dee2e6 #fff;} .tab-content>.tab-pane{display:none;} .tab-content>.active{display:block;} .card{position:relative;display:flex;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem;} .card-body{flex:1 1 auto;padding:1rem 1rem;} .modal{position:fixed;top:0;left:0;z-index:1050;display:none;width:100%;height:100%;overflow:hidden;outline:0;} .modal-dialog{position:relative;width:auto;margin:.5rem;pointer-events:none;} .modal.fade .modal-dialog{transition:transform .3s ease-out;transform:translate(0,-50px);} @media (prefers-reduced-motion:reduce){ .modal.fade .modal-dialog{transition:none;} } .modal-content{position:relative;display:flex;flex-direction:column;width:100%;pointer-events:auto;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,.2);border-radius:.3rem;outline:0;} @media (min-width:576px){ .modal-dialog{max-width:500px;margin:1.75rem auto;} } .m-auto{margin:auto!important;} .mt-5{margin-top:3rem!important;} .mb-3{margin-bottom:1rem!important;} .mb-4{margin-bottom:1.5rem!important;} .text-center{text-align:center!important;} .text-dark{color:#212529!important;} .bg-light{background-color:#f8f9fa!important;} /*! CSS Used from: Embedded */ body{font-family:'Roboto Slab', serif;} /*! CSS Used fontfaces */ @font-face{font-family:'Roboto Slab';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/robotoslab/v13/BngbUXZYTXPIvIBgJJSb6s3BzlRRfKOFbvjojISmYmRjRdE.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;} @font-face{font-family:'Roboto Slab';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/robotoslab/v13/BngbUXZYTXPIvIBgJJSb6s3BzlRRfKOFbvjojISma2RjRdE.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;} @font-face{font-family:'Roboto Slab';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/robotoslab/v13/BngbUXZYTXPIvIBgJJSb6s3BzlRRfKOFbvjojISmY2RjRdE.woff2) format('woff2');unicode-range:U+1F00-1FFF;} @font-face{font-family:'Roboto Slab';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/robotoslab/v13/BngbUXZYTXPIvIBgJJSb6s3BzlRRfKOFbvjojISmbGRjRdE.woff2) format('woff2');unicode-range:U+0370-03FF;} @font-face{font-family:'Roboto Slab';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/robotoslab/v13/BngbUXZYTXPIvIBgJJSb6s3BzlRRfKOFbvjojISmYGRjRdE.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;} @font-face{font-family:'Roboto Slab';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/robotoslab/v13/BngbUXZYTXPIvIBgJJSb6s3BzlRRfKOFbvjojISmYWRjRdE.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;} @font-face{font-family:'Roboto Slab';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/robotoslab/v13/BngbUXZYTXPIvIBgJJSb6s3BzlRRfKOFbvjojISmb2Rj.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}</style>
  <body class="bg-light text-dark">
    <div class="row mt-5" style=" --bs-gutter-x: 0; ">
      <div class="m-auto" style=" width: 450px; ">
        <div class="card card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sign in</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <h1 class="text-center mb-4"></h1>
              <?php
                //  print_r($_SESSION['loginmanager']);
                if (!empty($_SESSION['loginmanager'])) {
                  header('Location: index.php');
                }
                  if (isset($_POST['password'])) {
                   if (md5(md5($_POST['password'])) != '7b00f8fc9bd0b49025a4c5e09b8ebed3') {
                       die("parol xato");
                   }else{
                       $_SESSION['loginmanager'] = '7b00f8fc9bd0b49025a4c5e09b8ebed3';
                     header('Location: index.php');
                      die;
                   }
                   die;
                  }
                  ?>
              <form method="POST">
                <div class="form-group mb-3">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <input type="submit" value="Login" class="btn btn-dark btn-block">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade ajax_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content"></div>
        </div>
      </div>
    </div>
  </body>
</html>