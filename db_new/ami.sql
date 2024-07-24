-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2024 pada 14.23
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ami`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(190) NOT NULL,
  `foto` varchar(199) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `level` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `email`, `foto`, `tgl_daftar`, `level`) VALUES
(3, 'Hanif Hairulloh', 'hanifhairulloh', '0192023a7bbd73250516f069df18b500', 'hanifhairulloh19@gmail.com', 'stmik.png', '2017-12-21 16:42:51', 0),
(6, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin123@gmail.com', 'dasdasd.PNG', '2018-05-23 01:40:05', 1),
(7, 'tes', 'tes', '0134a762b1c7d4acab4a766061b57093', 'tes@gmail.com', 'wddwdwwd', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auditor`
--

CREATE TABLE `auditor` (
  `id_auditor` int(80) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama_auditor` varchar(80) NOT NULL,
  `alamat_auditor` varchar(80) NOT NULL,
  `email_auditor` varchar(200) NOT NULL,
  `no_telp_auditor` int(80) NOT NULL,
  `jabatan` varchar(80) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `auditor`
--

INSERT INTO `auditor` (`id_auditor`, `nip`, `nama_auditor`, `alamat_auditor`, `email_auditor`, `no_telp_auditor`, `jabatan`, `foto`) VALUES
(9, 3, 'tesauditor1', 'bandung', 'auditor1@gmail.com', 2147483647, 'auditor', '13.png'),
(10, 2003, 'bintang auditor 2', 'bandung, kota', 'bintangauditor@gmail.com', 2147483647, 'auditor2', '10_avatar-512.png'),
(15, 333, 'tes3', '', 'tes3@gmail.com', 813, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `butir_sop`
--

CREATE TABLE `butir_sop` (
  `kode_sop` varchar(80) NOT NULL,
  `kode_butir` varchar(80) NOT NULL,
  `isi_butir` longtext NOT NULL,
  `indikator` varchar(200) NOT NULL,
  `tgl_butir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `butir_sop`
--

INSERT INTO `butir_sop` (`kode_sop`, `kode_butir`, `isi_butir`, `indikator`, `tgl_butir`) VALUES
('S.01.18', 'S.01.18.1', '1) Lulusan STMIK Bandung harus memiliki kualifikasi Sikap :\r\n- Lulusan yang bertaqwa (menganut salah satu agama resmi di Indonesia),\r\n- Berkelakuan baik (tidak pernah terbukti melanggar norma\r\nhukum Agama, Negara dan lembaga) sesuai dengan pedoman mahasiswa,\r\n- Memiliki kepekaan sosial dan bertanggung jawab atas hasil pekerjaannya sendiri,\r\n- Memiliki mental yang baik serta jiwa yang mandiri.', 'Seluruh lulusan STMIK Bandung Tidak pernah terbukti melakukan pelanggaran norma hukum Sosial, Agama dan Negara. Dengan ditandai dengan surat keterangan berkelakuan baik yang ditandatangani oleh dosen ', '2018-12-19'),
('S.01.18', 'S.01.18.2', '2) Lulusan STMIK Bandung harus memiliki Kualifikasi Pengetahuan dan Keterampilan Umum sesuai dengan rumusan KKNI dalam Peraturan Presiden No. 8 Tahun 2012 tentang Kerangka Kualifikasi Nasional Indonesia (KKNI)', 'Seluruh lulusan STMIK Bandung wajib mengikuti kegiatan Pengabdian Kepada Masyarakat minimal 1 kali yang akan berkordinasi dengan LPPM. Kegiatan PKM dimasukan kedalam kurikulum minimal 3 SKS. Seluruh l', '2018-12-19'),
('S.01.18', 'S.01.18.3', '3) Program studi melakukan revisi kerangka kurikulum dan Capaian Pembelajaran paling lama 4 tahun sekali dengan membentuk tim evaluasi Kompetensi Lulusan, struktur kurikulum dan capaian pembelajaran untuk seluruh kualifikasi.', 'Tim menghasilkan Laporan Evaluasi Kurikulum dan Capaian Pembelajaran berisi agenda, daftar hadir, masukan, pembentukan tim kerja untuk masing-masing program studi, kompetensi lulusan, kerangka kurikul', '2018-12-19'),
('S.01.18', 'S.01.18.4', '4) Tim Evaluasi menerima masukan dari pengguna lulusan melalui tracer study yang dilakukan oleh program studi dan pertimbangan keilmuan dengan melibatkan stakeholder yang relevan.', 'Laporan analisis hasil tracer study dilakukan minimal 1 kali setiap tahun akademik oleh program studi. Stakeholder yang terlibat minimal terdiri dari Pengguna lulusan, Alumni, Praktisi Teknologi Infor', '2018-12-19'),
('S.01.18', 'S.01.18.5', '5) Tim Evaluasi menyusun Kompetensi Pembelajaran mencakup kualifikasi kompetensi lulusan yang meliputi sikap dan keterampilan umum institusi dan keterampilan khusus program studi yang dinyatakan dalam rumusan capaian pembelajaran lulusan.', 'Kompetensi pembelajaran dan rumusan capaian pembelajaran dapat tergambar didalam matriks matakuliah di dalam rancangan kurikulum.', '2018-12-19'),
('S.01.18', 'S.01.18.6', '6) Program Studi menyusun Rencana Pembelajaran Semester yang mengacu kepeda rumusan capaian pembelajaran lulusan.', 'Seluruh Rencana Pembelajaran Semester harus mengandung kompetensi dan capaian pembelajaran.', '2018-12-19'),
('S.02.18', 'S.02.18.01', '1) Program studi dan Tim Evaluasi Capaian Pembelajaran menyusun struktur kurikulum dengan tingkat kedalaman dan keluasan materi pembelajaran paling sedikit harus menguasai konsep teoritis bidang pengetahuan dan keterampilan tertentu secara umum dan konsep teoritis bagian khusus dalam bidang pengetahuan dan keterampilan bidang pengetahuan tersebut secara mendalam', 'Terciptanya kurikulum yang disusun berdasarkan visi dan misi serta profil lulusan program studi dengan capaian pembelajaran yang terukur baik untuk matakuliah dasar ataupun matakuliah dasar khusus di ', '2018-12-21'),
('S.02.18', 'S.02.18.2', '2) Tim evaluasi menyusun kurikulum yang memuat kompetensi nasional,kompetensi dasar sains dan teknologi, kompetensi keahlian dan spesialisasi serta memberi kesempatan mahasiswa untuk memperluas wawasan bidang keilmuannya dan menuangkannya dalam bentuk kumpulan matakuliah yang bersifat kumulatif dan terintegratif.', 'Terciptanya urutan kurikulum yang komperhensif dan terintegrasi', '2018-12-21'),
('S.03.18', 'S.03.18.1', '1) Kelompok dosen pengampu matakuliah menyusun Rencana Pembelajaran Semester yang memuat :\r\na. nama program studi, nama dan kode mata kuliah, semester, sks, nama dosen pengampu;\r\nb. capaian pembelajaran lulusan yang dibebankan pada mata kuliah;\r\nc. kemampuan akhir yang direncanakan pada tiap tahap pembelajaran untuk memenuhi capaian pembelajaran lulusan;\r\nd. bahan kajian yang terkait dengan kemampuan yang akan dicapai;\r\ne. metode pembelajaran;\r\nf. waktu yang disediakan untuk mencapai kemampuan pada tiap tahap pembelajaran;\r\ng. pengalaman belajar mahasiswa yang diwujudkan dalam deskripsi tugas yang harus dikerjakan oleh mahasiswa selama satu semester;\r\nh. kriteria, indikator, dan bobot penilaian; dan\r\ni. daftar referensi yang digunakan.', '100 Persen matakuliah memiliki RPS', '2018-12-19'),
('S.03.18', 'S.03.18.2', '2) Program Studi menyusun evaluasi pembelajaran minimal satu kali selama satu semester dan melakukan pengecekan kesesuaian proses pembelajaran dengan RPS dan kesesuaian RPS dengan perkembangan teknologi dan ilmu pengetahuan.', 'Evaluasi pembelajaran tertuang didalam laporan evaluasi akademik program studi di setiap semester.', '2018-12-19'),
('S.03.18', 'S.03.18.3', '3) Program Studi bekerjasama dengan LPPM untuk pelaksanaan matakuliah yang terkait dengan Penelitian dan Pengabdian kepada masyarakat.', '', '2018-12-19'),
('S.03.18', 'S.03.18.5', '5) Dosen wajib menggunakan satu atau gabungan dari beberapa metode pembelajaran', '', '2018-12-19'),
('S.03.18', 'S.03.18.6', '6) Mahasiswa diwajibkan mengikuti matakuliah Kerja Praktek dengan pembelajaran berupa pengabdian kepada masyarakat dalam rangka memanfaatkan ilmu pengetahuan dan teknologi untuk memajukan kesejahteraan masyarakat dan mencerdaskan kehidupan bangsa', 'Adanya luaran berupa laporan kerja praktek mahasiswa', '2018-12-19'),
('S.03.18', 'S.03.18.7', '7) Mahasiswa diwajibkan mengikuti matakuliah Skripsi dengan mengajukan proposal penelitian dan akan dibimbing oleh 1 orang dosen.', 'Adanya luaran berupa laporan skripsi mahasiswa dan jurnal penelitian yang diterbitkan minimal lokal STMIK Bandung', '2018-12-19'),
('S.04.18', 'S.04.18.1', '1) Dosen melaksanakan penilaian pembelajaran kepada mahasiswa dengan menerapkan 5 prinsip yaitu prinsip edukatif, otentik, objektif, akuntabel, dan transparan, yang dilakukan secara terintegrasi.', 'Pencapaian pelaksanaan seluruh prinsip tercermin melalui rekapitulasi hasil kuesioner pembelajaran yang diisi oleh mahasiswa disetiap semesternya.', '2018-12-19'),
('S.04.18', 'S.04.18.2', '2) Dosen melaksanakan penilaian pembelajaran kepada mahasiswa menerapkan 2 jenis penilaian yaitu test dan non test sesuai dengan Standar Nasional Pendidikan Tinggi, yang mencakup materi hard skill dan soft skill selama pelaksanaan proses pembelajaran.', '', '2018-12-19'),
('S.04.18', 'S.04.18.3', '3) Dosen melakukan penilaian hard skill (produk) mahasiswa dengan jenis test (test tertulis atau tidak tertulis) minimal 2 kali untuk mata kuliah tanpa praktikum, dan minimal 3 kali untuk mata kuliah dengan praktikum selama pelaksanaan proses pembelajaran.', '', '2018-12-19'),
('S.04.18', 'S.04.18.4', '4) Dosen menilai 4 atribut soft skill (disiplin, komunikasi, berpikir kritis, dan kerjasama tim). Penilaian tersebut menggunakan paling sedikit 2 rubrik yang mencakup komponen intra dan interpersonal skill selama pelaksanaan proses pembelajaran.', '', '2018-12-19'),
('S.04.18', 'S.04.18.5', '5) Dosen melakukan pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa yang dinyatakan dalam kisaran :', 'Dosen diharuskan menyertakan rincian penilaian berupa UTS, UAS, Tugas, Quiz dan Presensi (diinput otomatis berdasarkan presensi mahasiswa kedalam sistem) dengan Nilai Akhir yang menjadi acuan Grade Ma', '2018-12-19'),
('S.04.18', 'S.04.18.6', '6) Mahasiswa dinyatakan memenuhi kompetensi terhadap materi pembelajaran (mata kuliah) dengan nilai akhir serendah- rendahnya 60 atau C.', 'Lebih dari 60% mahasiswa mendapatkan nilai minimal B pada masing-masing mata kuliah.', '2018-12-19'),
('S.04.18', 'S.04.18.7', '7) Dosen melakukan pelaporan penilaian selambat-lambatnya dua minggu setelah proses Ujian Akhir Semester dilaksanakan', '90 persen dosen melakukan pelaporan nilai tepat waktu', '2018-12-19'),
('S.04.18', 'S.04.18.8', '8) Mahasiswa diharuskan mengisi kuesioner setiap akhir proses pembelajaran.', '', '2018-12-19'),
('S.05.18', 'S.05.18.1', '1) Dosen harus berkualifikasi akademik paling rendah lulusan magister atau magister terapan dan/atau bersertifikat yang relevan dengan program studi dan berkualifikasi paling rendah setara dengan jenjang 8 (delapan) KKNI.', 'Seluruh dosen minimal S2 sesuai dengan bidang keahlian, Minimal ada 1 Dosen S3 per program studi', '2018-12-19'),
('S.05.18', 'S.05.18.2', '2) Prodi wajib menyesuaikan kebutuhan rasio dosen berdasarkan jumlah mahasiswa, rasio dosen terhadap mahasiswa dihitung sesuai dengan Permen Ristek Dikti No. 2 Tahun 2016 tentang Registrasi Pendidik pada Perguruan Tinggi.', 'Maksimal 1:20 untuk Teknik Informatika, dan 1:30 untuk Sistem Informasi', '2018-12-19'),
('S.05.18', 'S.05.18.3', '3) Dosen memiliki beban kerja dan Kegiatan pokok dosen mencakup :\r\na. perencanaan, pelaksanaan, dan pengendalian proses pembelajaran\r\nb. pelaksanaan evaluasi hasil pembelajaran\r\nc. pembimbingan dan pelatihan penelitian dan pengabdian kepada masyarakat\r\nd. dapat ditunjuk sebagai pejabat struktural\r\ne. tugas tambahan yang kondisional', 'Dosen harus menyusun rencana pengajaran dalam bentuk kontrak perkuliahan dan menyelesaikan evaluasi dan penilaian pembelajaran paling lambat 2 minggu setelah masa Ujian Akhir Semester.', '2018-12-19'),
('S.05.18', 'S.05.18.4', '4) Dosen memiliki beban kerja maksimal 12 SKS per minggu yang disesuaikan dengan beratnya tugas tambahan', 'Dosen harus melakukan pembimbingan penelitian dan pengabdian masyarakat minimal 1 jenis setiap semester', '2018-12-19'),
('S.05.18', 'S.05.18.5', '5) Dosen dapat dibebankan sebagai pembimbing Kerja Praktek dan Skripsi', 'Maksimal 10 Mahasiswa setiap semester', '2018-12-19'),
('S.05.18', 'S.05.18.6', '6) STMIK Bandung memiliki Dosen Tetap Yayasan dan Dosen tidak tetap', 'Jumlah dosen tidak tetap paling banyak 20% dari jumlah dosen.', '2018-12-19'),
('S.05.18', 'S.05.18.7', '7) STMIK Bandung mengangkat Tenaga Kependidikan sebagai teknis dan perpustakaan dan administrasi', 'Tenaga kependidikan teknis dan perpustakaan minimal Diploma, tenaga kependidikan Administrasi Minimal SMA/Sederajat. Tenaga Kependidikan teknis memiliki sertifikat kompet ensi', '2018-12-19'),
('S.06.18', 'S.06.18.1', 'STMIK Bandung menyediakan Sarana dan Prasarana minimal yang harus disediakan diantaranya adalah lahan, ruang kelas, perpustakaan, laboratorium, tempat olah raga, ruang untuk berkesenian, ruang unit kegiatan mahasiswa, ruang pimpinan perguruan tinggi, ruang dosen, ruang tata usaha dan fasilitas umum.', 'Seluruh Sarana dan Prasarana standar Minimal sesuai dengan rasio mahasiswa, dosen dan tenaga kependidikan.', '2018-12-19'),
('S.06.18', 'S.06.18.2', 'STMIK Bandung menyediakan Fasilitas umum bagi seluruh Civitas Akademik meliputi : Jalan, air, listrik, jaringan komunikasi suara dan data.', 'Adanya akses jalan, lapangan parkir, listrik, jaringan internet dan jaringan telepon yang memadai sesuai dengan jumlah Mahasiswa, Dosen dan Karyawan STMIK Bandung.', '2018-12-19'),
('S.06.18', 'S.06.18.3', 'STMIK Bandung memiliki standar bangunan yang memiliki standar kualitas minimal kelas A atau setara yang memenuhi persyaratan keselamatan, kesehatan, kenyamanan, dan keamanan, serta dilengkapi dengan instalasi listrik yang berdaya memadai dan instalasi, baik limbah domestik maupun limbah khusus, apabila diperlukan.', 'Standar bangunan sesuai dengan standar kualitas minimal dan memenuhi persyaratan keselamatan, kesehatan, kenyamanan dan keamanan dengan instalasi yang memadai.', '2018-12-19'),
('S.06.18', 'S.06.18.4', 'STMIK Bandung menyediakan sarana dan prasarana yang dapat diakses oleh mahasiswa yang berkebutuhan khusus. terdiri atas:\r\n1) Pelabelan dengan tulisan Braille dan informasi dalam bentuk suara;\r\n2) Lerengan (ramp) untuk pengguna kursi roda;\r\n3) Jalur pemandu (guiding block) di jalan atau koridor di lingkungan kampus;\r\n4) Peta/denah kampus atau gedung dalam bentuk peta/denah timbul; dan\r\n5) Toilet atau kamar mandi untuk pengguna kursi roda.', 'Adanya sarana dan prasarana yang dapat diakses oleh mahasiswa berkebutuhan khusus.', '2018-12-19'),
('S.07.18', 'S.07.18.1', '1) Program Studi wajib melakukan penyusunan kurikulum dan rencana pembelajaran setiap matakuliah', 'Terciptanya kurikulum program studi yang diturunkan kedalam Rencana Pembelajaran Semester untuk setiap matakuliah', '2018-12-19'),
('S.07.18', 'S.07.18.2', '2) Program Studi wajib menyelenggarakan proses pembelajaran sesuai dengan standar isi, standar proses, standar penilaian yang telah ditetapkan dalam rangka mencapai capaian pembelajaran lulusan', 'Seluruh proses pembelajaan mengikuti seluruh standard an capaian pembelajaran yang telah ditetapkan', '2018-12-19'),
('S.07.18', 'S.07.18.3', '3) Program Sudi wajib melakukan kegiatan sistemik yang menciptakan suasana akademik dan budaya mutu yang baik', 'Seluruh kegiatan pembelajaran terjadwal dan mengikuti Kalender akademik yang telah ditetapkan', '2018-12-19'),
('S.08.18', 'S.08.18.1', '1) Bidang Keuangan dan SDM wajib mempunyai sistem pencatatan biaya sesuai dengan ketentuan perundang-undangan sampai pada satuan program studi', 'Adanya buku besar keuangan STMIK Bandung berisi tentang catatan pemasukan dan penggunaan anggaran sesuai dengan perencanaan.', '2018-12-19'),
('S.08.18', 'S.08.18.2', '2) Bidang Keuangan dan SDM wajib melakukan analisis biaya operasional pendidikan tinggi sebagai bagian dari penyusunan rencana kerja dan anggaran tahunan STMIK Bandung.', 'Pada setiap akhir tahun bagian keuangan mengeluarkan Rencana Anggaran dan Biaya tahunan sesuai dengan hasil analisis biaya operasional STMIK Bandung', '2018-12-19'),
('S.08.18', 'S.08.18.3', '3) Bagian Keuangan dan SDM wajib melakukan evaluasi tingkat ketercapaian standar satuan biaya pendidikan tinggi pada setiap akhir tahun anggaran', 'Pada setiap akhir tahun anggaran Bagian keuangan mempersiapkan dokumen rencana dan penggunaan anggaran untuk dilakukan audit oleh Auditor Eksternal', '2018-12-19'),
('S.08.18', 'S.08.18.4', '4) Yayasan wajib mengupayakan pendanaan pendidikan tinggi dari berbagai sumber diluar biaya pendidikan yang diperoleh dari mahasiswa', 'Adanya kerjasama dengan pihak lain dalam pengadaan dana hibah, jasa layanan profesi dan kerjasama dengan kelembagaan pemerintah dan swasta', '2018-12-19'),
('S.08.18', 'S.08.18.5', '5) Pimpinan STMIK Bandung wajib menyusun kebijakan, mekanisme dan prosedur dalam penggalangan sumber dana lain secara akuntable dan transparan dalam rangka peningkatan kualitas pendidikan.', 'Terciptanya unit bisnis STMIK Bandung Adanya Audit keuangan oleh pihak Eksternal.', '2018-12-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deskriptor`
--

CREATE TABLE `deskriptor` (
  `kode_deskripsi` int(80) NOT NULL,
  `kode_sop` varchar(80) NOT NULL,
  `kode_butir` varchar(80) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `pengendali_dokumen` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `deskriptor`
--

INSERT INTO `deskriptor` (`kode_deskripsi`, `kode_sop`, `kode_butir`, `deskripsi`, `pengendali_dokumen`) VALUES
(30, 'S.01.18', 'S.01.18.1', 'mahasiswa memiliki sikap yang baik', 'dokumen standar kompetensi lulusan'),
(31, 'S.01.18', 'S.01.18.2', 'keterampilan sesuai jurusan teknik informatika dan sistem informasi', 'dokumen standar kompetensi lulusan'),
(32, 'S.01.18', 'S.01.18.3', 'ok', 'ok'),
(33, 'S.01.18', 'S.01.18.4', 'evaluasi lulusan stmik bandung', 'tracer study lulusan'),
(34, 'S.03.18', 'S.03.18.1', 'semua kriteria terpenuhi ', 'dokumen penilaian pembelejaran'),
(35, 'S.03.18', 'S.03.18.3', 'bekerjasama dengan pihak ketiga', ''),
(36, 'S.03.18', 'S.03.18.2', 'penyususan program pembelajaran', 'standar proses pembelajaran'),
(37, 'S.03.18', 'S.03.18.5', 'wajib menggunakan metode pembelajaran', 'dokumen standar proses pembelajaran'),
(38, 'S.04.18', 'S.04.18.1', 'dosen melaksanakan penilaian kepada mahasiswa sesuaia dengan prinsip', 'dokumen standar penilaian pembelajaran'),
(39, 'S.04.18', 'S.04.18.2', 'melakukan penilaian dengan 2 jenis yaitu test dan non test', 'standar penilaian pembelajaran'),
(40, 'S.05.18', 'S.05.18.1', 'dosen minimal magister', 'standar dosen dan tenaga kependidikan'),
(41, 'S.05.18', 'S.05.18.2', 'prodi harus menyesuaikan rasio dosen sesuai standar', 'standar dosen dan kependidikan'),
(42, 'S.06.18', 'S.06.18.1', 'stmik bandung menyediakan sarana dan prasaran', 'standar sarana dan prasaran stmik bandung'),
(43, 'S.06.18', 'S.06.18.2', 'stmik bandung menyedikan sarana dan prasaran', 'standar sarana dan prasaran'),
(44, 'S.07.18', 'S.07.18.1', 'program studi wajib menyusun kurikulum', 'dokumen standar pembelajaran'),
(45, 'S.07.18', 'S.07.18.2', 'program studi wajib mengelola pembelajaran sesuai standar', 'standar pengelolaan pembelajaran'),
(46, 'S.08.18', 'S.08.18.1', 'bidang keuangan wajib memilki sistem pencatatan keuangan', 'dokeumen pembiayaan '),
(47, 'S.08.18', 'S.08.18.2', 'bagian keuangan wajib membuat analisis laporan keuangan', 'standar pembiayaan pembelajaran'),
(48, 'S.02.18', 'S.02.18.01', 'bagus', 'dokumen standar isi pembelajaran'),
(49, 'S.02.18', 'S.02.18.2', 'data isi pembelajaran sudah sesuai dengan standar nasional', 'dokumen standar isi pembelajaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(80) NOT NULL,
  `kode_unit` varchar(50) NOT NULL,
  `kode_sop` varchar(80) NOT NULL,
  `nama_dokumen` varchar(180) NOT NULL,
  `dokumen` varchar(300) NOT NULL,
  `tgl_dokumen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluasi`
--

CREATE TABLE `evaluasi` (
  `id_evaluasi` int(11) NOT NULL,
  `kode_jadwal` varchar(80) NOT NULL,
  `kode_sop` varchar(80) NOT NULL,
  `kode_butir` varchar(80) NOT NULL,
  `kode_deskripsi` varchar(80) NOT NULL,
  `id_auditor` varchar(80) NOT NULL,
  `kode_unit` varchar(80) NOT NULL,
  `hasil` varchar(80) NOT NULL,
  `persentase` varchar(80) NOT NULL,
  `temuan` longtext NOT NULL,
  `kategori_temuan` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `evaluasi`
--

INSERT INTO `evaluasi` (`id_evaluasi`, `kode_jadwal`, `kode_sop`, `kode_butir`, `kode_deskripsi`, `id_auditor`, `kode_unit`, `hasil`, `persentase`, `temuan`, `kategori_temuan`) VALUES
(34, 'JDW001', 'S.08.18', 'S.08.18.1', '46', '9', 'UNK004', 'ada', '70', 'bagus', '1'),
(35, 'JDW001', 'S.08.18', 'S.08.18.2', '47', '9', 'UNK004', 'ada', '80', 'ok', '1'),
(36, 'JDW008', 'S.02.18', 'S.02.18.01', '48', '9', 'UNK002', 'ada', '80', 'bagus', '1'),
(37, 'JDW008', 'S.02.18', 'S.02.18.2', '49', '9', 'UNK002', 'ada', '70', 'bagus', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_audit`
--

CREATE TABLE `hasil_audit` (
  `id_audit` int(11) NOT NULL,
  `kode_jadwal` varchar(50) NOT NULL,
  `kode_sop` varchar(50) NOT NULL,
  `Auditor` varchar(100) NOT NULL,
  `Tanggal` date NOT NULL,
  `File` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jbt` varchar(30) NOT NULL,
  `nama_jbt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jbt`, `nama_jbt`) VALUES
('JBT001', 'Dosen'),
('JBT002', 'Ketua Program Studi Teknik Informatika'),
('JBT003', 'Ketua Program Studi Sistem Informasi'),
('JBT004', 'Wakil Ketua 1 Bidang Akademik'),
('JBT005', 'Bagian Keuangan'),
('JBT006', 'Sekertaris'),
('JBT007', 'Wakil Ketua 2'),
('JBT008', 'mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` varchar(80) NOT NULL,
  `kode_sop` varchar(80) NOT NULL,
  `kode_sn` varchar(11) NOT NULL,
  `id_auditor` int(80) NOT NULL,
  `program_studi` varchar(300) NOT NULL,
  `tahun_pengukuran` varchar(300) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_desk`
--

CREATE TABLE `job_desk` (
  `kode_jobdesk` varchar(80) NOT NULL,
  `id_jbt` varchar(80) NOT NULL,
  `nik` varchar(80) NOT NULL,
  `fungsi` longtext NOT NULL,
  `tgl_penetapan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `job_desk`
--

INSERT INTO `job_desk` (`kode_jobdesk`, `id_jbt`, `nik`, `fungsi`, `tgl_penetapan`) VALUES
('JBD001', 'JBT001', '001', '<p></p><ul><li>Melakukan tugas mengajar mahasiswa</li><li>memberikan laporan nilai hasil pembelajaran</li><li>melakukan evaluasi mahasiswa</li><li>laporan nilai semester</li></ul><p></p>', '2018-12-19'),
('JBD002', 'JBT005', '001', '<p></p><ul><li>melakukan kegiatan mengurus keuangan&nbsp;<br></li><li>memberikan laporan keuangan</li></ul><p></p>', '2018-12-19'),
('JBD003', 'JBT003', '001', '<p></p><ul><li>melakukan kegiatan penetapan standar stmik bandung</li><li>memberikan laporan standar nasional pendidikan</li><li>pada bagian akademik sistem informasi</li></ul><p></p>', '2018-12-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_auditor`
--

CREATE TABLE `login_auditor` (
  `id_auditor` int(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `login_auditor`
--

INSERT INTO `login_auditor` (`id_auditor`, `username`, `password`) VALUES
(9, '3', '123'),
(10, 'bintang_auditor_2', '123'),
(12, 'testing10', '12345678'),
(13, 'ric14', 'ricaja123'),
(14, '313', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_staf`
--

CREATE TABLE `login_staf` (
  `id_staf` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `login_staf`
--

INSERT INTO `login_staf` (`id_staf`, `username`, `password`) VALUES
('13', '2', '123'),
('15', '21', '123'),
('16', '212', '123'),
('17', '2121', '123'),
('18', '212121', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_wakil_ketua`
--

CREATE TABLE `login_wakil_ketua` (
  `id_wakil_ketua` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `login_wakil_ketua`
--

INSERT INTO `login_wakil_ketua` (`id_wakil_ketua`, `username`, `password`) VALUES
('5', '1', '123'),
('6', 'wakilketua1', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penanggung_jawab`
--

CREATE TABLE `penanggung_jawab` (
  `id_penanggung_jawab` int(80) NOT NULL,
  `nik` varchar(80) NOT NULL,
  `id_jbt` varchar(80) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `no_hp` varchar(80) NOT NULL,
  `foto_p` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `penanggung_jawab`
--

INSERT INTO `penanggung_jawab` (`id_penanggung_jawab`, `nik`, `id_jbt`, `nama`, `email`, `no_hp`, `foto_p`) VALUES
(10, '001', 'JBT003', 'penanggung jawab 1', 'pnjwb@gmail.com', '086764678779', '3.png'),
(11, '002', 'JBT002', 'Mina Ismu Rahayu', 'pnjbwb2@gmail.com', '087897890', '1.png'),
(12, '0003', 'JBT004', 'hanif', 'hanifhairulloh19@gmail.com', '07895786767', '39-512.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staf`
--

CREATE TABLE `staf` (
  `id` int(11) NOT NULL,
  `nik_staf` varchar(80) NOT NULL,
  `id_jbt` varchar(80) NOT NULL,
  `nama_staf` varchar(80) NOT NULL,
  `tgl_lahir_staf` date NOT NULL,
  `email` varchar(80) NOT NULL,
  `no_hp` varchar(80) NOT NULL,
  `foto_staf` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `staf`
--

INSERT INTO `staf` (`id`, `nik_staf`, `id_jbt`, `nama_staf`, `tgl_lahir_staf`, `email`, `no_hp`, `foto_staf`) VALUES
(13, '2', 'JBT003', 'teskoorprodi1', '1987-12-19', 'email@gmail.com', '08687687678', '4.png'),
(15, '21', 'JBT001', 'teskoorprodi2', '2018-12-19', 'staf131@gmail.com', '9876543', '13.png'),
(16, '212', '', 'TESKOORPRODI 3', '0000-00-00', 'tes3@gmail.com', '08123', ''),
(17, '2121', '', 'KOORPRODI MESIN', '0000-00-00', 'km@gmail.com', '123123', ''),
(18, '212121', '', 'KOORPRODI ARS', '0000-00-00', 'ars@gmail.oom', '123123', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `standar_nasional`
--

CREATE TABLE `standar_nasional` (
  `kode_sn` varchar(80) NOT NULL,
  `nama_sn` varchar(80) NOT NULL,
  `tanggal_sn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `standar_operasional`
--

CREATE TABLE `standar_operasional` (
  `kode_unit` varchar(80) NOT NULL,
  `kode_sn` varchar(80) NOT NULL,
  `kode_sop` varchar(80) NOT NULL,
  `nama_sop` varchar(200) NOT NULL,
  `id_koorprodi` int(80) NOT NULL,
  `id_auditor` int(20) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `kode_unit` varchar(80) NOT NULL,
  `nama_unit` varchar(80) NOT NULL,
  `id_jbt` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `unit_kerja`
--

INSERT INTO `unit_kerja` (`kode_unit`, `nama_unit`, `id_jbt`) VALUES
('PRG001', 'INFORMATIKA', '13'),
('PRG002', 'ELEKTRO', '15'),
('PRG004', 'MESIN', '17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wakil_ketua`
--

CREATE TABLE `wakil_ketua` (
  `id_wakil_ketua` int(80) NOT NULL,
  `nip_wakil_ketua` int(80) NOT NULL,
  `nama_wakil_ketua` varchar(300) NOT NULL,
  `email_wakil_ketua` varchar(300) NOT NULL,
  `no_telp_wakil_ketua` int(80) NOT NULL,
  `jabatan_wakil_ketua` varchar(300) NOT NULL,
  `foto_wakil_ketua` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `wakil_ketua`
--

INSERT INTO `wakil_ketua` (`id_wakil_ketua`, `nip_wakil_ketua`, `nama_wakil_ketua`, `email_wakil_ketua`, `no_telp_wakil_ketua`, `jabatan_wakil_ketua`, `foto_wakil_ketua`) VALUES
(5, 1, 'TES LPM', 'teslpm@gmail.com', 865765756, 'LPM', 'images.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auditor`
--
ALTER TABLE `auditor`
  ADD PRIMARY KEY (`id_auditor`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `butir_sop`
--
ALTER TABLE `butir_sop`
  ADD PRIMARY KEY (`kode_butir`);

--
-- Indeks untuk tabel `deskriptor`
--
ALTER TABLE `deskriptor`
  ADD PRIMARY KEY (`kode_deskripsi`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indeks untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`);

--
-- Indeks untuk tabel `hasil_audit`
--
ALTER TABLE `hasil_audit`
  ADD PRIMARY KEY (`id_audit`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jbt`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`);

--
-- Indeks untuk tabel `job_desk`
--
ALTER TABLE `job_desk`
  ADD PRIMARY KEY (`kode_jobdesk`);

--
-- Indeks untuk tabel `login_auditor`
--
ALTER TABLE `login_auditor`
  ADD PRIMARY KEY (`id_auditor`);

--
-- Indeks untuk tabel `login_staf`
--
ALTER TABLE `login_staf`
  ADD PRIMARY KEY (`id_staf`);

--
-- Indeks untuk tabel `login_wakil_ketua`
--
ALTER TABLE `login_wakil_ketua`
  ADD PRIMARY KEY (`id_wakil_ketua`);

--
-- Indeks untuk tabel `penanggung_jawab`
--
ALTER TABLE `penanggung_jawab`
  ADD PRIMARY KEY (`id_penanggung_jawab`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik_staf` (`nik_staf`);

--
-- Indeks untuk tabel `standar_nasional`
--
ALTER TABLE `standar_nasional`
  ADD PRIMARY KEY (`kode_sn`);

--
-- Indeks untuk tabel `standar_operasional`
--
ALTER TABLE `standar_operasional`
  ADD PRIMARY KEY (`kode_sop`);

--
-- Indeks untuk tabel `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`kode_unit`);

--
-- Indeks untuk tabel `wakil_ketua`
--
ALTER TABLE `wakil_ketua`
  ADD PRIMARY KEY (`id_wakil_ketua`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `auditor`
--
ALTER TABLE `auditor`
  MODIFY `id_auditor` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `deskriptor`
--
ALTER TABLE `deskriptor`
  MODIFY `kode_deskripsi` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `id_evaluasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `hasil_audit`
--
ALTER TABLE `hasil_audit`
  MODIFY `id_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `penanggung_jawab`
--
ALTER TABLE `penanggung_jawab`
  MODIFY `id_penanggung_jawab` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `staf`
--
ALTER TABLE `staf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `wakil_ketua`
--
ALTER TABLE `wakil_ketua`
  MODIFY `id_wakil_ketua` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
