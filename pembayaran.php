<?php
    $nama_barang = "";
    $jumlah_pembelian = "";
    $harga_satuan = "";
    $diskon = "";
    $total_pembayaran = "";
    $pesan_error = "";
    $tampilkan = false;

    if (isset($_POST['submit'])) {
        $nama_barang = $_POST['nama-barang'];
        $jumlah_pembelian = (int)$_POST['jumlah-pembelian'];
        $harga_satuan = (int)$_POST['harga-satuan'];

        if ($jumlah_pembelian < 1 || $harga_satuan < 1) {
            $pesan_error = "Angka tidak boleh negatif dan minimal 1!";
        } else {
            $total_harga = $harga_satuan * $jumlah_pembelian;

            if ($total_harga >= 500000) {
                $diskon = 20;
            } elseif ($total_harga >= 250000) {
                $diskon = 10;
            } else {
                $diskon = 0;
            }

            $nilai_diskon = $total_harga * ($diskon / 100);
            $total_pembayaran = $total_harga - $nilai_diskon;
            $tampilkan = true;
        }
    }
?>
<form action="" method="post">
    <label for="nama-barang" >Nama Barang</label><br>
    <input type="text" id="nama-barang" name="nama-barang" required><br>
    <label for="jumlah-pembelian" >Jumlah Pembelian</label><br>
    <input type="number" id="jumlah-pembelian" name="jumlah-pembelian" min="1" required><br>
    <label for="harga-satuan" >Harga Satuan</label><br>
    <input type="number" id="harga-satuan" name="harga-satuan" required><br><br>
    <button type="submit" name="submit">Kirim</button><br>
    <hr>
    <?php if (!empty($pesan_error)): ?>
        <h3><?php echo $pesan_error ?></h3>
    <?php endif; ?>
    <?php if ($tampilkan): ?>
        <h3>Nama barang : <?php echo htmlspecialchars($nama_barang) ?></h3>
        <h3>Jumlah barang : <?php echo $jumlah_pembelian ?></h3>
        <h3>Harga Satuan : Rp.<?php echo number_format($harga_satuan, 0, ',', '.') ?></h3>
        <h3>Total Harga : Rp.<?php echo number_format($total_harga, 0, ',', '.') ?></h3>
        <h3>Diskon : <?php echo $diskon ?>%</h3>
        <h3>Total Pembayaran : Rp.<?php echo number_format($total_pembayaran, 0, ',', '.') ?></h3>
    <?php endif; ?>
</form>