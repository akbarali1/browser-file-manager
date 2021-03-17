<?php require 'classes/yadro.php'; ?>
<!DOCTYPE html>
<!--
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
  -->
<html>
  <head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>File manager v<?=V?></title>
    <!-- Include our stylesheet -->
    <link href="assets/css/styles.css" rel="stylesheet"/>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
    <script src="https://ace.c9.io/build/src-noconflict/ace.js"></script>
    <script src="./assets/js/kitchen-sink/require.js"></script>
    <script src="https://ace.c9.io/build/src-noconflict/ext-language_tools.js"></script>
    <script src="./assets/js/hotkeys.js"></script>
  </head>
  <body>
    <style type="text/css" media="screen"> .ace_editor { border: 1px solid lightgray; margin: auto; height: 200px; width: 80%; } .scrollmargin { height: 80px; text-align: center; } img:hover { background: wheat; cursor: pointer; }  </style>
    <div class="outer-div" style=" display: none; ">
      <div class="inner-div">
        <div class="savebackupedix"> 
          <img src="./assets/icons/svg/savefile.svg" alt="" onclick="save_file();" style="display:block;padding: 15px;max-width: 100%;width: 90%;">
          <img src="./assets/icons/svg/exit.svg" alt="" onclick="aceexit();" style="display:block;padding: 15px;max-width: 100%;width: 90%;">
          <img src="./assets/icons/svg/backup.svg" alt="" onclick="makeBackup();"style="display:block;padding: 15px;max-width: 100%;width: 90%;">
          <img src="./assets/icons/svg/prloader.svg" alt="" id="bajarilmoqda" style="display:none;padding: 15px;max-width: 100%;width: 90%;">
          <img src="./assets/icons/svg/warning.svg" alt="The file was not saved. Refresh the page" title="The file was not saved. Refresh the page" id="error-message" 
            style="display:none;padding: 15px;max-width: 100%;width: 90%;">
        </div>
        <textarea  name="editor" id="adsafadsfasd" style="width: 100%; height: 100%;"></textarea>
        <pre id="editor" style="width: 95%; height: 99.7%" class="acepre"></pre>
        <input type="hidden" id="fayl_yoli">
      </div>
    </div>
    <div class="filemanager">
      <div class="search">
        <input type="search" placeholder="Find a file.." />
      </div>
      <div class="breadcrumbs"></div>
      <ul class="data" id="fayllar"></ul>
      <div class="nothingfound">
        <div class="nofiles"></div>
        <span>No files here.</span>
      </div>
    </div>
    <footer>
      <img src="./assets/icons/svg/add-file.svg" alt="new file" onclick="newfile();" title="new file" class="rightmenu">
      <img src="./assets/icons/svg/new-folder.svg" alt="new file" onclick="newfolder();" title="new folder" class="rightmenu">
      <img src="./assets/icons/svg/newpassword.svg" alt="new password" onclick="newpassword();" title="new password" class="rightmenu">
    </footer>
    <script src="assets/js/script.js"></script>
    <input type="hidden" id="foldername">
  </body>
</html>