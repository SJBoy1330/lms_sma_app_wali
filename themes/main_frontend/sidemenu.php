<!-- Sidebar main menu -->
<div class="sidebar-wrap  sidebar-overlay">
    <!-- Add pushcontent or fullmenu instead overlay -->
    <div class="closemenu text-muted">Close Menu</div>
    <div class="sidebar">
        <!-- user information -->
        <div class="row my-3">
            <div class="col-12 profile-sidebar" id="reload_side_foto">
                <div class="row mt-3" id="side_foto_profil">
                    <div class=" col-auto">
                        <figure class="avatar avatar-80 rounded-20 p-1 bg-white shadow-sm figure-sidemenu" style="background-image: url('<?= $profil->foto; ?>')"></figure>
                    </div>
                    <div class="col px-0 align-self-center">
                        <h5 class="mb-0 fw-normal text-white"><?= tampil_text($profil->nama, 8); ?></h5>
                        <p class="text-muted size-12">Wali Murid</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- user emnu navigation -->
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link <?= (set_active($this->uri->segment(1), 'home', $this->uri->segment(2), array())) ?>" aria-current="page" href="<?= base_url('home'); ?>">
                            <div class="avatar avatar-40 icon"><i class="fa-solid fa-house"></i></div>
                            <div class="col">Beranda</div>
                            <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link <?= (set_active($this->uri->segment(1), 'spp', $this->uri->segment(2), array())) ?>" href="<?= base_url('spp'); ?>" tabindex="-1">
                            <div class="avatar avatar-40 icon"><i class="fa-solid fa-envelope-open-dollar"></i></div>
                            <div class="col">SPP</div>
                            <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (set_active($this->uri->segment(1), 'surat', $this->uri->segment(2), array())) ?>" href="<?= base_url('surat') ?>" tabindex="-1">
                            <div class="avatar avatar-40 icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                            <div class="col">Surat Ijin</div>
                            <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (set_active($this->uri->segment(1), 'home/list_pengumuman', $this->uri->segment(2), array())) ?>" href="<?= base_url('home/list_pengumuman') ?>" tabindex="-1">
                            <div class="avatar avatar-40 icon"><i class="fa-solid fa-bullhorn"></i></div>
                            <div class="col">Pengumuman</div>
                            <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item <?= (set_active($this->uri->segment(1), 'home/list_berita', $this->uri->segment(2), array())) ?>">
                        <a class="nav-link" href="<?= base_url('home/list_berita') ?>" tabindex="-1">
                            <div class="avatar avatar-40 icon"><i class="fa-solid fa-newspaper"></i></div>
                            <div class="col">Berita</div>
                            <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item <?= (set_active($this->uri->segment(1), 'toko', $this->uri->segment(2), array())) ?>">
                        <a class="nav-link" href="<?= base_url('toko') ?>" tabindex="-1">
                            <div class="avatar avatar-40 icon"><i class="fa-solid fa-shop"></i></div>
                            <div class="col">Toko</div>
                            <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item logout">
                        <a class="nav-link question_alert" href="<?= base_url('auth/logout') ?>" <?= alert_question('KONFIRMASI', 'Apakah anda akan keluar dari aplikasi KlasQ Wali ?', 'question') ?> tabindex="-1">
                            <div class="avatar avatar-40 icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                            <div class="col">Keluar</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar main menu ends -->


<!-- Begin page -->
<main class="h-100">

    <!-- Header -->
    <?php if (isset($khusus['rapot'])) : ?>
        <header class="header tugas-ujian position-fixed" style="background-color: #EC3528;">
        <?php else : ?>
            <header class="header position-fixed">
            <?php endif; ?>
            <div class="row" id="header_config">
                <div class="col-auto">
                    <?php if (isset($button_back)) : ?>
                        <a href="<?= $button_back ?>" target="_self" class="btn btn-44">
                            <?php if (isset($text['white'])) : ?>
                                <i class="fa-solid fa-chevron-left text-white"></i>
                            <?php else : ?>
                                <i class="fa-solid fa-chevron-left text-dark"></i>
                            <?php endif; ?>
                        </a>
                    <?php else : ?>
                        <div class="col-auto">
                            <a href="javascript:void(0)" target="_self" class="btn btn-44 menu-btn">
                                <img src="<?= base_url(); ?>assets/icons/hamburger.png" width="24" alt="">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col d-flex justify-content-center align-items-center text-center">
                    <?php if (isset($text['white'])) : ?>
                        <h6 class="text-white"><?php if (isset($judul_halaman)) {
                                                    echo $judul_halaman;
                                                }; ?></h6>
                    <?php else : ?>
                        <h6 class="text-dark"><?php if (isset($judul_halaman)) {
                                                    echo $judul_halaman;
                                                }; ?></h6>
                    <?php endif; ?>
                </div>
                <div class="col-auto">
                    <?php if (!isset($config_hidden['notifikasi']) && $config_hidden['notifikasi'] != true) : ?>
                        <a href="<?= base_url('notifikasi'); ?>" target="_self" class="btn btn-44 rounded-circle btn-notifikasi">
                            <img src="<?= base_url(); ?>assets/icons/notif.png" width="24" alt="">
                            <!-- <span class="count-indicator"></span> -->
                        </a>
                    <?php endif; ?>
                    <?php if (isset($right_button['spp'])) : ?>
                        <a href="#" target="_self" class="btn btn-44" data-bs-toggle="modal" data-bs-target="#filterSPP"><i class="fa-regular fa-filter"></i></a>
                    <?php endif; ?>

                    <?php if (isset($right_button['profil'])) : ?>
                        <button type="button" class="btn btn-44" id="button_submit_atas" onclick="submit_form(this,'#form_ubah_profil')">
                            <i class="fa-solid fa-check"></i>
                        </button>

                    <?php endif; ?>


                    <?php if (isset($right_button['ubah_password'])) : ?>
                        <button type="button" class="btn btn-44" id="button_submit_atas" onclick="submit_form(this,'#form_ubah_password')">
                            <i class="fa-solid fa-check"></i>
                        </button>

                    <?php endif; ?>

                    <?php if (isset($config_hidden['notifikasi']) && !isset($right_button)) : ?>
                        <a href="#" target="_self" class="btn btn-44"> </a>
                    <?php endif; ?>

                </div>

            </div>
            <?php if (isset($khusus['rapot'])) : ?>
                <div class="d-flex justify-content-center">
                    <div class="tablinknya-tugas-ujian">
                        <div class="col-12 align-self-center tab-wali" style="display: flex; justify-content:center; align-items:center;">
                            <button id="defaultOpen" class="tablinks-wali" onclick="openCity(event, 'Tugas')" style=" width: 100%; height: 100%; padding: 10px;">Tugas</button>
                            <button class="tablinks-wali" onclick="openCity(event, 'Ujian')" style="width: 100%; height: 100%; padding: 10px;">Ujian</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            </header>
            <!-- Header ends -->