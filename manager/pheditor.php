<?php require 'classes/yadro.php';
  define('DS', '/');
  define('SHOW_PHP_SELF', false);
  define('SHOW_HIDDEN_FILES', false);
  define('PATTERN_FILES', '/^[A-Za-z0-9-_.\/]*\.(txt|php|htm|phtml|html|js|css|tpl|md|xml|json)$/i'); // empty means no pattern
  define('PATTERN_DIRECTORIES', '/^((?!backup).)*$/i'); // empty means no pattern

  function files($dir, $first = true) {
      $data = '';
      if ($first === true) {
          $data.= '<ul><li data-jstree=\'{ "opened" : true }\'><a href="#" class="open-dir" data-dir="'. MAIN_DIR .'">' . basename($dir) . '</a>';
      }
      $data.= '<ul class="files">';
      $files = array_slice(scandir($dir), 2);
      asort($files);
      foreach ($files as $key => $file) {
          if ((SHOW_PHP_SELF === false && $dir . DS . $file == __FILE__) || (SHOW_HIDDEN_FILES === false && substr($file, 0, 1) === '.')) {
              continue;
          }
          if (is_dir($dir . DS . $file) && (empty(PATTERN_DIRECTORIES) || preg_match(PATTERN_DIRECTORIES, $file))) {
              $dir_path = str_replace(MAIN_DIR . DS, '', $dir . DS . $file);
              $data.= '<li class="dir">'
              .'<a akbarali href="#' .MAIN_DIR. $dir_path . '/" class="open-dir" data-dir="../' . $dir_path . '/">' . $file . '</a>' . files($dir . DS . $file, false) . '</li>';
          } else if (empty(PATTERN_FILES) || preg_match(PATTERN_FILES, $file)) {
              $file_path = str_replace(MAIN_DIR . DS, '', $dir . DS . $file);
              $data.= '<li class="file ' . (is_writable($file_path) ? 'editable' : null) . '" data-jstree=\'{ "icon" : "jstree-file" }\'>'
              .'<a akbarali1 href="#' .MAIN_DIR. $file_path . '" data-file="../' . $file_path . '" class="open-file">' . $file . '</a></li>';
          }
      }
      $data.= '</ul>';
      if ($first === true) {
          $data.= '</li></ul>';
      }
      return $data;
  }
if (isset($_POST['action'])) {
  switch ($_POST['action']) {
      case 'reload':
          echo json_success('OK', [
              'data' => files(MAIN_DIR),
          ]);
      	exit;
          break;

  }
}
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VS Code Editor</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
   <link rel="stylesheet" href="./assets/css/stylevscode.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/jstree.min.js"></script>
    <script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
    <script src="https://ace.c9.io/build/src-noconflict/ace.js"></script>
    <script src="./assets/js/kitchen-sink/require.js"></script>
    <script src="https://ace.c9.io/build/src-noconflict/ext-language_tools.js"></script>
    <script src="./assets/js/hotkeys.js"></script>
    <script>
      $(function() {
      $("#files > div").jstree({
        state: { key: "pheditor"},
        plugins: ["state"]
      });
      });
    </script>
  </head>
  <body style=" background: #2c2b2b; color: white; ">
    <div class="container-fluid">
      <div class="row px-3">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12" style=" height: 941px; overflow: scroll; max-height: 100%; ">
          <div id="files" style="height: 344.108px;">
            <div class="card-block"><?= files(MAIN_DIR) ?></div>
          </div>
        </div>
        <div class="col-9">
          <div class="card" style="background: cadetblue;">
            <div class="savebackupedix" style=" display: -webkit-inline-box; ">
              <img src="./assets/icons/svg/savefile.svg" alt="" onclick="save_file();" style="display:block;padding: 15px;max-width: 100%;width: 60px;">
              <img src="./assets/icons/svg/exit.svg" alt="" onclick="aceexit();" style="display:block;padding: 15px;max-width: 100%;width: 60px;">
              <img src="./assets/icons/svg/backup.svg" alt="" onclick="makeBackup();"style="display:block;padding: 15px;max-width: 100%;width: 60px;">
              <img src="./assets/icons/svg/prloader.svg" alt="" id="bajarilmoqda" style="display:none;padding: 15px;max-width: 100%;width: 60px;">
              <img src="./assets/icons/svg/warning.svg" alt="The file was not saved. Refresh the page" title="The file was not saved. Refresh the page" id="error-message"
                style="display:none;padding: 15px;max-width: 100%;width: 60px;">


        <img src="./assets/icons/svg/rename.svg" id="renamefile" onclick="renamefile();" style="display: none;padding: 15px;max-width: 100%;width: 60px;right: 193px;position: absolute;">
    <img src="./assets/icons/svg/rename.svg" id="renamefolder" onclick="renamefolder();" style="display: none;padding: 15px;max-width: 100%;width: 60px;right: 193px;position: absolute;">

            <img src="./assets/icons/svg/add-file.svg" id="newfile" onclick="newfile();" style="display: none;padding: 15px;max-width: 100%;width: 60px;right: 129px;position: absolute;">
            <img src="./assets/icons/svg/new-folder.svg" id="newfolder"  onclick="newfolder();" style="display: none;padding: 15px;max-width: 100%;width: 60px;right: 66px;position: absolute;">
            <img src="./assets/icons/svg/delletefolder.svg" id="delletefolder" alt="new folder" onclick="delletefolder();" style="display: none;padding: 15px;max-width: 100%;width: 60px;right: 0px;position: absolute;">
            <img src="./assets/icons/svg/delete.svg" id="delletefile" alt="new file" onclick="delletefile();" style="display: none;padding: 15px;max-width: 100%;width: 60px;right: 0px;position: absolute;">
            </div>
            <textarea  name="editor" id="adsafadsfasd" style="width: 100%; height: 100%;"></textarea>
            <pre id="editor" style="width: 100%;font-size: 14px;height: 885px;" class="acepre"></pre>
          </div>
        </div>
      </div>
    </div>
    </div>
<script src="./assets/js/vscode.js"></script>
    <input type="hidden" id="openfilename">
    <input type="hidden" name="clickfoldername" id="clickfoldername">
    <input type="hidden" name="clickfilename" id="clickfilename">
  </body>
</html>
