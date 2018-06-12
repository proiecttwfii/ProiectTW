<!-- <?php echo '<?xml verion="1.0" encoding="UTF-8" ?>'?> -->
<?php  require 'db.php';

$limit = (isset($_GET['limit'])===true && (int)$_GET['limit'] <= 30 && (int)$_GET['limit'] !=0) ? (int)$_GET['limit']:10;

$runde = $mysqli->query("SELECT * FROM runde WHERE runda_activa = 0 ORDER BY data_stop_runda DESC LIMIT $limit");

if ($mysqli->affected_rows >=1) { ?>
  <rss version="2.0">
    <channel>
      <title> ProGnosiX </title>
      <description> RSS Feed </description>
      <link> grades.php </link>

      <?php
      while ($row = $runde->fetch_assoc()) {
        $materii = $mysqli->query("SELECT * FROM materie where id_materie = ".$row["id_materie"]." ");
        $materie = $materii->fetch_assoc();
        ?>
        <item>
          <title> <?php echo 'Rezultate' . ' ' . $materie['nume_materie'] . ' ' .$row['nume_runda']?> </title>
          <description> <?php echo 'S-au afisat rezultatele la' . ' ' . $materie['nume_materie'] . ' ' .$row['nume_runda']?> </description>
          <link> grades.php </link>
          <pubDate> <?php echo date("D, d M Y H:i:s O", strtotime($row['data_stop_runda']))?> </pubDate>
        </item>
      <?php } ?>
    </channel>
  </rss>
<?php } ?>
