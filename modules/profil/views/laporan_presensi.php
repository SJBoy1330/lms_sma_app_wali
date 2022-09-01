<div class="main-container container">
    <?php if (count($data_siswa) > 1) : ?>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row mb-2 my-2">
                    <div class="col-12 px-0">
                        <div class="swiper-container connectionwiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($data_siswa as $row) : ?>
                                    <a href="<?= base_url('profil/laporan_presensi/' . $row->id_siswa) ?>" class="swiper-slide">
                                        <div class="tag border <?php if ($row->id_siswa == $id_siswa) {
                                                                    echo 'active';
                                                                } ?>">
                                            <span class="text-uppercase"><?= $row->nama; ?></span>
                                        </div>
                                    </a>
                                    <?php if ($row->id_siswa == $id_siswa) : ?>
                                        <input type="hidden" id="id_kelas" value="<?= $row->id_kelas; ?>">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <?php if (count($data_siswa) <= 1) : ?>
            <input type="hidden" id="id_kelas" value="<?= $id_kelas; ?>">
        <?php endif; ?>
        <div class=" col-12">
            <input type="hidden" value="<?= $id_siswa; ?>" id="id_siswa">
            <div id="calendar" class="my-2 rounded-3 shadow-sm"></div>
            <div id="display_detail" class="calendar-event shadow-sm pb-1" style="background-color: #FFFFFF;">

            </div>
        </div>
    </div>
</div>