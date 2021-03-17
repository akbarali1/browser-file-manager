<?php require 'classes/yadro.php';

define('DS', DIRECTORY_SEPARATOR);
define('MAIN_DIR', '../');
define('SHOW_PHP_SELF', false);
define('SHOW_HIDDEN_FILES', false);
define('PATTERN_FILES', '/^[A-Za-z0-9-_.\/]*\.(txt|php|htm|phtml|html|js|css|tpl|md|xml|json)$/i'); // empty means no pattern
define('PATTERN_DIRECTORIES', '/^((?!backup).)*$/i'); // empty means no pattern


function json_error($message, $params = [])
{
	return json_encode(array_merge([
		'error' => true,
		'message' => $message,
	], $params), JSON_UNESCAPED_UNICODE);
}

function json_success($message, $params = [])
{
	return json_encode(array_merge([
		'error' => false,
		'message' => $message,
	], $params), JSON_UNESCAPED_UNICODE);
}

function files($dir, $first = true) {
    $data = '';
    if ($first === true) {
        $data.= '<ul><li data-jstree=\'{ "opened" : true }\'><a href="#/" class="open-dir" data-dir="/">' . basename($dir) . '</a>';
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
            $data.= '<li class="dir"><a href="#/' . $dir_path . '/" class="open-dir" data-dir="/' . $dir_path . '/">' . $file . '</a>' . files($dir . DS . $file, false) . '</li>';
        } else if (empty(PATTERN_FILES) || preg_match(PATTERN_FILES, $file)) {
            $file_path = str_replace(MAIN_DIR . DS, '', $dir . DS . $file);
            $data.= '<li class="file ' . (is_writable($file_path) ? 'editable' : null) . '" data-jstree=\'{ "icon" : "jstree-file" }\'><a href="#/' . $file_path . '" data-file="/' . $file_path . '" class="open-file">' . $file . '</a></li>';
        }
    }
    $data.= '</ul>';
    if ($first === true) {
        $data.= '</li></ul>';
    }
    return $data;
}


switch ($_POST['action']) {
    case 'reload':
        echo json_success('OK', [
            'data' => files(MAIN_DIR),
        ]);
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VS Code Editor</title>
    <style>
    /*! CSS Used from: https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/themes/default/style.min.css */ .jstree-node,.jstree-children,.jstree-container-ul{display:block;margin:0;padding:0;list-style-type:none;list-style-image:none;} .jstree-node{white-space:nowrap;} .jstree-anchor{display:inline-block;color:black;white-space:nowrap;padding:0 4px 0 1px;margin:0;vertical-align:top;} .jstree-anchor:focus{outline:0;} .jstree-anchor,.jstree-anchor:link,.jstree-anchor:visited,.jstree-anchor:hover,.jstree-anchor:active{text-decoration:none;color:inherit;} .jstree-icon{display:inline-block;text-decoration:none;margin:0;padding:0;vertical-align:top;text-align:center;} .jstree-icon:empty{display:inline-block;text-decoration:none;margin:0;padding:0;vertical-align:top;text-align:center;} .jstree-ocl{cursor:pointer;} .jstree-leaf>.jstree-ocl{cursor:default;} .jstree .jstree-open>.jstree-children{display:block;} .jstree-anchor>.jstree-themeicon{margin-right:2px;} .jstree-default .jstree-node,.jstree-default .jstree-icon{background-repeat:no-repeat;background-color:transparent;} .jstree-default .jstree-anchor{transition:background-color .15s,box-shadow .15s;} .jstree-default .jstree-clicked{background:#beebff;border-radius:2px;box-shadow:inset 0 0 1px #999999;} .jstree-default .jstree-node{min-height:24px;line-height:24px;margin-left:24px;min-width:24px;} .jstree-default .jstree-anchor{line-height:24px;height:24px;} .jstree-default .jstree-icon{width:24px;height:24px;line-height:24px;} .jstree-default .jstree-icon:empty{width:24px;height:24px;line-height:24px;} .jstree-default .jstree-node,.jstree-default .jstree-icon{background-image:url("https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/themes/default/32px.png");} .jstree-default .jstree-node{background-position:-292px -4px;background-repeat:repeat-y;} .jstree-default .jstree-last{background:transparent;} .jstree-default .jstree-open>.jstree-ocl{background-position:-132px -4px;} .jstree-default .jstree-closed>.jstree-ocl{background-position:-100px -4px;} .jstree-default .jstree-leaf>.jstree-ocl{background-position:-68px -4px;} .jstree-default .jstree-themeicon{background-position:-260px -4px;} .jstree-default .jstree-themeicon-custom{background-color:transparent;background-image:none;background-position:0 0;} .jstree-default .jstree-file{background:url("https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/themes/default/32px.png") -100px -68px no-repeat;} .jstree-default>.jstree-container-ul>.jstree-node{margin-left:0;margin-right:0;}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
    state: {
      key: "pheditor"
    },
    plugins: ["state"]
  });
  $("#files").on("click", ".jstree-anchor", function() {
    location.href = $(this).attr("href");
});
  });
      
</script>
</head>
<style type="text/css" media="screen"> .ace_editor { border: 1px solid lightgray; margin: auto; height: 200px; width: 80%; } .scrollmargin { height: 80px; text-align: center; } img:hover { background: wheat; cursor: pointer; }  </style>
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
        </div>
        <textarea  name="editor" id="adsafadsfasd" style="width: 100%; height: 100%;"></textarea>
        <pre id="editor" style="width: 100%;font-size: 14px;height: 885px;" class="acepre"></pre>
        <input type="hidden" id="fayl_yoli">
    </div>
    </div>

</div>
</div>

</div>

<script>
      // setup paths
      require.config({paths: {"ace": "./assets/js/lib/ace"}});
      // load ace and extensions
      require(["ace/ace", "ace/ext/emmet", "ace/ext/settings_menu", "ace/ext/language_tools"], function(ace) {
          var editor = ace.edit("editor");
            editor.setOptions({
             copyWithEmptySelection: true,
             enableSnippets: true,
             enableBasicAutocompletion: true,
             enableLiveAutocompletion: true,
             fontSize: "14px",
            });
          editor.setTheme("ace/theme/tomorrow_night_eighties");
          var textarea = $('textarea[name="editor"]').hide();
           ace.require('ace/ext/settings_menu').init(editor);
          editor.session.setMode("ace/mode/php");
          // enable emmet on the current editor
          editor.setOption("enableEmmet", true);
    editor.setOption("wrap", true);
      editor.getSession().setValue(textarea.val());
      editor.getSession().on('change', function(){
      textarea.val(editor.getSession().getValue());
      });
      
      
      editor.commands.addCommand({
        name: "showKeyboardShortcuts",
        bindKey: {win: "Ctrl-Alt-h", mac: "Command-Alt-h"},
        exec: function(editor) {
            ace.config.loadModule("ace/ext/keybinding_menu", function(module) {
                module.init(editor);
                editor.showKeyboardShortcuts()
            })
        }
      })
     });
      var makeBackup = function() {
         var params = {
              action: 'backup',
              path:   '/home/admin/.bashrc'
          };
          
          $.ajax({url: "/file_manager/fm_api.php", 
              method: "POST",
              data:   params,
              dataType: 'JSON',
              beforeSend: function() {$('#bajarilmoqda').show();},
              success: function(reply) {
               $('#bajarilmoqda').hide();
                  var fadeTimeout = 3000;
                  if (reply.result) {
                      $('#message').text('File backed up as ' + reply.filename);
                      clearTimeout(window.msg_tmt);
                      $('#message').show();
                      window.msg_tmt = setTimeout(function() {$('#message').fadeOut();}, fadeTimeout);
                  }
                  else {
                      $('#error-message').text(reply.message);
                      clearTimeout(window.errmsg_tmt);
                      $('#error-message').show();
                      window.errmsg_tmt = setTimeout(function() {$('#error-message').fadeOut();}, fadeTimeout);
                  }
              }
          });
      }
      
      $('#do-backup').on('click', function(evt) {
          evt.preventDefault();
          makeBackup();
      });

      $('.jstree-clicked').on('click', function() {
         aler("ha");
      });
      

      

          function save_file(){
           var pagelink = window.location.href;
             var contents = $('textarea[name="editor"]').val();
             $.ajax({
                 url: pagelink,
                 type: "POST",
                 data: { save:'save', contents:contents},
                 beforeSend: function() {$('#bajarilmoqda').show();},
                 success: function (a) {
                  $('#bajarilmoqda').hide();
                  var fadeTimeout = 3000;
                    if(a == 'saqlandi'){
                      $('#message').text('Fayl muvafaqiyatli saqlandi');
                      clearTimeout(window.msg_tmt);
                      $('#message').show();
                      window.msg_tmt = setTimeout(function() {$('#message').fadeOut();}, fadeTimeout);
                    }else{
                     $('#error-message').text('Fayl saqlanmadi nimagaligini bilmadim');
                      clearTimeout(window.errmsg_tmt);
                      $('#error-message').show();
                      window.errmsg_tmt = setTimeout(function() {$('#error-message').fadeOut();}, fadeTimeout);
                    }
                 }
             });
         }
      
      shortcut.add("Ctrl+s",function() {
        save_file();
      },{
          'type':             'keydown',
          'propagate':        false,
          'disable_in_input': false,
          'target':           document
      });
      
      shortcut.add("Shift+f12",function() {
        save_file();
      },{
          'type':             'keydown',
          'propagate':        false,
          'disable_in_input': false,
          'target':           document
      });
      
      shortcut.add("Ctrl+b",function() {
          makeBackup();
      },{
          'type':             'keydown',
          'propagate':        false,
          'disable_in_input': false,
          'target':           document
      });


      shortcut.add("Shift+r",function() {
        reloadFiles();
      },{
          'type':             'keydown',
          'propagate':        false,
          'disable_in_input': false,
          'target':           document
      });

      function reloadFiles(hash) {
			$.post("<?= $_SERVER['PHP_SELF'] ?>", {
				action: "reload"
			}, function(data) {
				$("#files > div").jstree("destroy");
				$("#files > div").html(data.data);
				$("#files > div").jstree();
				$("#files > div a:first").click();
				$("#path").html("");


				if (hash) {
					$("#files a[data-file=\"" + hash + "\"], #files a[data-dir=\"" + hash + "\"]").click();
				}
			});
		}
    </script>
</body>
</html>