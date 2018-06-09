<!-- <?php echo '<?xml verion="1.0" encoding="UTF-8" ?>'?> -->
<?php  require 'db.php';

$limit = (isset($_GET['limit'])===true && (int)$_GET['limit'] <= 30 && (int)$_GET['limit'] !=0) ? (int)$_GET['limit']:10;

$runde = $mysqli->query("SELECT * FROM runde WHERE runda_activa = 0 ORDER BY data_stop_runda DESC LIMIT $limit");

if ($mysqli->affected_rows >=1) {

?>
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
      <link> http://localhost </link> //folosesti calea abs
      <pubDate> <?php echo date("D, d M Y H:i:s O", strtotime($row['data_stop_runda']))?> </pubDate>
    </item>
  <?php } ?>
  </channel>

</rss>
<?php } ?>


<!-- <?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");

    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>ProGnosiX RSS feed</title>';
    $rssfeed .= '<link>http://localhost/TW/ProGnosiX/</link>';
    $rssfeed .= '<description>ProGnosiX RSS feed</description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>Copyright (C) 2009 ProGnosiX.com</copyright>';
    $runde = $mysqli->query("SELECT * FROM runde WHERE runda_activa = 0 ORDER BY data_stop_runda DESC");
    while ($row = mysql_fetch_array($runde))
    {
        $title = $row['nume_runda'];
        $description = "S-au afisat notele la ".$title." !!";
        $link = "grades.php";
        $date = $row['data_stop_runda'];

        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $title . '</title>';
        $rssfeed .= '<description>' . $description . '</description>';
        $rssfeed .= '<link>' . $link . '</link>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($date)) . '</pubDate>';
        $rssfeed .= '</item>';
    }
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
    echo $rssfeed;
?> -->
