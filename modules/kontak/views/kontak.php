<!-- main page content -->
<div class="main-container container top-20">
    <div class="row mt-3">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="row">
                <?php if (isset($result->no_admin) && $result->no_admin != NULL) : $arr_access[] = true; ?>
                    <a href="https://wa.me/<?php echo $result->no_admin; ?>" class="col-12 mx-auto mb-4 text-dark">
                        <div class="card mb-3">
                            <div class="col-auto position-absolute avatar-detail-kbm">
                                <div class="avatar avatar-50 shadow-sm rounded-18 avatar-presensi-outline">
                                    <div class="avatar avatar-40 rounded-15 avatar-presensi-inline">
                                        <i class="fa-solid fa-phone size-18 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col align-self-center ps-4 text-detail-kbm">
                                        <p class="mb-0 size-15 fw-medium">Admin Sekolah</p>
                                        <p class="fw-normal text-secondary size-14"><?= $result->no_admin; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php else : $arr_access[] = false; ?>
                <?php endif; ?>

                <?php if (isset($result->no_keuangan) && $result->no_keuangan != NULL) : $arr_access[] = true; ?>
                    <a href="https://wa.me/<?php echo $result->no_keuangan; ?>" class="col-12 mx-auto mb-4 text-dark">
                        <div class="card mb-3">
                            <div class="col-auto position-absolute avatar-detail-kbm">
                                <div class="avatar avatar-50 shadow-sm rounded-18 avatar-presensi-outline">
                                    <div class="avatar avatar-40 rounded-15 avatar-presensi-inline">
                                        <i class="fa-solid fa-rupiah-sign size-18 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col align-self-center ps-4 text-detail-kbm">
                                        <p class="mb-0 size-15 fw-medium">Keuangan</p>
                                        <p class="fw-normal text-secondary size-14"><?= $result->no_keuangan; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php else : $arr_access[] = false; ?>
                <?php endif; ?>
                <?php if (isset($result->wali_kelas) && $result->wali_kelas != NULL) : ?>
                    <?php foreach ($result->wali_kelas as $row) : ?>
                        <?php if ($row->no_wali_kelas != NULL) : $arr_access[] = true; ?>
                            <a href="https://wa.me/<?php echo $row->no_wali_kelas; ?>" class="col-12 mx-auto mb-4 text-dark">
                                <div class="card mb-3">
                                    <div class="col-auto position-absolute avatar-detail-kbm">
                                        <div class="avatar avatar-60 shadow-sm rounded-18 avatar-presensi-outline">
                                            <div class="avatar avatar-50 rounded-18 avatar-presensi-inline">
                                                <i class="fa-solid fa-chalkboard-user size-26 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col align-self-center ps-4 text-detail-kbm">
                                                <p class="mb-0 size-15 fw-medium"><?= $row->nama_wali_kelas; ?></p>
                                                <p class="fw-normal text-secondary size-14">Wali Kelas <?= $row->nama_siswa; ?></p>
                                                <p class="fw-normal text-secondary size-14"><?= $row->no_wali_kelas; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php else : $arr_access[] = false; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>


                <?php if (!in_array(TRUE, $arr_access)) : ?>
                    <?= vector_default("vector_kontak_kosong.svg", "Tidak ada kontak!", "Pihak sekolah atau pun wali kelas belum memberikan kontak untuk anda, hubungi pihak sekolah jika terjadi kesalahan!"); ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<!-- main page content ends -->


</main>
<!-- Page ends-->