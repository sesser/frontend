<!DOCTYPE html>
<html>
<head>
  <!-- needs to move down to the bottom -->
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
</head>
<body>
  <?php getTemplate()->display('header.php'); ?>
  <?php echo $body; ?>
  <?php //getTemplate()->display('footer.php'); ?>
</body>
</html>
