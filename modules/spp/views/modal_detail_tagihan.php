<div class="modal-body bg-white">
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
                    <p class="mb-0 fw-medium size-12">No. Tagihan</p>
                    <p class="mb-0 fw-normal size-12 text-secondary" id="no-tagihan"><?= $no_tagihan ?></p>
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
                    <p class="mb-0 fw-medium size-12">Tanggal</p>
                    <p class="mb-0 fw-normal size-12 text-secondary" id="tanggal-tagihan"><?= nice_date("j M Y", $tanggal) ?></p>
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
                    <p class="mb-0 fw-medium size-12">Kategori Biaya</p>
                    <p class="mb-0 fw-normal size-12 text-secondary" id="kategori-biaya"><?= $nama_kategori ?></p>
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
                    <p class="mb-0 fw-medium size-12">Jumlah</p>
                    <p class="mb-0 fw-normal size-12 text-secondary" id="jumlah-tagihan"><?= rupiah($jumlah) ?></p>
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
                    <p class="mb-0 fw-medium size-12">Metode Bayar</p>
                    <p class="mb-0 fw-normal size-12 text-secondary" id="metode-bayar-tagihan"><?= $nama_bank ?></p>
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
                    <p class="mb-0 fw-bold size-12">Status Tagihan</p>
                    <p class="mb-0 fw-normal size-12 <?= $lunas === "Y" ? 'text-success' : 'text-danger' ?>" id="status-tagihan"><?= $lunas === "Y" ? 'Lunas' : 'Belum Lunas' ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-12 px-1 mb-3">
            <div class="col-12  d-flex py-2 px-2 mt-2 rounded-15 shadow-sm ">
                <div class="d-flex col-auto align-items-center ps-0 pe-2  ">
                    <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                        <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                            <i class="fa-solid fa-building-columns mt-0 size-16 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col align-self-center p-0 d-flex align-items-start flex-column">
                    <p class="mb-0 fw-bold size-12">Bukti Pembayaran</p>
                </div>
            </div>
        </div>

        <div class="col-11 p-0">
            <figure class="overflow-hidden rounded-15 text-center" style="background-image: url('')">
                <img src="<?= $bukti_transfer; ?>" alt="" class="w-100 mx-auto">
            </figure>
        </div>
    </div>
</div>