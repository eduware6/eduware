<?php
include 'filesLogic.php';
include './Database/Controler.php';
include 'header_student.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <!--<link rel="stylesheet" href="style.css">-->
  <title>Download files</title>
</head>
<body>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead style="color:white;background:#202020;">
    <th align="center" width="6%">ID</th>
    <th align="center" width="20%">Filename</th>
    <th align="center" width="10%">size </th>
    <th align="center" width="10%">Downloads</th>
    <th align="center" width="10%">Action</th>
</thead>
<tbody>
  <?php foreach ($files as $file): ?>
    <tr>
      <td><?php echo $file['id']; ?></td>
      <td><?php echo $file['name']; ?></td>
      <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
      <td><?php echo $file['downloads']; ?></td>
      <td><a href="downloads.php?file_id=<?php echo $file['id'] ?>">Download</a></td>
    </tr>
  <?php endforeach;?>

</tbody>
</table>

</body>
</html>
<?php
    include 'footer.php';
?>