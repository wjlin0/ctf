<!DOCTYPE html>
<head>
    <title>
        你发现我了
    </title>
</head>

<body>
<!-- flag{********************************} -->
<script>
  // 禁用 F12
  document.onkeydown = function (e) {
    if (event.keyCode == 123) {
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
      return false;
    }
  };

  // 禁用右键菜单
  document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
  });
</script>

</body>

</html>