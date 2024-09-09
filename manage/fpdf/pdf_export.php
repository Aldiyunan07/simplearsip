<?php
// Include FPDF library
require('fpdf.php');
include '../../assets/configuration/konek.php';

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Function limit Text
function limitText($text, $limit)
{
  if (strlen($text) > $limit) {
    return substr(ucfirst($text), 0, $limit) . '...';
  } else {
    return ucfirst($text);
  }
}

// Function Get Date
function tanggal($tanggal)
{
  $bulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
  ];

  $tanggal_baru = date('d', strtotime($tanggal)) . ' ' . $bulan[(int)date('m', strtotime($tanggal))] . ' ' . date('Y', strtotime($tanggal));
  return $tanggal_baru;
}

if (isset($_GET['query'])) {
  switch ($_GET['query']) {
    case 'pegawai':
      $pdf->Cell(275, 10, 'Daftar Pegawai', 0, 1, 'C');
      $pdf->Ln(10);
      $data = mysqli_query($konek, "SELECT no_peg, nama_peg, nip, golongan, jabatan, alamat, no_telp, jns_kelamin FROM pegawai");

      // Set font untuk header tabel
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(25, 7, 'No Pegawai', 1, 0, 'C'); // 'C' untuk center
      $pdf->Cell(50, 7, 'Nama Pegawai', 1, 0, 'C');
      $pdf->Cell(30, 7, 'NIP', 1, 0, 'C');
      $pdf->Cell(30, 7, 'Golongan', 1, 0, 'C');
      $pdf->Cell(40, 7, 'Jabatan', 1, 0, 'C');
      $pdf->Cell(40, 7, 'Alamat', 1, 0, 'C');
      $pdf->Cell(30, 7, 'No Telpon', 1, 0, 'C');
      $pdf->Cell(30, 7, 'Jenis Kelamin', 1, 0, 'C');
      $pdf->Ln();

      // Set font untuk isi tabel
      $pdf->SetFont('Arial', '', 10);
      foreach ($data as $row) {
        $pdf->Cell(25, 6, limitText($row['no_peg'], 10), 1, 0); // Align center
        $pdf->Cell(50, 6, limitText($row['nama_peg'], 25), 1, 0);
        $pdf->Cell(30, 6, limitText($row['nip'], 12), 1, 0);
        $pdf->Cell(30, 6, limitText($row['golongan'], 12), 1, 0);
        $pdf->Cell(40, 6, limitText($row['jabatan'], 20), 1, 0);
        $pdf->Cell(40, 6, limitText($row['alamat'], 18), 1, 0);
        $pdf->Cell(30, 6, limitText($row['no_telp'], 12), 1, 0);
        $pdf->Cell(30, 6, limitText($row['jns_kelamin'], 12), 1, 0);
        $pdf->Ln();
      }

      break;
    case 'sumas':
      $pdf->Cell(275, 10, 'Data Surat Masuk', 0, 1, 'C'); // Judul di tengah (menyesuaikan panjang halaman)
      $pdf->Ln(10); // Line break
      $data = mysqli_query($konek, "SELECT kd_sumas, no_sumas, tgl_sumas, jns_sumas, judul, instansi, penerima FROM surat_masuk");

      // Set font untuk header tabel
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(35, 7, 'Kode SUMAS', 1, 0, 'C'); // 'C' untuk center
      $pdf->Cell(40, 7, 'No Surat', 1, 0, 'C');
      $pdf->Cell(40, 7, 'Tanggal SUMAS', 1, 0, 'C');
      $pdf->Cell(40, 7, 'Jenis SUMAS', 1, 0, 'C');
      $pdf->Cell(45, 7, 'Judul', 1, 0, 'C');
      $pdf->Cell(50, 7, 'Instansi', 1, 0, 'C');
      $pdf->Cell(25, 7, 'Penerima', 1, 0, 'C');
      $pdf->Ln();

      // Set font untuk isi tabel
      $pdf->SetFont('Arial', '', 10);
      foreach ($data as $row) {
        $pdf->Cell(35, 6, limitText($row['kd_sumas'], 18), 1, 0); // Align center
        $pdf->Cell(40, 6, limitText($row['no_sumas'], 18), 1, 0); // Align center
        $pdf->Cell(40, 6, limitText(tanggal($row['tgl_sumas']), 20), 1, 0); // Align center
        $pdf->Cell(40, 6, limitText($row['jns_sumas'], 18), 1, 0); // Align center
        $pdf->Cell(45, 6, limitText($row['judul'], 22), 1, 0); // Align center
        $pdf->Cell(50, 6, limitText($row['instansi'], 25), 1, 0); // Align center
        $pdf->Cell(25, 6, limitText(substr($row['penerima'], 0, 6), 50), 1, 0); // Align center
        $pdf->Ln();
      }

      break;
    case 'sukel':
      $pdf->Cell(275, 10, 'Data Surat Keluar', 0, 1, 'C'); // Judul di tengah (menyesuaikan panjang halaman)
      $pdf->Ln(10); // Line break
      $data = mysqli_query($konek, "SELECT kd_sukel, no_sukel,tgl_sukel, instansi, judul_sukel, isi_sukel FROM surat_keluar");

      // Set font untuk header tabel
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(35, 7, 'Kode SUKEL', 1, 0, 'C'); // 'C' untuk center
      $pdf->Cell(40, 7, 'No Surat', 1, 0, 'C');
      $pdf->Cell(40, 7, 'Tanggal SUKEL', 1, 0, 'C');
      $pdf->Cell(50, 7, 'Instansi', 1, 0, 'C');
      $pdf->Cell(50, 7, 'Judul SUKEL', 1, 0, 'C');
      $pdf->Cell(60, 7, 'Isi', 1, 0, 'C');
      $pdf->Ln();

      // Set font untuk isi tabel
      $pdf->SetFont('Arial', '', 10);
      foreach ($data as $row) {
        $pdf->Cell(35, 6, limitText($row['kd_sukel'], 50), 1, 0); // Align center
        $pdf->Cell(40, 6, limitText($row['no_sukel'], 50), 1, 0); // Align center
        $pdf->Cell(40, 6, limitText(tanggal($row['tgl_sukel']), 50), 1, 0); // Align center
        $pdf->Cell(50, 6, limitText($row['instansi'], 25), 1, 0); // Align center
        $pdf->Cell(50, 6, limitText($row['judul_sukel'], 25), 1, 0); // Align center
        $pdf->Cell(60, 6, limitText($row['isi_sukel'], 30), 1, 0); // Align center
        $pdf->Ln();
      }

      break;
    case 'disposisi':
      $pdf->Cell(275, 10, 'Data Disposisi', 0, 1, 'C'); // Judul di tengah (menyesuaikan panjang halaman)
      $pdf->Ln(10); // Line break
      $data = mysqli_query($konek, "SELECT no_disposisi, tgl_dispo, penerima, judul, catatan, pengirim FROM disposisi");

      // Set font untuk header tabel
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(35, 7, 'No Disposisi', 1, 0, 'C'); // 'C' untuk center
      $pdf->Cell(40, 7, 'Tanggal Disposisi', 1, 0, 'C');
      $pdf->Cell(25, 7, 'Penerima', 1, 0, 'C');
      $pdf->Cell(25, 7, 'Pengirim', 1, 0, 'C');
      $pdf->Cell(60, 7, 'Judul', 1, 0, 'C');
      $pdf->Cell(90, 7, 'Catatan', 1, 0, 'C');
      $pdf->Ln();

      // Set font untuk isi tabel
      $pdf->SetFont('Arial', '', 10);
      foreach ($data as $row) {
        $pdf->Cell(35, 6, limitText($row['no_disposisi'], 50), 1, 0); // Align center
        $pdf->Cell(40, 6, limitText(tanggal($row['tgl_dispo']), 50), 1, 0); // Align center
        $pdf->Cell(25, 6, limitText($row['penerima'], 6), 1, 0); // Align center
        $pdf->Cell(25, 6, limitText($row['pengirim'], 6), 1, 0); // Align center
        $pdf->Cell(60, 6, limitText($row['judul'], 30), 1, 0); // Align center
        $pdf->Cell(90, 6, limitText($row['catatan'], 45), 1, 0); // Align center
        $pdf->Ln();
      }
      break;
    default:
      // Code lainnya
      break;
  }
}

// Output PDF ke browser
$pdf->Output();
