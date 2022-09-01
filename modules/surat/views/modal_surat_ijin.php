<div class="modal-body bg-white">
    <div class="row m-2fix d-flex justify-content-center">
        <div class="col-11 p-0">
            <?php if (!in_array($extension, ['pdf'])) : ?>
                <figure onclick="preview_image('<?= $file_surat ?>')" class="overflow-hidden rounded-15 text-center detail-pengumuman" style="background-position: center; background-size: cover; background-image: url('<?= $file_surat ?>');">
                </figure>

            <?php else : ?>
                <figure class="overflow-hidden rounded-15 text-center" style="background-color: #FFE6E6; padding: 40px;">
                    <i class="fa-solid fa-file-pdf" style="font-size: 7rem;"></i>
                </figure>
                <a class="btn btn-block btn-md btn-filter" href="<?= $file_surat ?>">DOWNLOAD</a>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($komentar != NULL) : ?>
        <?php if ($kode_status == 1 || $kode_status == NULL) {
            $alert = 'alert-warning';
        } elseif ($kode_status == 2) {
            $alert = 'alert-success';
        } else {
            $alert = 'alert-danger';
        } ?>
        <div class="alert <?= $alert; ?>">
            <?= $komentar; ?>
        </div>
    <?php endif; ?>
    <form id="form_edit_surat" method="post" action="<?= base_url('surat/edit'); ?>" enctype="multipart/form-data" class="row g-3 mt-1">
        <div id="div_upload_file" class="col-12 d-none">
            <div class="" id="req_surat">
                <label for="formFile2" class="form-label title-3">File Surat</label>
                <input class="form-control form-control-solid form-control-pribadi file-input border-0" type="file" name="surat" id="formFile2" style="line-height: 40px;">
            </div>
        </div>
        <div class="col-12" id="req_edit_tipe">
            <label class="form-label fw-bold size-14">Jenis Surat</label>
            <input type="hidden" name="id_surat" value="<?= $id_surat_ijin; ?>">
            <input type="text" id="div_tipe" class="form-control bg-f5f5f5 size-11 pyfix-14 border-0 rounded-10 text-start" value="<?php if ($tipe == 1) {
                                                                                                                                        echo 'Surat Keterangan izin';
                                                                                                                                    } else {
                                                                                                                                        echo 'Surat Keterangan Sakit';
                                                                                                                                    } ?>" readonly>
            <select name="tipe" id="edit_tipe" class="form-select form-select-pribadi border-0 d-none" aria-label="Default select example">
                <option selected disabled>Pilih jenis surat</option>
                <option value="1" <?php if ($tipe == 1) {
                                        echo 'selected';
                                    }  ?>>Surat Keterangan Izin</option>
                <option value="2" <?php if ($tipe == 2) {
                                        echo 'selected';
                                    }  ?>>Surat Keterangan Sakit</option>
            </select>
        </div>
        <div class="col-12" id="req_edit_mulai_berlaku">
            <label class="form-label fw-bold size-14">Mulai Berlaku</label>
            <input type="date" id="mulai_berlaku" name="mulai_berlaku" class="form-control form-control-pribadi size-11 mb-0 border-0 rounded-10 text-start" value="<?= $berlaku_mulai; ?>" readonly>
        </div>
        <div class="col-12" id="req_edit_berlaku_hingga">
            <label class="form-label fw-bold size-14">Berlaku Sampai</label>
            <input type="date" id="berlaku_hingga" name="berlaku_hingga" class="form-control form-control-pribadi size-11 mb-0 border-0 rounded-10 text-start" value="<?= $berlaku_sampai; ?>" readonly>
        </div>

        <div class="modal-footer border-0 d-flex justify-content-center">
            <?php if ($kode_status != 2) : ?>
                <?php if (strtotime($berlaku_mulai) > strtotime(date('Y-m-d'))) : ?>
                    <button type="button" id="edit_surat_ijin" class="btn btn-block btn-md btn-warning btn-surat">Edit Surat</button>
                    <button type="button" id="hapus_surat_ijin" onclick="hapus_surat(<?= $id_surat_ijin; ?>)" class="btn btn-block btn-md btn-warning btn-hps-surat">Hapus Surat</button>
                    <div id="display_button_action" class="row d-flex d-none" style="width: 100vw;">
                        <!-- <button type="button" id="batal_edit_surat_ijin" class="btn btn-block btn-md btn-secondary btn-batal me-2">Batal</button>
                    <button type="button" onclick="submit_form(this,'#form_edit_surat')" id="simpan_edit_surat_ijin" class="btn btn-block btn-md btn-danger btn-simpan">Simpan</button> -->
                        <div class="col-6">
                            <button type="button" id="batal_edit_surat_ijin" class="btn btn-block btn-md btn-secondary btn-batal me-2"><i class="fa-regular fa-ban me-2"></i>Batal</button>
                        </div>
                        <div class="col-6">
                            <button type="button" onclick="submit_form(this,'#form_edit_surat')" id="simpan_edit_surat_ijin" class="btn btn-block btn-md btn-danger btn-simpan">Simpan<i class="fa-regular fa-floppy-disk ms-2"></i></button>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </form>
</div>

<script>
    var div = document.getElementById('div_tipe');
    var select = document.getElementById('edit_tipe');
    var file = document.getElementById('div_upload_file');
    var edit_surat_ijin = document.getElementById('edit_surat_ijin');
    var hapus_surat_ijin = document.getElementById('hapus_surat_ijin');
    var display_button_action = document.getElementById('display_button_action');
    $('#edit_surat_ijin').on('click', function() {
        $('#mulai_berlaku').prop('readonly', false);
        $('#berlaku_hingga').prop('readonly', false);
        div.classList.add('d-none');
        select.classList.remove('d-none');
        file.classList.remove('d-none');
        edit_surat_ijin.classList.add('d-none');
        hapus_surat_ijin.classList.add('d-none');
        display_button_action.classList.remove('d-none');
    })

    $('#batal_edit_surat_ijin').on('click', function() {
        $('#mulai_berlaku').prop('readonly', true);
        $('#berlaku_hingga').prop('readonly', true);
        div.classList.remove('d-none');
        select.classList.add('d-none');
        file.classList.add('d-none');
        edit_surat_ijin.classList.remove('d-none');
        hapus_surat_ijin.classList.remove('d-none');
        display_button_action.classList.add('d-none');
    })
</script>