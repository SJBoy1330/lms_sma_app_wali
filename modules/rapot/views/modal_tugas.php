<?php if ($result) : ?>
    <div class="row bg-white" style="position: fixed; z-index: 1;">
        <div class="wrapper-searching-tugas mb-3">
            <div class="wrapper-samaran"></div>
            <div class="row bg-white" style="width: 100vw;">
                <div class="col-10">
                    <div class="input-group">
                        <!--onkeyup="search(this, '#loop_tugas', '.target_cari_tugas')" -->
                        <input type="text" onkeyup="search(this, '.target_cari_tugas','#vector_detail_tugas')" id="cari_tugas" class=" form-control form-control-pribadi pencarian" placeholder="Pencarian" aria-label="Pencarian" aria-describedby="basic-addon2">
                        <button class="input-group-text searhing" id="basic-addon2" style="background-color:#EC3528;;"><i class="fa-solid fa-magnifying-glass size-20 text-white"></i></button>
                    </div>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center ps-0">
                    <button class="btn filter-tugas border-0" data-bs-toggle="modal" data-bs-target="#filterKeteranganTugas">
                        <i class="fa-regular fa-filter" style="color: #EC3528;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="page-scroll pt-5" id="loop_tugas">
    <?php if ($result) : ?>
        <?php foreach ($result as $row) : ?>
            <div class="card my-4 kon_tugas zoom-filter showing target_cari_tugas" data-katgas="<?php if ($row->dikerjakan == FALSE) {
                                                                                                    echo 'belum_dikerjakan';
                                                                                                } else {
                                                                                                    if ($row->kode_status == 1) {
                                                                                                        echo 'koreksi';
                                                                                                    } elseif ($row->kode_status == 2) {
                                                                                                        echo 'selesai';
                                                                                                    } elseif ($row->kode_status == 3) {
                                                                                                        echo 'ditolak';
                                                                                                    }
                                                                                                } ?>">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-50 shadow-sm rounded-15 avatar-presensi-outline">
                                <div class="avatar avatar-40 rounded-12 avatar-presensi-inline">
                                    <i class="fa-brands fa-stack-overflow size-24 text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="mb-0 size-14 fw-normal"><?= nice_title($row->nama, 30); ?></p>
                            <?php if ($row->dikerjakan != FALSE) : ?>
                                <p class="mb-0 size-13 fw-normal <?php if ($row->kode_status == 1) {
                                                                        echo 'text-warning';
                                                                    } elseif ($row->kode_status == 2) {
                                                                        echo 'text-success';
                                                                    } else {
                                                                        echo 'text-danger';
                                                                    } ?>"><?= $row->status; ?></p>
                            <?php else : ?>
                                <p class="mb-0 size-13 fw-normal text-danger">Belum dikerjakan</p>
                            <?php endif; ?>
                        </div>
                        <?php if ($row->dikerjakan != FALSE) : ?>
                            <?php if ($row->kode_status != 1) : ?>
                                <div class="col-auto align-self-center">
                                    <div class="<?php if ($row->kode_status == 3) {
                                                    echo 'nilai-tugas-merah';
                                                } else {
                                                    echo 'nilai-tugas';
                                                } ?>">
                                        <p><?= $row->nilai; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?= vector_default("vector_tugas_kosong.svg", "Tidak ada daftar tugas", "Sekolah belum menyediakan tugas, Hubungi pihak sekolah jika terjadi kesalahan data!", 'vector_detail_tugas', count($result)); ?>

</div>