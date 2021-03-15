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
$(function() {
  var filemanager = $('.filemanager'),
    breadcrumbs = $('.breadcrumbs'),
    fileList = filemanager.find('.data');
  // Start by fetching the file data from scan.php with an AJAX request
  $.get('scan.php', function(data) {
    var response = [data],
      currentPath = '',
      breadcrumbsUrls = [];
    var folders = [],
      files = [];
    // This event listener monitors changes on the URL. We use it to
    // capture back/forward navigation in the browser.
    $(window).on('hashchange', function() {
      goto(window.location.hash);
      // We are triggering the event. This will execute
      // this function on page load, so that we show the correct ffilolder:
    }).trigger('hashchange');
    // Hiding and showing the search box
    filemanager.find('.search').click(function() {
      var search = $(this);
      search.find('span').hide();
      search.find('input[type=search]').show().focus();
    });
    // Listening for keyboard input on the search field.
    // We are using the "input" event which detects cut and paste
    // in addition to keyboard input.
    filemanager.find('input').on('input', function(e) {
      folders = [];
      files = [];
      var value = this.value.trim();
      if (value.length) {
        filemanager.addClass('searching');
        // Update the hash on every key stroke
        window.location.hash = 'search=' + value.trim();
      } else {
        filemanager.removeClass('searching');
        window.location.hash = encodeURIComponent(currentPath);
      }
    }).on('keyup', function(e) {
      // Clicking 'ESC' button triggers focusout and cancels the search
      var search = $(this);
      if (e.keyCode == 27) {
        search.trigger('focusout');
      }
    }).focusout(function(e) {
      // Cancel the search
      var search = $(this);
      if (!search.val().trim().length) {
        window.location.hash = encodeURIComponent(currentPath);
        search.hide();
        search.parent().find('span').show();
      }
    });
    // Clicking on folders
    fileList.on('click', 'a.folders', function(e) {
      e.preventDefault();
      var nextDir = $(this).attr('href');
      if (filemanager.hasClass('searching')) {
        // Building the breadcrumbs
        breadcrumbsUrls = generateBreadcrumbs(nextDir);
        filemanager.removeClass('searching');
        filemanager.find('input[type=search]').val('').hide();
        filemanager.find('span').show();
      } else {
        breadcrumbsUrls.push(nextDir);
      }

      window.location.hash = encodeURIComponent(nextDir);
      currentPath = nextDir;
    });

    // Clicking on breadcrumbs

    breadcrumbs.on('click', 'a', function(e) {
      e.preventDefault();

      var index = breadcrumbs.find('a').index($(this)),
        nextDir = breadcrumbsUrls[index];

      breadcrumbsUrls.length = Number(index);

      window.location.hash = encodeURIComponent(nextDir);

    });

    // Navigates to the given hash (path)

    function goto(hash) {

      hash = decodeURIComponent(hash).slice(1).split('=');

      if (hash.length) {
        var rendered = '';

        // if hash has search in it

        if (hash[0] === 'search') {

          filemanager.addClass('searching');
          rendered = searchData(response, hash[1].toLowerCase());

          if (rendered.length) {
            currentPath = hash[0];
            render(rendered);
          } else {
            render(rendered);
          }

        }

        // if hash is some path
        else if (hash[0].trim().length) {

          rendered = searchByPath(hash[0]);

          if (rendered.length) {

            currentPath = hash[0];
            breadcrumbsUrls = generateBreadcrumbs(hash[0]);
            render(rendered);

          } else {
            currentPath = hash[0];
            breadcrumbsUrls = generateBreadcrumbs(hash[0]);
            render(rendered);
          }

        }

        // if there is no hash
        else {
          currentPath = data.path;
          breadcrumbsUrls.push(data.path);
          render(searchByPath(data.path));
        }
      }
    }

    // Splits a file path and turns it into clickable breadcrumbs

    function generateBreadcrumbs(nextDir) {
      var path = nextDir.split('/').slice(0);
      for (var i = 1; i < path.length; i++) {
        path[i] = path[i - 1] + '/' + path[i];
      }
      return path;
    }

    // Locates a file by path

    function searchByPath(dir) {
      var path = dir.split('/'),
        demo = response,
        flag = 0;

      for (var i = 0; i < path.length; i++) {
        for (var j = 0; j < demo.length; j++) {
          if (demo[j].name === path[i]) {
            flag = 1;
            demo = demo[j].items;
            break;
          }
        }
      }

      demo = flag ? demo : [];
      return demo;
    }

    // Recursively search through the file tree

    function searchData(data, searchTerms) {

      data.forEach(function(d) {
        if (d.type === 'folder') {

          searchData(d.items, searchTerms);

          if (d.name.toLowerCase().match(searchTerms)) {
            folders.push(d);
          }
        } else if (d.type === 'file') {
          if (d.name.toLowerCase().match(searchTerms)) {
            files.push(d);
          }
        }
      });
      return {
        folders: folders,
        files: files
      };
    }

    // Render the HTML for the file manager

    function render(data) {

      var scannedFolders = [],
        scannedFiles = [];

      if (Array.isArray(data)) {

        data.forEach(function(d) {

          if (d.type === 'folder') {
            scannedFolders.push(d);
          } else if (d.type === 'file') {
            scannedFiles.push(d);
          }

        });

      } else if (typeof data === 'object') {

        scannedFolders = data.folders;
        scannedFiles = data.files;

      }

      // Empty the old result and make the new one

      fileList.empty().hide();

      if (!scannedFolders.length && !scannedFiles.length) {
        filemanager.find('.nothingfound').show();
      } else {
        filemanager.find('.nothingfound').hide();
      }

      if (scannedFolders.length) {

        scannedFolders.forEach(function(f) {

          var itemsLength = f.items.length,
            name = escapeHTML(f.name),
            icon = '<span class="icon folder"></span>';

          if (itemsLength) {
            icon = '<span class="icon folder full"></span>';
          }

          if (itemsLength == 1) {
            itemsLength += ' item';
          } else if (itemsLength > 1) {
            itemsLength += ' items';
          } else {
            itemsLength = 'Empty';
          }

          var folder = $('<li class="folders"><div onclick="delletefolder(`' + f.path + '`);" style="font-size: 22px;float: right;padding: 5px;font-weight: 900;background: #999090;"><img src="./assets/icons/svg/delete.svg" alt="" style="width: 20px;"></div><div onclick="renamefolder(`' + f.path + '`);" style="font-size: 22px;float: left;padding: 5px;font-weight: 900;background: #999090;"><img src="./assets/icons/svg/rename.svg" alt="" style="width: 20px;"></div><a href="' + f.path + '" title="' + f.path + '" class="folders">' + icon + '<span class="name">' + name + '</span> <span class="details">' + itemsLength + '</span></a></li>');
          folder.appendTo(fileList);
        });

      }

      if (scannedFiles.length) {

        scannedFiles.forEach(function(f) {

          var fileSize = bytesToSize(f.size),
            name = escapeHTML(f.name),
            fileType = name.split('.'),
            icon = '<span class="icon file"></span>';

          fileType = fileType[fileType.length - 1];

          icon = '<span class="icon file f-' + fileType + '">.' + fileType + '</span>';

          var file = $('<li class="files"><div onclick="renamefile(`' + f.path + '`);" style="font-size: 22px;float: left;padding: 5px;font-weight: 900;background: #999090;"><img src="./assets/icons/svg/rename.svg" alt="" style="width: 20px;"></div><div onclick="delletefile(`' + f.path + '`);" style="font-size: 22px;float: right;padding: 5px;font-weight: 900;background: #999090;"><img src="./assets/icons/svg/delete.svg" alt="" style="width: 20px;"></div><a class="files" onclick="open_ace(`' + f.path + '`);" title="' + f.path + '">' + icon + '<span class="name">' + name + '</span> <span class="details">' + fileSize + '</span></a></li>');
          file.appendTo(fileList);
        });
      }
      // Generate the breadcrumbs
      var url = '';
      if (filemanager.hasClass('searching')) {
        url = '<span>Search results: </span>';
        fileList.removeClass('animated');
      } else {
        fileList.addClass('animated');
        breadcrumbsUrls.forEach(function(u, i) {
          var name = u.split('/');
          if (i !== breadcrumbsUrls.length - 1) {
            url += '<a href="' + u + '"><span class="folderName">' + name[name.length - 1] + '</span></a><span class="arrow"> → </span>';
            // $("#foldername").val(u);
          } else {
            url += '<span class="folderName">' + name[name.length - 1] + '</span>';
            $("#foldername").val(u);
          }
        });
      }
      breadcrumbs.text('').append(url);
      // Show the generated elements
      fileList.animate({
        'display': 'inline-block'
      });
    }
    // This function escapes special html characters in names
    function escapeHTML(text) {
      return text.replace(/\&/g, '&amp;').replace(/\</g, '&lt;').replace(/\>/g, '&gt;');
    }
    // Convert file sizes from bytes to human readable units
    function bytesToSize(bytes) {
      var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
      if (bytes == 0) return '0 Bytes';
      var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
      return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }
  });
});

var textarea = $('textarea[name="editor"]').hide();

function aceexit() {
  $(".outer-div").css("display", "none");
  $("body").css("overflow", "auto");
}

$('#do-backup').on('click', function(evt) {
  evt.preventDefault();
  makeBackup();
});

function save_file() {
  var contents = $('textarea#adsafadsfasd').text(),
    fayl_yoli = $("input#fayl_yoli").val();
  $.ajax({
    url: "./file.php",
    type: "POST",
    data: {
      save: 'save',
      contents: contents,
      fayl_yoli: fayl_yoli
    },
    dataType: 'JSON',
    beforeSend: function() {
      $('#bajarilmoqda').show();
    },
    success: function(a) {
      //   $('#bajarilmoqda').hide();
      var fadeTimeout = 1000;
      if (a == 'demo') {
        window.msg_tmt = setTimeout(function() {
          $('#bajarilmoqda').fadeOut();
        }, fadeTimeout);
        alert("It is not possible to save the file in the demo version");
      }
      if (a.success) {
        //  $('#message').text('Fayl muvafaqiyatli saqlandi');
        clearTimeout(window.msg_tmt);
        window.msg_tmt = setTimeout(function() {
          $('#bajarilmoqda').fadeOut();
        }, fadeTimeout);
      } else {
        alert(a.error);
        $('#bajarilmoqda').hide();
        $('#error-message').show();
      }
    }
  });
}

var makeBackup = function() {
  var contents = $('textarea#adsafadsfasd').text(),
    fayl_yoli = $("input#fayl_yoli").val();

  $.ajax({
    url: "./file.php",
    method: "POST",
    data: {
      backup: 'backup',
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
        clearTimeout(window.msg_tmt);
        window.msg_tmt = setTimeout(function() {
          $('#bajarilmoqda').fadeOut();
        }, fadeTimeout);
      } else {
        alert(reply.error);
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

shortcut.add("Alt+w", function() {
  aceexit();
}, {
  'type': 'keydown',
  'propagate': false,
  'disable_in_input': false,
  'target': document
});

shortcut.add("Esc", function() {
  aceexit();
}, {
  'type': 'keydown',
  'propagate': false,
  'disable_in_input': false,
  'target': document
});

function delletefile(fayl) {
  var proceed = confirm("Are you sure you want to delete this " + fayl + " file?");
  if (proceed) {
    $.ajax({
      url: "./dellete.php",
      type: "POST",
      data: {
        fayl: fayl
      },
      dataType: "JSON",
      beforeSend: function() {
        $('textarea#adsafadsfasd').text("");
      },
      success: function(a) {
        if (a.success) {
          //$(location).attr('href', window.location.href);
          window.location.reload(true)
        } else {
          alert(a.error);
          window.location.reload(true)
        }
      }
    })
  }
}

function delletefolder(fayl) {
  var proceed = confirm("Are you sure you want to delete this " + fayl + " folder?");
  if (proceed) {
    $.ajax({
      url: "./dellete.php",
      type: "POST",
      data: {
        folder: fayl
      },
      dataType: "JSON",
      beforeSend: function() {
        $('textarea#adsafadsfasd').text("");
      },
      success: function(a) {
        if (a.success) {
          //$(location).attr('href', window.location.href);
          window.location.reload(true)
        } else {
          alert(a.error);
          window.location.reload(true)
        }
      }
    })
  }
}

function renamefolder(fayl) {
  var proceed = confirm("Are you sure you want to delete this " + fayl + " file?");
  if (proceed) {
    $.ajax({
      url: "./dellete.php",
      type: "POST",
      data: {
        fayl: fayl
      },
      dataType: "JSON",
      beforeSend: function() {
        $('textarea#adsafadsfasd').text("");
      },
      success: function(a) {
        if (a.success) {
          //$(location).attr('href', window.location.href);
          window.location.reload(true)
        } else {
          alert(a.error);
          window.location.reload(true)
        }
      }
    })
  }
}

function renamefolder(oldname) {
  var filename = prompt("Enter the folder new name:", oldname);
  if (filename == null || filename == "") {
    console.log("The file was not named")
  } else {
    $.ajax({
      url: "./rename.php",
      type: "POST",
      data: {
        newname: filename,
        oldname: oldname
      },
      dataType: "JSON",
      beforeSend: function() {},
      success: function(a) {
        if (a.success) {
          window.location.reload(true)
        } else {
          alert(a.error);
          window.location.reload(true)
        }
      }
    })
  }
}

function renamefile(oldname) {
  var filename = prompt("Enter the file new name:", oldname);
  if (filename == null || filename == "") {
    console.log("The file was not named")
  } else {
    $.ajax({
      url: "./rename.php",
      type: "POST",
      data: {
        newname: filename,
        oldfilename: oldname
      },
      dataType: "JSON",
      beforeSend: function() {},
      success: function(a) {
        if (a.success) {
          window.location.reload(true)
        } else {
          alert(a.error);
          window.location.reload(true)
        }
      }
    })
  }
}

function newfile() {
  var filename = prompt("Enter the file name:", "newfile.php");
  var foldername = $("#foldername").val();
  if (filename == null || filename == "") {
    alert("The file was not named")
  } else {
    $.ajax({
      url: "./new.php",
      type: "POST",
      data: {
        fayladd: filename,
        foldername: foldername
      },
      dataType: "JSON",
      beforeSend: function() {},
      success: function(a) {
        if (a.success) {
          open_ace(a.faylyoli);
        } else {
          alert(a.error);
          window.location.reload(true)
        }
      }
    })
  }
}

function newfolder() {
  var newfoldername = prompt("Enter the folder name:", "newfolder");
  var foldername = $("#foldername").val();
  if (newfoldername == null || newfoldername == "") {
    alert("The folder was not named")
  } else {
    $.ajax({
      url: "./new.php",
      type: "POST",
      data: {
        folder: newfoldername,
        foldername: foldername
      },
      dataType: "JSON",
      beforeSend: function() {},
      success: function(a) {
        if (a.success) {
          alert(a.success);
          window.location.reload(true);
        } else {
          alert(a.error);
          window.location.reload(true);
        }
      }
    })
  }
}

function open_ace(faylyoli) {
  $.ajax({
    url: "./file.php",
    type: "POST",
    data: {
      faylyoli: faylyoli
    },
    dataType: "JSON",
    beforeSend: function() {
      $('textarea#adsafadsfasd').text("");
    },
    success: function(question) {
      if (question.boshqacha) {
        $(location).attr('href', question.fayl_yoli);
        throw '';
      }
      if (question.file) {
        $('textarea#adsafadsfasd').text(question.file);
        $("input#fayl_yoli").val(question.fayl_yoli);

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
          editor.session.setMode("ace/mode/" + question.faylturi + "");
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
      } else {
        alert("qandaydur xatolik");
      }
    }
  });
};
