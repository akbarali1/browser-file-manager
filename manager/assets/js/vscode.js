  // setup paths
  require.config({
    paths: {
     "ace": "./assets/js/lib/ace"
    }
    });
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
    editor.getSession().on('change', function() {
     textarea.val(editor.getSession().getValue());
    });
    
    editor.commands.addCommand({
     name: "showKeyboardShortcuts",
     bindKey: {
       win: "Ctrl-Alt-h",
       mac: "Command-Alt-h"
     },
     exec: function(editor) {
       ace.config.loadModule("ace/ext/keybinding_menu", function(module) {
         module.init(editor);
         editor.showKeyboardShortcuts()
       })
     }
    })
    });

function save_file() {
var contents = $('textarea#adsafadsfasd').text(),
  fayl_yoli = $("input#openfilename").val();
$.ajax({
  url: "./api.php",
  type: "POST",
  data: {
    action: "save-file",
    contents: contents,
    fayl_yoli: fayl_yoli
  },
  dataType: 'JSON',
  beforeSend: function() {
    $('#bajarilmoqda').show();
  },
  success: function(a) {
    var fadeTimeout = 1000;
    if (a.success) {
      $('#error-message').hide();
      clearTimeout(window.msg_tmt);
      window.msg_tmt = setTimeout(function() {
        $('#bajarilmoqda').fadeOut();
      }, fadeTimeout);
    } else {
      alert(a.message);
      $('#bajarilmoqda').hide();
      $('#error-message').show();
    }
  }
});
}
    function reloadFiles(hash) {
    $.ajax({
     url: window.location.href,
     type: "POST",
     data: {
       action: "reload"
     },
     dataType: 'JSON',
     success: function(data) {
       $("#files > div").jstree("destroy");
       $("#files > div").html(data.data);
       $("#files > div").jstree();
      // $("#files > div a:first").click();
       if (hash) {
         $("#files a[data-file=\"" + hash + "\"], #files a[data-dir=\"" + hash + "\"]").click();
       }
     }
    });
    }
    
    $("#files").on("click", "a[data-file]", function() {
      var foldername = $(this).attr("data-file");

      $("#renamefolder").hide();
      $("#renamefile").show();

      $("#newfolder").hide();
      $("#clickfilename").val(foldername);
      $("#delletefolder").hide();
      $("#delletefile").show();
      $("#newfile").show();
    });

$("#files").on("dblclick", "a[data-file]", function() {
    var faylyoli = $(this).attr("data-file");
    $("#renamefolder").hide();
    $("#renamefile").show();
    $("#openfilename").val(faylyoli);
    $("#newfolder").hide();
    $("#newfile").show();
    $("#delletefolder").hide();
    $("#delletefile").show();
    open_ace(faylyoli);
});

$(document).on('click', 'a[data-dir]', function(e) {
      var foldername = $(this).attr("data-dir");
      $("#renamefile").hide();
    $("#renamefolder").show();
      $("#newfolder").show();
      $("input#clickfoldername").val(foldername);
      $("#newfile").show();
      $("#delletefile").hide();
      $("#delletefolder").show();
     console.log(foldername);
});

function open_ace(faylyoli) {
$.ajax({
  url: "./api.php",
  type: "POST",
  data: {
    action: "open-file",
    faylyoli: faylyoli
  },
  dataType: "JSON",
  beforeSend: function() {
    $('textarea#adsafadsfasd').text("");
  },
  success: function(a) {
    if (a.data.faylturi) {
      $('textarea#adsafadsfasd').text(a.data.file);
      $("input#fayl_yoli").val(a.data.fayl_yoli);
      require.config({
        paths: {
          "ace": "./assets/js/lib/ace"
        }
      });
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
        ace.require('ace/ext/settings_menu').init(editor);
        editor.session.setMode("ace/mode/" + a.data.faylturi);
       // enable emmet on the current editor
        editor.setOption("enableEmmet", true);
        editor.setOption("wrap", true);
        editor.setValue($('textarea#adsafadsfasd').text());
        editor.getSession().on('change', function() {
          $('textarea#adsafadsfasd').text(editor.getSession().getValue());
        });
        editor.commands.addCommand({
          name: "showKeyboardShortcuts",
          bindKey: {
            win: "Ctrl-Alt-h",
            mac: "Command-Alt-h"
          },
          exec: function(editor) {
            ace.config.loadModule("ace/ext/keybinding_menu", function(module) {
              module.init(editor);
              editor.showKeyboardShortcuts()
            })
          }
        })
      });
      $('body,html').animate({
        scrollTop: 5
      }, 500);
      $(".outer-div").css("display", "flex");
      $("body").css("overflow", "hidden");
    } else if (a.data.boshqacha) {
      $(location).attr('href', a.data.fayl_yoli);
    } else {
      alert(a.message);
    }
  }
});
};

function delletefile() {
var fayl = $("#clickfilename").val();
var clickfoldername = $("#clickfoldername").val();
var proceed = confirm("Are you sure you want to delete this " + fayl + " file?");
if (proceed) {
  $.ajax({
    url: "./api.php",
    type: "POST",
    data: {
      action: "dellete-file",
      fayl: fayl
    },
    dataType: "JSON",
    beforeSend: function() {
      $('textarea#adsafadsfasd').text("");
    },
    success: function(a) {
      if (a.success) {
        reloadFiles(clickfoldername);
      } else {
        alert(a.message);
        reloadFiles(clickfoldername);
      }
    }
  })
}
}

function delletefolder() {
var fayl = $("#clickfoldername").val();
var proceed = confirm("Are you sure you want to delete this " + fayl + " folder?");
if (proceed) {
  $.ajax({
    url: "./api.php",
    type: "POST",
    data: {
      action: "dellete-folder",
      folder: fayl
    },
    dataType: "JSON",
    beforeSend: function() {
      $('textarea#adsafadsfasd').text("");
    },
    success: function(a) {
      if (a.success) {
        reloadFiles();
      } else {
        alert(a.message);
        reloadFiles();
      }
    }
  })
}
}

function renamefolder() {
  var oldname = $("#clickfoldername").val();
var filename = prompt("Enter the folder new name:", oldname);
if (filename == null || filename == "") {
  console.log("The file was not named")
} else {
  $.ajax({
    url: "./api.php",
    type: "POST",
    data: {
      action: 'rename-folder',
      newname: filename,
      oldname: oldname
    },
    dataType: "JSON",
    beforeSend: function() {},
    success: function(a) {
      if (a.success) {
        reloadFiles(filename);
      } else {
        alert(a.message)
        reloadFiles(oldname);
      }
    }
  })
}
}

function renamefile() {
  var oldname = $("#clickfilename").val();
var filename = prompt("Enter the file new name:", oldname);
if (filename == null || filename == "") {
  console.log("The file was not named")
} else {
  $.ajax({
    url: "./api.php",
    type: "POST",
    data: {
      action: 'rename-file',
      newname: filename,
      oldfilename: oldname
    },
    dataType: "JSON",
    beforeSend: function() {},
    success: function(a) {
      if (a.success) {
        reloadFiles(filename);
      } else {
        alert(a.message);
        reloadFiles(oldfilename);
      }
    }
  })
}
}

function newfile() {
var filename = prompt("Enter the file name:", "newfile.php");
var foldername = $("#clickfoldername").val();
if (filename == null || filename == "") {
  console.log("The file was not named")
} else {
  $.ajax({
    url: "./api.php",
    type: "POST",
    data: {
      action: 'new-file',
      filename: filename,
      foldername: foldername
    },
    dataType: "JSON",
    beforeSend: function() {},
    success: function(a) {
      if (a.success) {
        reloadFiles(foldername);
        open_ace(a.data.fileopen);
        $("#openfilename").val(a.data.faylyoli);
        var hash = window.location.hash;
        if (hash) {
          $("#files a[data-file=\"" + hash + "\"], #files a[data-dir=\"" + hash + "\"]").click();
        }
      }else{
      reloadFiles(foldername);
        alert(a.message);
      }
    }
  })
}
}

function newfolder() {
var newfoldername = prompt("Enter the folder name:", "newfolder");
var foldername = $("#clickfoldername").val();
if (newfoldername == null || newfoldername == "") {
  console.log("The folder was not named")
} else {
  $.ajax({
    url: "./api.php",
    type: "POST",
    data: {
      action: 'new-folder',
      folder: newfoldername,
      foldername: foldername
    },
    dataType: "JSON",
    success: function(a) {
      if (a.success) {
        reloadFiles(foldername);
    var hash = window.location.hash;
              if (hash) {
                  $("#files a[data-file=\"" + hash + "\"], #files a[data-dir=\"" + hash + "\"]").click();
              }
    }else{
        reloadFiles(foldername);
        alert(a.message);
      }
    }
  })
}
}

var makeBackup = function() {
  var contents = $('textarea#adsafadsfasd').text(), fayl_yoli = $("input#openfilename").val();
  $.ajax({
    url: "./api.php",
    method: "POST",
    data: {
      action: 'backup',
      contents: contents,
      fayl_yoli: fayl_yoli
    },
    dataType: 'JSON',
    beforeSend: function() {
      $('#bajarilmoqda').show();
    },
    success: function(reply) {
      var fadeTimeout = 1000;
      if (reply.success) {
        reloadFiles(fayl_yoli);
        clearTimeout(window.msg_tmt);
        window.msg_tmt = setTimeout(function() {
          $('#bajarilmoqda').fadeOut();
        }, fadeTimeout);
      } else {
        reloadFiles(fayl_yoli);
        alert(reply.message);
        $('#bajarilmoqda').hide();
        $('#error-message').show();
      }
    }
  });
}

  shortcut.add("Ctrl+s", function() {
  save_file();
  }, {
  'type': 'keydown',
  'propagate': false,
  'disable_in_input': false,
  'target': document
  });
  
 shortcut.add("shift+h", function() {
  var hash = window.location.hash;
     alert(hash);
  },{
  'type': 'keydown',
  'propagate': false,
  'disable_in_input': false,
  'target': document
  });

  shortcut.add("Shift+f12", function() {
  save_file();
  }, {
  'type': 'keydown',
  'propagate': false,
  'disable_in_input': false,
  'target': document
  });
  
  shortcut.add("Ctrl+b", function() {
  makeBackup();
  }, {
  'type': 'keydown',
  'propagate': false,
  'disable_in_input': false,
  'target': document
  });
  
  shortcut.add("Shift+r", function() {
  reloadFiles();
  }, {
  'type': 'keydown',
  'propagate': false,
  'disable_in_input': false,
  'target': document
  });

  shortcut.add("shift+delete", function() {
    delletefile();
    }, {
    'type': 'keydown',
    'propagate': false,
    'disable_in_input': false,
    'target': document
    });

    shortcut.add("f2", function() {
      renamefile();
      }, {
      'type': 'keydown',
      'propagate': false,
      'disable_in_input': false,
      'target': document
      });
      shortcut.add("f3", function() {
        renamefolder();
        }, {
        'type': 'keydown',
        'propagate': false,
        'disable_in_input': false,
        'target': document
        });

    shortcut.add("ctrl+delete", function() {
      delletefolder();
      }, {
      'type': 'keydown',
      'propagate': false,
      'disable_in_input': false,
      'target': document
      });


      shortcut.add("Shift+f", function() {
        newfile();
      }, {
        'type': 'keydown',
        'propagate': false,
        'disable_in_input': false,
        'target': document
      });
      shortcut.add("Shift+p", function() {
        newfolder();
      }, {
        'type': 'keydown',
        'propagate': false,
        'disable_in_input': false,
        'target': document
      });