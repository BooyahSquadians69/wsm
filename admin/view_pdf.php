<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>
<?php
if(!isset($_SESSION)){
   session_start();
}
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] == false) {
   echo '<script>window.location.href="./index.php"</script>';
} else {

   require('../lib/fpdf/fpdf.php');
   require('../components/_dbconnect.php');

   // require('../lib/fpdf/makefont/makefont.php');
   // MakeFont('../fonts/Merriweather/Merriweather-Regular.ttf','cp1252');

   // Instantiation of FPDF class
   $pdf = new FPDF();
   $submitters = array();
   // Cover Page
   $pdf->AddPage();
   $pdf->Image('../src/img/cover.jpg', 0, 0, 210, 297);

   $pdf->AddFont('bebasneue', '', 'bebasneue.php');
   $pdf->AddFont('ubuntu', '', 'ubuntu.php');
   $pdf->AddFont('updock', '', 'updock.php');
   $pdf->AddFont('roboto', '', 'roboto.php');
   $pdf->AddFont('Merriweather', '', 'merriweather.php');
   $pdf->SetFont('bebasneue', '', 32);

   $type_list = [
      "Official News",
      "Self Help Articles",
      "Interview",
      "Story",
      "Trend",
      "Memes",
      "Roasts",
      "Other",
      "Honest Reviews",
      "Personal Experience"
   ];

   foreach ($type_list as $type) {
      $sql = 'SELECT * FROM `final_submit` WHERE `type` = "' . $type . '"';
      $res = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($res);
      if ($num !== 0) {
         $pdf->AddPage();
         $pdf->Image('../src/img/bg.jpg', 0, 0, 210, 297);
         $pdf->SetFont('updock', '', 64);
         $pdf->SetTextColor(169, 50, 38);
         $pdf->MultiCell(190, 50, $type, 0, 'C');
         $sno = 0;
         while ($row = mysqli_fetch_assoc($res)) {
            $sno = $sno + 1;
            $pdf->SetFont('Merriweather', '', 32);
            // $pdf->SetTextColor(0, 0, 0);
            $pdf->SetTextColor(36, 113, 163);
            $pdf->MultiCell(190, 20, "#" . $sno . " " . $row['heading'], 0, 'C');
            $pdf->SetTextColor(14, 102, 85);
            $pdf->MultiCell(190, 8, $row['submission'], 0, 'C');
            $pdf->MultiCell(190, 15, '', 0, 'C');
            array_push($submitters, $row['name']);
         }
      } else {
      }
   }
   if (!empty($submitters)) {
      $pdf->AddPage();
      $pdf->Image('../src/img/bg.jpg', 0, 0, 210, 297);
      $pdf->SetFont('updock', '', 64);
      $pdf->SetTextColor(169, 50, 38);
      $pdf->MultiCell(190, 50, 'Submitters', 0, 'C');
      $sno = 0;
      foreach ($submitters as $name) {
         $sno = $sno + 1;
         $pdf->SetFont('Merriweather', '', 25);
         // $pdf -> SetTextColor(14,102,85);
         $pdf->SetTextColor(36, 113, 163);
         $pdf->MultiCell(190, 10, $sno . ". " . $name, 0, 'C');
      }
   }

   $pdf->Output();
}
