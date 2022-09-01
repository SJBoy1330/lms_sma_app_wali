<div class="row mb-3">
    <div class="col-6 ps-1 pe-1">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto pe-2 ps-2">
                        <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                            <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                <i class="fa-brands fa-stack-overflow size-18 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-center ps-0 pe-1">
                        <p class="mb-0 size-12 fw-medium">Mata Pelajaran</p>
                        <p class="mb-0 size-10 fw-normal text-secondary"><?= $nama_pelajaran; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 ps-1">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto pe-2 ps-2">
                        <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                            <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                <i class="fa-solid fa-hourglass-clock size-16 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-center ps-0 pe-1">
                        <p class="mb-0 size-12 fw-medium">Tanggal</p>
                        <p class="mb-0 size-10 fw-normal text-secondary"><?= date('d M Y ', $tanggal); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-6 ps-1 pe-1">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto pe-2 ps2">
                        <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                            <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                <i class="fa-solid fa-memo mt-0 size-16 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-center ps-0 pe-1">
                        <p class="mb-0 size-12 fw-medium">Nama Paket</p>
                        <p class="mb-0 size-10 fw-normal text-secondary"><?= $nama_paket; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 ps-1">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto pe-2 ps-2">
                        <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                            <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                <i class="fa-solid fa-book-open-cover mt-0 size-16 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-center ps-0 pe-1">
                        <p class="mb-0 size-12 fw-medium">Status Ujian</p>
                        <?php if ($nilai >= $kkm) : ?>
                            <p class="mb-0 size-10 fw-normal text-success">Tuntas</p>
                        <?php else : ?>
                            <p class="mb-0 size-10 fw-normal text-danger">Tidak Tuntas</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-6 ps-1 pe-1">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto pe-2 ps2">
                        <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                            <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                <i class="fa-solid fa-clock mt-0 size-18 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-center ps-0 pe-1">
                        <p class="mb-0 size-12 fw-medium">Waktu</p>
                        <p class="mb-0 size-10 fw-normal text-secondary"><?= $waktu; ?> Menit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 ps-1">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto pe-2 ps-2">
                        <div class="avatar avatar-40 shadow-sm rounded-circle avatar-presensi-outline">
                            <div class="avatar avatar-30 rounded-circle avatar-presensi-inline">
                                <i class="fa-solid fa-bullseye-pointer mt-0 size-18 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-center ps-0 pe-1">
                        <p class="mb-0 size-12 fw-medium">Nilai</p>
                        <?php if ($nilai >= $kkm) : ?>
                            <p class="mb-0 size-10 fw-normal text-success"><?= $nilai; ?></p>
                        <?php else : ?>
                            <p class="mb-0 size-10 fw-normal text-danger"><?= $nilai; ?></p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>