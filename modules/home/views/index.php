<!-- main page content -->
<div class="main-container container">
    <!-- Ucapan Selamat Datang -->
    <div class="row my-4 text-start">
        <div class="col-9">
            <p class="mb-0 ms-2 title-2">Halo, <?= explode(' ', $nama_wali)[0]; ?></p>
            <p class="mb-0 ms-2 title-1-home">Selamat Datang</p>
        </div>
    </div>
    <?php if (count($data_siswa) > 1) : ?>
        <div class="row mb-4 d-flex justify-content-center align-items-center me-2" style="margin-bottom : 0.75rem;" id="anak-list">
            <?php foreach ($data_siswa as $siswa) : ?>
                <div class="col-6 mb-3 anak">
                    <a href="<?= base_url('rapot') ?><?= "/{$siswa->id_siswa}" ?>" class="card mx-1 anak-wali jadwal">
                        <div class="card-body">
                            <div class="row mt-3 d-flex justify-content-center align-items-center">
                                <div class="col-auto">
                                    <div class="avatar avatar-90 bg-opac-50 p-1 shadow-sm rounded-circle anak-wali" style="background-image: url(<?= $siswa->foto; ?>);"></div>
                                </div>
                            </div>
                            <div class="row mt-3 d-flex justify-content-center align-items-center">
                                <div class="col align-self-center ps-0">
                                    <p class="size-14 text-center text-secondary mb-0"><?= $siswa->nis ?></p>
                                    <p class="text-center label-merah fw-medium">
                                        <?= tampil_text($siswa->nama, 9) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label=...>
            <ul class="pagination pagination-carousel">
                <a class="to-page d-none" href="javascript:void(0)"></a>
            </ul>
        </nav>
    <?php else : ?>
        <div class="row mb-4 d-flex justify-content-center align-items-center me-2" style="margin-bottom : 0.75rem;" id="jadwal-list">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <a href="<?= base_url('rapot/' . $data_siswa[0]->id_siswa) ?>" class="card mx-1 anak-wali-single" style="background-image: url(<?= base_url(); ?>assets/images/bg-card-wali.png); width: 100%;">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-auto d-flex justify-content-center align-items-center">
                                <div class="avatar avatar-90 bg-opac-50 p-1 shadow-sm rounded-circle anak-wali" style="background-image: url(<?= $data_siswa[0]->foto; ?>)"></div>
                            </div>
                            <div class="col align-self-center ps-3">
                                <p class="text-start fw-medium size-15 mb-0">Nama Siswa</p>
                                <p class="text-start label-merah fw-medium size-14">
                                    <?php
                                    $exNama = explode(' ', $data_siswa[0]->nama);
                                    $gabung = $exNama[0];
                                    if (isset($exNama[1])) {
                                        $gabung .= ' ' . $exNama[1];
                                    }

                                    echo $gabung;
                                    ?>
                                </p>

                                <p class="text-start fw-medium size-15 mb-0">NIS Siswa</p>
                                <p class="text-start text-secondary size-14 mb-0"><?= $data_siswa[0]->nis ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>



    <!-- Pengumuman -->
    <?php if (count($data_pengumuman) > 0) : ?>
        <div class="row mt-4 mb-3 px-1">
            <div class="col">
                <h6 class="title">Pengumuman</h6>
            </div>
            <div class="col-auto align-self-center">
                <a href="<?= base_url('home/list_pengumuman'); ?>" class="label-merah">Lihat Semua</a>
            </div>
        </div>
        <div class="row">
            <?php foreach ($data_pengumuman as $pengumuman) : ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="<?= base_url('home/detail_pengumuman/') . $pengumuman->id_pengumuman . '?redirect=true' ?>" class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
                                        <img src="<?= $pengumuman->gambar; ?>" loading="lazy" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="mb-1 size-15 fw-normal"><?= $pengumuman->judul ?></p>
                                    <p class="fw-normal text-secondary size-12"><?= nice_time($pengumuman->tanggal_mulai) ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Berita -->
    <?php if (count($data_berita) > 0) : ?>
        <div class="row mt-4 mb-3 px-1">
            <div class="col">
                <h6 class="title">Berita</h6>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('home/list_berita'); ?>" class="label-merah">Lihat Semua</a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 px-0">
                <div class="swiper-container cardswiper cardswiper-berita">
                    <div class="swiper-wrapper">
                        <?php foreach ($data_berita as $b) : ?>
                            <a href="<?= base_url('home/detail_berita/' . $b->id_konten . '?redirect=true'); ?>" class="swiper-slide">
                                <div class="card theme-bg shadow-sm card-berita" style="background-image: url('<?= $b->gambar; ?>');" loading="lazy">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto position-absolute badge-status">
                                                <span class="badge rounded-pill px-3 py-2 bg-badge fw-normal"><?= $b->nama_kategori ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrapper-text shadow-sm">
                                    <div class="row px-3 py-3">
                                        <p class="mb-1 fw-medium size-15 text-dark"><?= $b->judul ?></p>
                                        <p class="mb-0 title-4-home-text"><?= nice_title($b->keterangan, 70); ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<!-- main page content ends -->
</main>
<!-- Page ends-->