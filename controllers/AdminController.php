<?php

require_once 'models/User.php';
require_once 'models/Pendaftaran.php';
require_once 'models/Keahlian.php';
require_once 'models/TesKeahlian.php';
require_once 'models/MataSoal.php';
require_once 'models/Soal.php';
require_once 'models/SesiKeahlian.php';
require_once 'connection/database.php';

class AdminController
{
    private $user;
    private $pendaftar;
    protected $kelasKeahlian;
    protected $tesKeahlian;
    protected $mataSoal;
    protected $sesiKeahlian;
    private $soal;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        global $pdo;
        $this->pendaftar = new Pendaftar($pdo);
        $this->user = new User($pdo);
        $this->kelasKeahlian = new Keahlian($pdo);
        $this->tesKeahlian = new TesKeahlian($pdo);
        $this->mataSoal = new MataSoal($pdo);
        $this->soal = new Soal($pdo);
        $this->sesiKeahlian = new SesiKeahlian($pdo);
    }

    public function index()
    {
        $pendaftar_baru = $this->pendaftar->getNewRegistrations();
        $jumlah_pendaftar = $this->pendaftar->getAll();
        $jumlah_pendaftar_count = count($jumlah_pendaftar);
        $persentase_pendaftar = ($jumlah_pendaftar_count > 0) ? 100 : 0;

        include 'views/layout/admin_header.php';
        include 'views/admin/dashboard_admin.php';
        include 'views/layout/admin_footer.php';
    }

    public function kelolaData()
    {
        $keahlian = $this->kelasKeahlian->getAll();
        $listPendaftar = $this->pendaftar->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/kelola_data.php';
        include 'views/layout/admin_footer.php';
    }

    public function peserta()
    {
        $listPendaftar = $this->pendaftar->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/peserta.php';
        include 'views/layout/admin_footer.php';
    }

    public function infoUser()
    {
        $users = $this->user->getUsersByRole('user');
        include 'views/layout/admin_header.php';
        include 'views/admin/info_user.php';
        include 'views/layout/admin_footer.php';
    }

    public function detailPendaftar($id)
    {
        $user = $this->user->getUserById($id);
        $userPendaftar = $this->pendaftar->getByUserId($id);

        if (!empty($userPendaftar)) {
            include 'views/layout/admin_header.php';
            include 'views/admin/detail_pendaftar.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/kelola_data');
            exit;
        }
    }

    // halaman soal keahlian
    public function soalKeahlian()
    {
        $mataSoal = $this->mataSoal->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/mata_keahlian/mata_soal_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function tambahSoalKeahlian()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nama']) && !empty(trim($_POST['nama']))) {
                $nama = trim($_POST['nama']);
                if ($this->mataSoal->create($nama)) {
                    header('Location: /admin/mata_soal_keahlian');
                    exit();
                } else {
                    echo "Error saving data.";
                }
            } else {
                echo "Nama Mata Soal tidak boleh kosong.";
            }
        } else {
            include 'views/layout/admin_header.php';
            include 'views/admin/mata_keahlian/tambah_mata_keahlian.php';
            include 'views/layout/admin_footer.php';
        }
    }

    public function ubahSoalKeahlian($id)
    {
        if (empty($mataSoal)) {
            header('Location: /admin/mata_soal_keahlian');
            exit;
        }

        $nama = $_POST['nama'] ?? null;
        if ($nama) {
            if ($this->mataSoal->update($id, $nama)) {
                header('Location: /admin/kelas_keahlian');
                exit;
            }
        }

        $mataSoal = $this->mataSoal->get($id);
        include 'views/layout/admin_header.php';
        include 'views/admin/mata_keahlian/edit_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function hapusSoalKeahlian($id)
    {
        if ($this->mataSoal->delete($id)) {
            header('Location: /admin/mata_soal_keahlian');
            exit;
        }
    }

    // kelas keahlian
    public function kelasKeahlian()
    {
        $keahlian = $this->kelasKeahlian->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/kelas_keahlian/kelas_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function tambahKelasKeahlian()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nama']) && !empty(trim($_POST['nama']))) {
                $nama = trim($_POST['nama']);
                if ($this->kelasKeahlian->create($nama)) {
                    header('Location: /admin/kelas_keahlian');
                    exit();
                } else {
                    echo "Error saving data.";
                }
            } else {
                echo "Nama Kelas Keahlian tidak boleh kosong.";
            }
        } else {
            include 'views/layout/admin_header.php';
            include 'views/admin/kelas_keahlian/tambah_kelas_keahlian.php';
            include 'views/layout/admin_footer.php';
        }
    }

    public function ubahKelasKeahlian($id)
    {
        if (empty($keahlian)) {
            header('Location: /admin/kelas_keahlian');
            exit;
        }

        $nama = $_POST['nama'] ?? null;
        if ($nama) {
            if ($this->kelasKeahlian->update($id, $nama)) {
                header('Location: /admin/kelas_keahlian');
                exit;
            }
        }

        $keahlian = $this->kelasKeahlian->getById($id);
        include 'views/layout/admin_header.php';
        include 'views/admin/kelas_keahlian/edit_kelas_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function hapusKelasKeahlian($id)
    {
        if ($this->kelasKeahlian->delete($id)) {
            header('Location: /admin/kelas_keahlian');
            exit;
        }
    }

    // tes keahlian
    public function tesKeahlian()
    {
        $tesKeahlianList = $this->tesKeahlian->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/tes_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function tambahTesKeahlian()
    {
        $keahlianList = $this->kelasKeahlian->getAll();
        $mataSoal = $this->mataSoal->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_tes = $_POST['nama_tes'];
            $mata_soal = $_POST['mata_soal'];
            $kelas = $_POST['kelas'];
            $acak_soal = $_POST['acak_soal'];
            $acak_jawaban = $_POST['acak_jawaban'];
            $durasi_menit = $_POST['durasi_menit'];

            if ($this->tesKeahlian->create($nama_tes, $mata_soal, $kelas,  $acak_soal, $acak_jawaban, $durasi_menit)) {
                header('Location: /admin/tes_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/tambah_soal_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function detailUjian($id)
    {
        if (!empty($tesKeahlian)) {
            $soalList = $this->soal->getAll();
            $jumlahSoal = $this->soal->getSoalByTesKeahlianId($id);
            $hitungSoal = count($jumlahSoal);
            $tesKeahlian = $this->tesKeahlian->get($id);
    
            include 'views/layout/admin_header.php';
            include 'views/admin/tes_keahlian/detail_ujian.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/tes_keahlian');
            exit;
        }
    }

    public function editTesKeahlian($id)
    {
        if (empty($tesKeahlian)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }

        $keahlianList = $this->kelasKeahlian->getAll();
        $tesKeahlian = $this->tesKeahlian->get($id);
        $mataSoal = $this->mataSoal->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_tes = $_POST['nama_tes'];
            $mata_soal = $_POST['mata_soal'];
            $kelas = $_POST['kelas'];
            $acak_soal = $_POST['acak_soal'];
            $acak_jawaban = $_POST['acak_jawaban'];
            $durasi_menit = $_POST['durasi_menit'];

            if ($this->tesKeahlian->update($id, $nama_tes, $mata_soal, $kelas, $acak_soal, $acak_jawaban, $durasi_menit)) {
                header('Location: /admin/tes_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/edit_soal_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function hapusTesKeahlian($id)
    {
        if ($this->tesKeahlian->delete($id)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }
    }


    // tambah soal tes
    public function tambahSoalTesKeahlian($id)
    {
        if (empty($tesKeahlian)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }

        $tesKeahlian = $this->tesKeahlian->get($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $soal = $_POST['soal'];
            $pilihan_a = $_POST['pilihan_a'];
            $pilihan_b = $_POST['pilihan_b'];
            $pilihan_c = $_POST['pilihan_c'];
            $pilihan_d = $_POST['pilihan_d'];
            $pilihan_e = $_POST['pilihan_e'];
            $jawaban_benar = $_POST['jawaban_benar'];

            $tes_keahlian_id = $tesKeahlian['id'];

            // Save the soal data
            if ($this->soal->create($soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar, $tes_keahlian_id)) {
                header('Location: /admin/tes_keahlian/detail_ujian/' . $id);
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/tambah_soal_tes_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function importSoalTesKeahlian($id)
    {
        if (!empty($tesKeahlian)) {
            $tesKeahlian = $this->tesKeahlian->get($id);
            include 'views/layout/admin_header.php';
            include 'views/admin/tes_keahlian/import_soal_tes.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/tes_keahlian');
            exit;
        }
    }

    // edit soal tes
    public function editSoalTesKeahlian($id, $id_soal)
    {
        if (empty($tesKeahlian)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }

        $tesKeahlian = $this->tesKeahlian->get($id);
        $soal = $this->soal->get($id_soal);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $soal = $_POST['soal'];
            $pilihan_a = $_POST['pilihan_a'];
            $pilihan_b = $_POST['pilihan_b'];
            $pilihan_c = $_POST['pilihan_c'];
            $pilihan_d = $_POST['pilihan_d'];
            $pilihan_e = $_POST['pilihan_e'];
            $jawaban_benar = $_POST['jawaban_benar'];

            if ($this->soal->update($id, $soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar, $tesKeahlian)) {
                header('Location: /admin/tes_keahlian/detail_ujian/' . $tesKeahlian);
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/edit_detail_tes.php';
        include 'views/layout/admin_footer.php';
    }

    // hapus soal tes
    public function hapusSoalTesKeahlian($id, $id_soal)
    {
        $tesKeahlianId = $this->tesKeahlian->get($id);
        $soal = $this->soal->get($id_soal);

        if ($this->soal->delete($id_soal)) {
            header('Location: /admin/tes_keahlian/detail_ujian/' . $id);
            exit;
        }
    }

    // sesi keahlian
    public function sesiTesKeahlian()
    {
        $sesiKeahlian = $this->sesiKeahlian->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/sesi_keahlian/sesi_tes_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function detailSesiTesKeahlian($id)
    {
        if (!empty($sesiTesKeahlian)) {
            $sesiTesKeahlian = $this->sesiKeahlian->get($id);
            include 'views/layout/admin_header.php';
            include 'views/admin/sesi_keahlian/detail_sesi_keahlian.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/sesi_tes_keahlian');
            exit;
        }
    }

    public function tambahSesiTesKeahlian()
    {
        $mataSoal = $this->mataSoal->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_sesi = $_POST['nama_sesi'];
            $mata_soal = $_POST['mata_soal'];
            $waktu_mulai = $_POST['waktu_mulai'];
            $waktu_selesai = $_POST['waktu_selesai'];
            $jenis_sesi = $_POST['jenis_sesi'];

            if ($this->sesiKeahlian->create($nama_sesi, $mata_soal, $waktu_mulai, $waktu_selesai, $jenis_sesi)) {
                header('Location: /admin/sesi_tes_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/sesi_keahlian/tambah_sesi_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function editSesiTesKeahlian($id)
    {
        $mataSoal = $this->mataSoal->getAll();
        $sesiTesKeahlian = $this->sesiKeahlian->get($id);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_sesi = $_POST['nama_sesi'];
            $mata_soal = $_POST['mata_soal'];
            $waktu_mulai = $_POST['waktu_mulai'];
            $waktu_selesai = $_POST['waktu_selesai'];
            $jenis_sesi = $_POST['jenis_sesi'];

            if ($this->sesiKeahlian->update($id, $nama_sesi, $mata_soal, $waktu_mulai, $waktu_selesai, $jenis_sesi)) {
                header('Location: /admin/sesi_tes_keahlian');
                exit;
            }
        }
    
        include 'views/layout/admin_header.php';
        include 'views/admin/sesi_keahlian/edit_sesi_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function hapusSesiTesKeahlian($id)
    {
        if ($this->sesiKeahlian->delete($id)) {
            header('Location: /admin/sesi_tes_keahlian');
            exit;
        }
    }
}