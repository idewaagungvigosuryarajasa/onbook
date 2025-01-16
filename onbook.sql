create database onbook; 
use onbook;

CREATE TABLE produk (
    id_produk INT(11) NOT NULL,
    nama_produk VARCHAR(100) NOT NULL,
    harga_produk INT(11) NOT NULL,
    berat_produk INT(11) NOT NULL,
    foto_produk VARCHAR(100) NOT NULL,
    deskripsi_produk TEXT NOT NULL,
    resep_produk VARCHAR(100) NOT NULL,
    stok_produk INT(5) NOT NULL,
    PRIMARY KEY (id_produk)
);

-- Tabel Pelanggan
CREATE TABLE pelanggan (
    id_pelanggan INT(11) NOT NULL,
    gmail_pelanggan VARCHAR(100) NOT NULL,
    password_pelanggan VARCHAR(50) NOT NULL,
    nama_pelanggan VARCHAR(100) NOT NULL,
    telepon_pelanggan VARCHAR(25) NOT NULL,
    PRIMARY KEY (id_pelanggan)
);

-- Tabel Kurir
CREATE TABLE kurir (
    id_kurir INT(50) NOT NULL,
    nama_kurir VARCHAR(100) NOT NULL,
    tarif INT(50) NOT NULL,
    PRIMARY KEY (id_kurir)
);

-- Tabel Pembelian
CREATE TABLE pembelian (
    id_pembelian INT(11) NOT NULL,
    id_pelanggan INT(11) NOT NULL,
    id_kurir INT(11) NOT NULL,
    tanggal_pembelian DATE NOT NULL,
    total_pembelian INT(11) NOT NULL,
    nama_kurir VARCHAR(100) NOT NULL,
    tarif INT(11) NOT NULL,
    alamat_pengiriman TEXT NOT NULL,
    status_pembelian VARCHAR(100) NOT NULL DEFAULT 'Tertunda',
    resi_pengiriman VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_pembelian),
    CONSTRAINT fk_pembelian_pelanggan FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_pembelian_kurir FOREIGN KEY (id_kurir) REFERENCES kurir(id_kurir) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel Pembayaran
CREATE TABLE pembayaran (
    id_pembayaran INT(11) NOT NULL,
    id_pembelian INT(11) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    bank VARCHAR(255) NOT NULL,
    jumlah INT(11) NOT NULL,
    tanggal DATE NOT NULL,
    bukti VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_pembayaran),
    CONSTRAINT fk_pembayaran_pembelian FOREIGN KEY (id_pembelian) REFERENCES pembelian(id_pembelian) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel Pembelian Produk
CREATE TABLE pembelian_produk (
    id_pembelian_produk INT(11) NOT NULL,
    id_pembelian INT(11) NOT NULL,
    id_produk INT(11) NOT NULL,
    jumlah_pembelian INT(11) NOT NULL,
    PRIMARY KEY (id_pembelian_produk),
    CONSTRAINT fk_pembelian_produk_pembelian FOREIGN KEY (id_pembelian) REFERENCES pembelian(id_pembelian) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_pembelian_produk_produk FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel Admin
CREATE TABLE admin (
    id_admin INT(11) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_admin)
);

-- Masukkan Data ke Tabel

-- Tabel Produk
INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `resep_produk`, `stok_produk`) VALUES
(1, 'The Great Gatsby', 55000, 180, 'tb1.png', 'Novel klasik karya F. Scott Fitzgerald tentang kehidupan mewah di era Roaring Twenties.', 'tb1alt.png', 7),
(2, 'Sapiens', 75000, 220, 'tb2.png', 'Buku karya Yuval Noah Harari yang merangkum sejarah manusia dari zaman purba hingga modern.', 'tb2alt.png', 7),
(3, 'Pride and Prejudice', 48000, 170, 'tb3.png', 'Novel klasik karya Jane Austen yang mengisahkan kisah cinta di era Regency.', 'tb3alt.png', 3),
(4, 'Project Hail Mary', 85000, 280, 'tb4.png', 'Novel fiksi ilmiah karya Andy Weir tentang misi penyelamatan umat manusia.', 'tb4alt.png', 0),
(5, 'The Final Girl Support Group', 62000, 190, 'tb5.png', 'Thriller psikologis karya Grady Hendrix tentang para wanita penyintas pembunuhan.', 'tb5alt.png', 6),
(6, 'Klara and the Sun', 69000, 200, 'tb6.png', 'Fiksi spekulatif karya Kazuo Ishiguro tentang robot kecerdasan buatan.', 'tb6alt.png', 5),
(7, 'The Paper Palace', 78000, 240, 'tb7.png', 'Drama keluarga karya Miranda Cowley Heller tentang cinta terlarang di Cape Cod.', 'tb7alt.png', 3),
(8, 'Doraemon: Stand By Me', 70000, 120, 'tb8.png', 'Cerita persahabatan Nobita, Doraemon, dan teman-temannya melawan rintangan masa depan.', 'tb8alt.png', 3),
(9, 'Sherlock Holmes: A Study in Scarlet', 55000, 200, 'tb9.png', 'Buku pertama serial Sherlock Holmes tentang kasus misteri pertama Holmes dan Watson.', 'tb9alt.png', 5),
(10, 'The Lord of the Rings', 90000, 250, 'tb10.png', 'Awal trilogi epik fantasi karya J.R.R. Tolkien tentang petualangan Frodo Baggins.', 'tb10alt.png', 3);

-- Tabel Admin
INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin1@example.com', 'admin123', 'Admin One'),
(2, 'admin2@example.com', 'admin456', 'Admin Two');

-- Tabel Kurir
INSERT INTO `kurir` (`id_kurir`, `nama_kurir`, `tarif`) VALUES
(1, 'J&T REG (2 Hari Kerja)', 9000),
(2, 'JNE REG (2 Hari Kerja)', 10000),
(3, 'JNE YES (1 Hari Kerja)', 24000),
(4, 'Grab Instan', 20000),
(5, 'Grab Same Day', 20000),
(6, 'Rush Delivery by Grab Express', 20000),
(7, 'GO-SEND Same Day', 20000),
(8, 'GO-SEND Instant', 20000),
(9, 'Tiki REG (2 Hari Kerja)', 8000),
(10, 'Pos Indonesia (3-5 Hari Kerja)', 12000);

-- Tabel Pelanggan
INSERT INTO `pelanggan` (`id_pelanggan`, `gmail_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(1, 'andi@example.com', 'password123', 'Andi', '081234567890'),
(2, 'budi@example.com', 'budi456', 'Budi', '082345678901');

-- Tabel Pembelian
INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_kurir`, `tanggal_pembelian`, `total_pembelian`, `nama_kurir`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(1, 1, 9, '2024-05-10', 85000, 'Tiki REG (2 Hari Kerja)', 8000, 'Jakarta', 'Lunas (Barang Terkirim)', '71616'),
(2, 2, 3, '2024-05-20', 72000, 'JNE YES (1 Hari Kerja)', 24000, 'Bandung', 'Lunas (Barang Terkirim)', '8008'),
(3, 1, 1, '2024-05-20', 105000, 'J&T REG (2 Hari Kerja)', 9000, 'Surabaya', 'Batal (Jumlah Duit Tidak Sesuai)', NULL),
(4, 2, 2, '2024-06-08', 85000, 'JNE REG (2 Hari Kerja)', 10000, 'Yogyakarta', 'Tertunda', NULL);

-- Tabel Pembayaran
INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 1, 'Andi', 'BCA', 85000, '2024-05-10', 'bukti_1.jpg'),
(2, 2, 'Budi', 'BNI', 72000, '2024-05-20', 'bukti_2.jpg');

-- Penyesuaian AUTO_INCREMENT
ALTER TABLE `admin`
  MODIFY `id_admin` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `kurir`
  MODIFY `id_kurir` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `pembelian`
  MODIFY `id_pembelian` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `produk`
  MODIFY `id_produk` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;




