<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fayl menjr uchun parol yasovchi</title>
    <style>
      .tooltip {
      position: relative;
      display: inline-block;
      }
      .tooltip .tooltiptext {
      visibility: hidden;
      width: 140px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px;
      position: absolute;
      z-index: 1;
      bottom: 150%;
      left: 50%;
      margin-left: -75px;
      opacity: 0;
      transition: opacity 0.3s;
      }
      .tooltip .tooltiptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
      }
      .tooltip:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
      }
      .center {
      line-height: 200px;
      height: 200px;
      border: 3px solid green;
      text-align: center;
      }
      .center p {
      line-height: 1.5;
      display: inline-block;
      vertical-align: middle;
      }
    </style>
    <script>
      function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copied: " + copyText.value;
      }
      
      function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copy to clipboard";
      }
    </script>
  </head>
  <body>
    <div class="center">
      <?php if (isset($_POST['password'])) { ?>
      <input type="text" value="<?=md5(md5($_POST['password']))?>" id="myInput">
      <div class="tooltip">
        <button onclick="myFunction()" onmouseout="outFunc()">
        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
        Copy text
        </button>
      </div>
      <?php    die; } ?>
      <form action="?" method="post">
        <p>
          <input type="text" name="password" id="paassword">
          <input type="submit" name="submit" id="submit">
        </p>
      </form>
    </div>
  </body>
</html>