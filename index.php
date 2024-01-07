<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

include("koneksi.php");

$q = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = "WHERE tanggal LIKE '%" . $q . "%' or toilet_id LIKE '%" . $q . "%' or kloset LIKE '%" . $q . "%' or wastafel LIKE '%" . $q . "%' or lantai LIKE '%" . $q . "%' or dinding LIKE '%" . $q . "%' or sabun LIKE '%" . $q . "%' or bau LIKE '%" . $q . "%' or users_id LIKE '%" . $q . "%'";
}
$title = 'Checklist Toilet';
$sql = 'SELECT * FROM checklist ';
if (isset($sql_where))
    $sql .= $sql_where;
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Uas sitem checklist</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body style="margin-top: 30px; background-color: darkblue ;">
    <div class="container" style="background-color: #6495ED ; width: 250%; padding: 10px; border-radius: 10px;">
        <br><br>
        <div class="head">
            <h1 style="color: black ;">Checklist Toilet</h1>
            <form>
                <div class="form-group" action="index.php" method="get">
                    <label for="q" style="color: black ;">Cari Data Toilet</label>
                    <input type="text" placeholder="Masukkan Pencarian" id="q" name="q" class="input-q" value="<?php echo $q ?>">
                    <button type="submit" name="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
        <div class="main">
            <table class="table table-striped table-hover">
                <tr>
                    <th style="color: black ;">Tanggal</th>
                    <th style="color: black ; width: 5%;">Kode Toilet</th>
                    <th style="color: black ;">Kloset</th>
                    <th style="color: black ;">Wastafel</th>
                    <th style="color: black ;">Lantai</th>
                    <th style="color: black ;">Dinding</th>
                    <th style="color: black ;">Kaca</th>
                    <th style="color: black ;">Bau</th>
                    <th style="color: black ;">Sabun</th>
                    <th style="color: black ;">Petugas</th>
                    <th style="color: black ; width: 5%;">ID Barang</th>
                    <th style="color: black ;">Aksi</th>
                </tr>
                <?php if ($result) : ?>
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td style="color: black ;"><?= $row['tanggal']; ?></td>
                            <td style="color: black ;"><?= $row['toilet_id']; ?></td>
                            <td style="color: black ;"><?= $row['kloset']; ?></td>
                            <td style="color: black ;"><?= $row['wastafel']; ?></td>
                            <td style="color: black ;"><?= $row['lantai']; ?></td>
                            <td style="color: black ;"><?= $row['dinding']; ?></td>
                            <td style="color: black ;"><?= $row['kaca']; ?></td>
                            <td style="color: black ;"><?= $row['bau']; ?></td>
                            <td style="color: black ;"><?= $row['sabun']; ?></td>
                            <td style="color: black ;"><?= $row['users_id']; ?></td>
                            <td style="color: black ;"><?= $row['id']; ?></td>
                            <td style="color: black ;">
                                <button class="btn" type="button" style="background-color: #09bcf3; width: 45%;"><a style="color: #FFFFFF;text-decoration: none;" href="ubah.php?id=<?= $row['id']; ?>">Ubah Data</a></button>
                                <button class="btn" type="button" style="background-color: #e4492e; width: 50%;"><a style="color: #FFFFFF;text-decoration: none;" href="hapus.php?id=<?= $row['id']; ?>">Hapus Data</a></button>
                            </td>
                        </tr>
                    <?php endwhile;
                else : ?>
                    <tr>
                        <td style="color: darkblue ;" colspan="7">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div><br><br><br>
        <div>
            <button class="btn" type="button" style="background-color: green ;"><a style="color: black; text-decoration: none; " href="tambah.php">Tambah Data Checklist</a></button>
        </div> <br>
        <div>
            <button class="btn" type="button" style="background-color: green ;"><a style="color: black ;text-decoration: none;" href="home.php">Kembali</a></button>
        </div>
    </div>
</body>

</html>