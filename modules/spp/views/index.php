<!-- main page content -->
<div class="main-container container">
    <div class="row">
        <?php if (count($data_siswa) > 1) : ?>
            <div class="col-12 px-0">
                <!-- swiper categories -->
                <div class="swiper-container connectionwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($data_siswa as $row) : ?>
                            <a href="<?= base_url('spp/index/' . $row->id_siswa); ?>" class="swiper-slide">
                                <div class="tag border <?php if ($row->id_siswa == $id_siswa) {
                                                            echo 'active';
                                                        } ?>">
                                    <span class="text-uppercase"><?= $row->nama; ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div id="base_spp">
            <div class="col-12" id="reload_spp">
                <div class="row">
                    <div class="col">
                        <div class="list-group-item rounded-20 py-1 px-1 mb-3 shadow-sm ">
                            <div class="row p-2">
                                <div class="d-flex col-auto align-items-center ">
                                    <div class="avatar avatar-50 shadow-sm rounded-12 avatar-presensi-outline">
                                        <div class="avatar avatar-40 rounded-10 avatar-presensi-inline">
                                            <i class="fa-solid fa-envelope-open-text size-24 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col align-self-center p-0">
                                    <p class="mb-0 fw-bold size-15">Sisa Tagihan</p>
                                </div>
                                <div class="col-auto d-flex justify-content-end align-items-center ps-0">
                                    <div class="">
                                        <p class="mb-0 fw-normal size-13 text-danger text-end mb-0">Jumlah Tagihan</p>
                                        <p class="mb-0 fw-normal size-12 text-secondary text-end"><?= rupiah($data_spp->jumlah_tagihan) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($data_spp->result) : ?>
                    <?php foreach ($data_spp->result as $spp) : ?>
                        <div class="row mb-3">
                            <div>
                                <div class="list-group-item rounded-15 mb-1 shadow-sm position-relative overflow-hidden p-3">
                                    <?php if ($spp->lunas === 'Y') : ?>
                                        <span class="py-2 px-3 text-light size-14 position-absolute top-0 end-0 bg-00DFA3 rounded-15-start-bottom blm-lns">Lunas</span>
                                    <?php else : ?>
                                        <?php if ($spp->status_bayar == NULL) : ?>
                                            <span class="py-2 px-3 text-light size-12 position-absolute top-0 end-0 bg-ec3528 rounded-15-start-bottom blm-lns">Belum Lunas</span>
                                        <?php elseif ($spp->status_bayar == 1) : ?>
                                            <span class="py-2 px-3 text-light size-12 position-absolute top-0 end-0 bg-ffbd17 rounded-15-start-bottom blm-lns">Menunggu Konfirmasi</span>
                                        <?php elseif ($spp->status_bayar == 3) : ?>
                                            <span class="py-2 px-3 text-light size-12 position-absolute top-0 end-0 bg-ec3528 rounded-15-start-bottom blm-lns">Pembayaran Ditolak</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="sizing-info">
                                        <span class="size-14 fw-bold"><?= $spp->nama_kategori ?> <?= month_from_number($spp->bulan) ?> <?= $spp->tahun ?></span>
                                    </div>
                                    <div class="row py-1 px-2 mt-2 mb-2 ">
                                        <div class="d-flex col-auto align-items-center ps-0 pe-2">
                                            <div class="avatar avatar-50 shadow-sm rounded-circle avatar-presensi-outline">
                                                <div class="avatar avatar-40 rounded-circle avatar-presensi-inline">
                                                    <i class="fa-solid fa-rupiah-sign size-20 text-white"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                            <p class="mb-0 fw-normal size-13 text-secondary">Jumlah bayar</p>
                                            <p class="mb-0 fw-normal size-14"><?= rupiah($spp->jumlah) ?></p>
                                        </div>
                                    </div>
                                    <?php if ($spp->nama_bank != NULL) : ?>
                                        <div class="row py-1 px-2 mb-3">
                                            <div class="d-flex col-auto align-items-center ps-0 pe-2">
                                                <div class="avatar avatar-50 shadow-sm rounded-circle avatar-presensi-outline">
                                                    <div class="avatar avatar-40 rounded-circle avatar-presensi-inline">
                                                        <i class="fa-solid fa-building-columns size-20 text-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                                <p class="mb-0 fw-normal size-13 text-secondary">Nama Bank</p>
                                                <p class="mb-0 fw-normal size-14"><?= $spp->nama_bank ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($spp->lunas === 'Y' || $spp->status_bayar != 3 && $spp->status_bayar != NULL) : ?>
                                        <?php if ($spp->status_bayar == 1) : ?>
                                            <!-- Button Menunggu Konfirmasi -->
                                            <div class="row d-flex mt-4">
                                                <div class="col-6 pe-1">
                                                    <button data-bs-toggle="modal" data-tagihan="<?= $spp->id_tagihan; ?>" data-siswa="<?= $spp->id_siswa; ?>" data-bs-target="#formulirPembayaran" role="button" class="btn btn-block btn-sm btn-danger btn-edit-pembayaran text-white button_bayar_ajax"><i class="fa-regular fa-pen-to-square me-1"></i> Edit</button>
                                                </div>
                                                <div class="col-6 ps-1">
                                                    <button data-bs-toggle="modal" onclick="button_detail(<?= $spp->id_siswa; ?>,<?= $spp->id_tagihan; ?>)" data-bs-target=" #detailTagihan" role="button" class="btn btn-block btn-sm btn-warning btn-detail-tagihan">Detail<i class="fa-regular fa-money-from-bracket ms-1"></i></button>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="row mt-4 mx-1">
                                                <a data-bs-toggle="modal" data-tagihan="<?= $spp->id_tagihan; ?>" data-siswa="<?= $spp->id_siswa; ?>" data-bs-target="#detailTagihan" role="button" class="btn btn-block btn-md btn-danger btn-detail-tugas button_detail_ajax">Detail Tagihan</a>
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <div class="row mt-4 mx-1">
                                            <a data-bs-toggle="modal" data-tagihan="<?= $spp->id_tagihan; ?>" data-siswa="<?= $spp->id_siswa; ?>" data-bs-target="#formulirPembayaran" role="button" class="btn btn-block btn-md btn-danger btn-detail-tugas button_bayar_ajax">Bayar Tagihan</a>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?= vector_default("vector_spp_kosong.svg", "Tidak ada pembayaran aktif", "Tidak ada tagihan untuk anda !, Hubungi admin atau operator jika terdapat kesalahan"); ?>

                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<!-- Page ends-->
<div class="modal fade" id="detailTagihan" tabindex="-1" aria-labelledby="detailTagihanModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content detail-tagihan">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="detailTagihanModal">Detail Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="display_content"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="formulirPembayaran" tabindex="-1" aria-labelledby="formPembayaranModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content formulir-pembayaran">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="formPembayaranModal">Formulir Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                    <div class="col-12 px-1 mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2  ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-receipt mt-0 size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-14">No. Tagihan</p>
                                <p class="mb-0 fw-normal size-12 text-secondary" id="no_tagihan"> - </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-1 mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2  ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-money-check-pen mt-0 size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-14">Kategori Pembayaran</p>
                                <p class="mb-0 fw-normal size-12 text-secondary" id="kategori_pembayaran"> - </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-1 mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2  ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-rupiah-sign mt-0 size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-14">Jumlah Pembayaran</p>
                                <p class="mb-0 fw-normal size-12 text-secondary" id="jumlah_pembayaran"> - </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 rounded-15 shadow-sm mb-2 p-2 border p-2">
                        <p class="mb-0 fw-bolder size-15 my-2 ms-1">Metode Pembayaran</p>
                        <div class="mt-2 mb-3 mx-1">
                            <input type="hidden" id="input_id_tagihan" value="">
                            <select id="select_metode" class="form-select form-select-pribadi text-secondary bg-f5f5f5 size-11 border-0">
                                <option value="" disabled selected>Pilih Metode Bayar</option>
                                <?php foreach ($data_spp->metode as $metode) : ?>
                                    <option value="<?= $metode->id_metode_bayar; ?>"><?= $metode->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="active_div"></div>
                        <?php foreach ($data_spp->metode as $metode) : ?>
                            <div class="row d-none" id="bank_display_<?= $metode->id_metode_bayar; ?>">
                                <div class="col-12">
                                    <!-- Design Baru -->
                                    <div class="card shadow-sm mb-3 text-normal">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <figure class="avatar avatar-60 p-1 shadow-sm rounded-15" style="background-image: url('<?= $metode->logo; ?>'); background-size: contain; background-position: center center; background-repeat: no-repeat;">
                                                    </figure>
                                                </div>
                                                <div class="col align-self-center">
                                                    <p class="fw-normal size-15 mb-0"><?= $metode->nama; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir Design Baru -->
                                </div>

                                <div class="col-12 ps-4 mb-1">
                                    <p class="mb-0 size-14 text-dark">Silahkan transfer ke</p>
                                </div>
                                <div class="col-12 d-flex ps-5 flex-column">
                                    <div class="detail-tft d-flex my-2">
                                        <div class="d-flex col-auto align-items-center ps-0 pe-2">
                                            <i class="fa-solid fa-circle" style="color: #ec3528"></i>
                                        </div>
                                        <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                            <p class="mb-0 fw-normal size-13"><?= $metode->nama; ?> cabang <?= $metode->cabang; ?></p>
                                        </div>
                                    </div>

                                    <div class="detail-tft d-flex mb-2">
                                        <div class="d-flex col-auto align-items-center ps-0 pe-2">
                                            <i class="fa-solid fa-circle" style="color: #ec3528"></i>
                                        </div>
                                        <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                            <p class="mb-0 fw-normal size-13">No. Rekening : <?= $metode->no_rekening; ?></p>
                                        </div>
                                    </div>

                                    <div class="detail-tft d-flex mb-2">
                                        <div class="d-flex col-auto align-items-center ps-0 pe-2">
                                            <i class="fa-solid fa-circle" style="color: #ec3528"></i>
                                        </div>
                                        <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                            <p class="mb-0 fw-normal size-13">Atas Nama : <?= $metode->atas_nama; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($metode->keterangan) : ?>
                                    <div class="col-12 ps-4 my-2">
                                        <p class="mb-0 size-14 text-dark">Keterangan :</p>
                                        <p class="mb-0 size-15 fw-medium"><?= $metode->keterangan; ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <div class='file my-1'>
                            <label for='input-file' id="button_upload_bukti" class="btn btn-block btn-md btn-danger btn-disabled">Upload Bukti Pembayaran</label>
                            <input id='input-file' type='file' disabled />
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Tagihan -->
<div class="modal fade" id="detailTagihan" tabindex="-1" aria-labelledby="detailTagihanModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="detailTagihanModal">Detail Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row m-2fix">
                    <div class="col-6 px-1 mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2  ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-receipt mt-0 size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-15">No. Tagihan</p>
                                <p class="mb-0 fw-normal size-12 text-secondary">03/44545</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 px-1  mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2 ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-calendar-week size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-15">Tanggal</p>
                                <p class="mb-0 fw-normal size-12 text-secondary">30 Maret 2022</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 px-1 mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2  ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-money-check-pen mt-0 size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-13">Kategori Biaya</p>
                                <p class="mb-0 fw-normal size-12 text-secondary">SPP Maret 2022</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 px-1  mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2 ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-rupiah-sign size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-15">Jumlah</p>
                                <p class="mb-0 fw-normal size-12 text-secondary">30 Maret 2022</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 px-1 mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2  ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-building-columns size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-13">Metode Bayar</p>
                                <p class="mb-0 fw-normal size-12 text-secondary">Bank BRI</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 px-1  mb-3">
                        <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                            <div class="d-flex col-auto align-items-center ps-0 pe-2 ">
                                <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                                    <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                        <i class="fa-solid fa-money-bill-transfer size-16 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                                <p class="mb-0 fw-bold size-13">Status Tagihan</p>
                                <p class="mb-0 fw-normal size-12 text-success">Lunas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Status SPP -->
<div class="modal fade" id="filterSPP" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="GET" action="<?= base_url("spp/index/" . $id_siswa); ?>" class="modal-content" style="box-shadow: 100px 0px 100px 100px rgb(0 0 0 / 10%)">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="data_siswa" value="<?= $id_siswa; ?>">
                <div class="mb-3">
                    <label class="form-label title-3">Kategori Pembayaran</label>
                    <select class="form-select form-select form-select-pribadi border-0" name="kategori">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($data_spp->kategori as $kategori) : ?>
                            <option value="<?= $kategori->id_kategori_biaya ?>" <?php if ($kats == $kategori->id_kategori_biaya) {
                                                                                    echo "selected";
                                                                                } ?>><?= $kategori->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label title-3">Tahun</label>
                    <select class="form-select form-select form-select-pribadi border-0" name="tahun">
                        <option value="">Semua Tahun</option>
                        <?php for ($i = (intval(date('Y')) - 7); $i <= (intval(date('Y')) + 2); $i++) { ?>
                            <option value="<?= $i; ?>" <?php if ($i == $id_tahun) {
                                                            echo ' selected';
                                                        } ?>><?= $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label title-3">Bulan</label>
                    <select class="form-select form-select form-select-pribadi border-0" name="bulan">
                        <option value="">Semua Bulan</option>
                        <?php foreach (month_from_number() as $kode => $bulan) : ?>
                            <option value="<?= $kode; ?>" <?php if ($kode == $id_bulan) {
                                                                echo "selected";
                                                            } ?>><?= $bulan; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label title-3">Status</label>
                    <select class="form-select form-select form-select-pribadi border-0" name="lunas">
                        <option value="">Semua Status</option>
                        <option value="Y" <?php if ($lunas == 'Y') {
                                                echo "selected";
                                            } ?>>Lunas</option>
                        <option value="N" <?php if ($lunas == 'N') {
                                                echo "selected";
                                            } ?>>Belum Lunas</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-block btn-md btn-danger btn-filter">Tampilkan</button>
            </div>
        </form>
    </div>
</div>