<!-- main page content -->
<div class="main-container container">
    <input type="hidden" id="access_siswa" value="<?= $id_siswa; ?>">
    <div class="row mb-2">
        <div class="col-12 col-md-12 col-lg-12" style="margin-top: 60px;">
            <div class="card shadow-none bg-transparent">
                <div class="card-body tabcontent-wali" id="Tugas" style="padding: 6px 0px;">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 d-flex mb-3">
                                    <div class="col-auto align-self-center">
                                        <div class="avatar avatar-50 shadow-sm rounded-circle avatar-presensi-outline">
                                            <div class="avatar avatar-40 rounded-circle avatar-presensi-inline">
                                                <i class="fa-solid fa-school size-18 text-white"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ms-2 align-self-center" style="flex-wrap: wrap;">
                                        <p class="mb-0 size-13 fw-normal text-secondary">Nama Sekolah</p>
                                        <p class="mb-0 size-14 fw-normal"><?= $result->detail->sekolah; ?></p>
                                    </div>
                                </div>
                                <div class="col-12 d-flex mb-3">
                                    <div class="col-auto align-self-center">
                                        <div class="avatar avatar-50 shadow-sm rounded-circle avatar-presensi-outline">
                                            <div class="avatar avatar-40 rounded-circle avatar-presensi-inline">
                                                <i class="fa-solid fa-building-user size-18 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 align-self-center" style="flex-wrap: wrap;">
                                        <p class="mb-0 size-13 fw-normal text-secondary">Kelas</p>
                                        <p class="mb-0 size-14 fw-normal"><?= $result->detail->kelas; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex mb-3">
                                    <div class="col-auto align-self-center">
                                        <div class="avatar avatar-50 shadow-sm rounded-circle avatar-presensi-outline">
                                            <div class="avatar avatar-40 rounded-circle avatar-presensi-inline">
                                                <i class="fa-solid fa-globe-stand size-22 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 align-self-center" style="flex-wrap: wrap;">
                                        <p class="mb-0 size-13 fw-normal text-secondary">Tahun Ajaran</p>
                                        <p class="mb-0 size-14 fw-normal"><?= $result->detail->tahun_ajaran; ?></p>
                                    </div>
                                </div>
                                <div class="col-12 d-flex">
                                    <div class="col-auto">
                                        <div class="avatar avatar-50 shadow-sm rounded-circle avatar-presensi-outline">
                                            <div class="avatar avatar-40 rounded-circle avatar-presensi-inline">
                                                <i class="fa-solid fa-location-dot size-20 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2 align-self-center" style="flex-wrap: wrap;">
                                        <p class="mb-0 size-13 fw-normal text-secondary">Alamat</p>
                                        <p class="mb-0 size-14 fw-normal"><?= $result->detail->alamat; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <h6 class="title"><i class="fa-solid fa-circle nilai me-2"></i>Nilai Akademik</h6>
                        </div>
                    </div>
                    <?php if (isset($result->tugas) && $result->tugas != NULL) : ?>
                        <?php foreach ($result->tugas as $tugas) : ?>
                            <a data-bs-toggle="modal" data-pelajaran="<?= $tugas->id_pelajaran; ?>" data-kelas="<?= $tugas->id_kelas; ?>" href="#modalDetailTugas" role="button" class="card mb-4 button_daftar_tugas">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 shadow-sm rounded-15 avatar-presensi-outline">
                                                <div class="avatar avatar-40 rounded-12 avatar-presensi-inline">
                                                    <i class="fa-brands fa-stack-overflow size-24 text-white"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col align-self-center ps-0">
                                            <p class="mb-0 size-13 fw-normal text-secondary">Mata Pelajaran</p>
                                            <p class="mb-0 size-14 fw-normal"><?= nice_title($tugas->nama_pelajaran, 50); ?></p>
                                            <?php if ($tugas->persentase != 0) : ?>
                                                <div class="progress mt-1 rounded-10" style="height:20px;">
                                                    <div class="progress-bar bg-danger-pribadi" role="progressbar" style="width :<?= $tugas->persentase; ?>% ;" aria-valuemin="0" aria-valuemax="100"><?= $tugas->persentase . '%' ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?= vector_default("vector_tugas_kosong.svg", "Tidak ada data tugas", "Kelas putra/putri anda belum memberikan tugas apapun, Hubungi pihak sekolah jika terjadi kesalahan data"); ?>
                    <?php endif; ?>
                </div>
                <input type="hidden" id="pelajaran_aktif">
                <div class="card-body tabcontent-wali" id="Ujian" style="padding: 6px 0px;">
                    <?php if ($result->ujian) : ?>
                        <div class="wrapper-searching-tugas mb-3">
                            <div class="wrapper-samaran"></div>
                            <div class="row bg-white" style="width: 100vw;">
                                <div class="col-12">
                                    <div class="input-group">
                                        <input type="text" onkeyup="search(this, '.target_search','#vector_pelajaran')" class=" form-control form-control-pribadi pencarian" placeholder="Pencarian" aria-label="Pencarian" aria-describedby="basic-addon2">
                                        <button class="input-group-text searhing" id="basic-addon2" style="background-color:#EC3528;"><i class="fa-solid fa-magnifying-glass size-20 text-white"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="page-scroll-full pt-5" id="display_ujian">
                        <?php if (isset($result->ujian) && $result->ujian != NULL) : ?>
                            <?php foreach ($result->ujian as $ujian) : ?>
                                <a data-bs-toggle="offcanvas" type="button" onclick="set_id(<?= $ujian->id_pelajaran; ?>)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-<?= $ujian->id_pelajaran; ?>" aria-controls="offcanvasRight" class="card my-4 zoom-filter showing target_search">
                                    <div class="card-body">
                                        <div class=" row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-50 shadow-sm rounded-15 avatar-presensi-outline">
                                                    <div class="avatar avatar-40 rounded-12 avatar-presensi-inline">
                                                        <i class="fa-brands fa-stack-overflow size-24 text-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col align-self-center ps-0">
                                                <p class="mb-0 size-15 fw-normal search_target"><?= nice_title($ujian->nama_pelajaran, 50); ?></p>
                                            </div>
                                            <div class="col-auto align-self-center pe-3">
                                                <i class="fa-regular fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight-<?= $ujian->id_pelajaran; ?>" aria-labelledby="offcanvasRightLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasExampleLabel-<?= $ujian->id_pelajaran ?>">Daftar Ujian <br>
                                            <p class="size-13 fw-medium text-secondary"><?= $ujian->nama_pelajaran; ?></p>
                                        </h5>

                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="row bg-white" style="width: 100vw;">
                                            <div class="col-10">
                                                <div class="input-group">
                                                    <input onkeyup="search(this, '.target_<?= $ujian->id_pelajaran; ?>','#vector_ujian_<?= $ujian->id_pelajaran; ?>')" id="cari_pelajaran" type="text" class="form-control form-control-pribadi pencarian" placeholder="Pencarian" aria-label="Pencarian" aria-describedby="search-ujian-<?= $ujian->id_pelajaran; ?>">
                                                    <button class="input-group-text searhing" id="search-ujian-<?= $ujian->id_pelajaran; ?>" style="background-color:#EC3528;;"><i class="fa-solid fa-magnifying-glass size-20 text-white"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center ps-0">
                                                <button class="btn filter-tugas border-0 button_filter" data-id="<?= $ujian->id_pelajaran; ?>" data-bs-toggle="modal" data-bs-target="#filterUjian">
                                                    <i class="fa-regular fa-filter" style="color: #EC3528;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="display_ujian_detail_<?= $ujian->id_pelajaran ?>">
                                            <?php foreach ($ujian->result as $row) : ?>
                                                <a data-bs-toggle="modal" data-id="<?= $row->id_ujian ?>" data-status="<?php
                                                                                                                        if ($row->nilai < $row->kkm) {
                                                                                                                            echo 'belum_lulus';
                                                                                                                        } else {
                                                                                                                            echo 'lulus';
                                                                                                                        }
                                                                                                                        ?>" data-id="<?= $row->id_ujian; ?>" href="#detailUjianModal" role="button" class="card my-4 zoom-filter blabla showing target_<?= $ujian->id_pelajaran; ?> button_detail_ujian">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <div class="avatar avatar-50 shadow-sm rounded-15 avatar-presensi-outline">
                                                                    <div class="avatar avatar-40 rounded-12 avatar-presensi-inline">
                                                                        <i class="fa-brands fa-stack-overflow size-24 text-white"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col align-self-center ps-0">
                                                                <p class="mb-0 size-14 fw-normal"><?= nice_title($row->nama_paket, 30); ?></p>
                                                                <p class="mb-0 size-13 fw-normal 
                                                                  <?php
                                                                    if ($row->nilai < $row->kkm) {
                                                                        echo 'text-danger';
                                                                    } else {
                                                                        echo 'text-success';
                                                                    }
                                                                    ?>">
                                                                    <?php
                                                                    if ($row->nilai < $row->kkm) {
                                                                        echo 'Tidak lulus';
                                                                    } else {
                                                                        echo 'Lulus';
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-auto align-self-center pe-3">
                                                                <i class="fa-regular fa-chevron-right"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                            <?= vector_default("vector_ujian_kosong.svg", "Tidak ada data ujian", "Sekolah belum menyediakan ujian atau siswa belum mengikuti ujian satupun, hubungi pihak sekolah jika terjadi kesalahan data!", "vector_ujian_" . $ujian->id_pelajaran, count($ujian->result)); ?>
                                        </div>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?= vector_default("vector_ujian_kosong.svg", "Tidak ada data ujian", "Sekolah belum menyediakan ujian atau siswa belum mengikuti ujian satupun, Hubungi pihak sekolah jika terjadi kesalahan data!", "vector_pelajaran", count($result->ujian)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- main page content ends -->
</main>
<!-- Page ends-->

<!-- Modal Detail Tugas -->
<div class="modal fade" id="modalDetailTugas" tabindex="-1" aria-labelledby="daftar_tugas_siswa" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content detail-tugas-ujian">
            <div class="modal-header">
                <h5 class="modal-title" id="daftar_tugas_siswa">Daftar Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="display_daftar_tugas">
                <div class="row bg-white" style="position: fixed; z-index: 1;">
                    <div class="wrapper-searching-tugas mb-3">
                        <div class="wrapper-samaran"></div>
                        <div class="row bg-white" style="width: 100vw;">
                            <div class="col-10">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-pribadi pencarian" placeholder="Pencarian" aria-label="Pencarian" aria-describedby="basic-addon2">
                                    <button class="input-group-text searhing" id="basic-addon2" style="background-color:#EC3528;;"><i class="fa-solid fa-magnifying-glass size-20 text-white"></i></button>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center ps-0">
                                <button class="btn btn-secondary filter-tugas border-0" data-bs-toggle="modal" data-bs-target="#filterKeteranganTugas">
                                    <i class="fa-regular fa-filter" style="color: #EC3528;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Detail Ujian Modal -->
<div class="modal fade" id="detailUjianModal" tabindex="-1" aria-labelledby="detail_ujian" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="box-shadow: 100px 0px 100px 100px rgb(0 0 0 / 10%)">
            <div class="modal-header">
                <h5 class="modal-title" id="detail_ujian">Detail Ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="display_detail_ujian">

            </div>
        </div>
    </div>
</div>

<!-- Filter Keterangan Raport -->
<div class="modal fade" id="filterUjian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="box-shadow: 100px 0px 100px 100px rgb(0 0 0 / 10%)">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label title-3">Status Ujian</label>
                    <select class="form-select form-select form-select-pribadi border-0" id="status_ujian">
                        <option value="all">Semua</option>
                        <option value="lulus">Lulus</option>
                        <option value="belum_lulus">Belum Lulus</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <input type="hidden" id="id_pelajaran_display">
                <button type="button" onclick="filter_rapot()" class="btn btn-block btn-md btn-danger btn-filter">Tampilkan</button>
            </div>
        </div>
    </div>
</div>


<!-- Filter Keterangan Tugas -->
<div class="modal fade" id="filterKeteranganTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="box-shadow: 100px 0px 100px 100px rgb(0 0 0 / 10%)">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Keterangan Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label title-3">Status tugas</label>
                    <select class="form-select form-select form-select-pribadi border-0" id="select_status_tugas">
                        <option value="all">Semua</option>
                        <option value="selesai">Selesai</option>
                        <option value="belum_dikerjakan">Belum dikerjakan</option>
                        <option value="koreksi">Menunggu Koreksi</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" onclick="filter_tugas()" class="btn btn-block btn-md btn-danger btn-filter">Tampilkan</button>
            </div>
        </div>
    </div>
</div>