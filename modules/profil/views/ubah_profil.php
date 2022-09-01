<!-- comment -->
<div class="row mx-2">
    <div class="col-12">
        <form class="row g-3 mt-1" method="POST" action="<?= base_url('func_profil/edit_profil_proses'); ?>" id="form_ubah_profil">
            <!-- <div class="col-12" id="req_agama">
                        Agama:
                        <select name="agama" id="agama">
                            <?php foreach ($data_agama as $agama) : ?>
                                <option style="color: black;" value="<?= $agama->id_agama ?>" <?= $agama->id_agama == $data_wali->id_agama ? 'selected' : ''   ?>><?= $agama->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div> -->

            <div class="col-12" id="req_nama">
                <label for="nama" class="form-label fw-bold size-14">Nama lengkap</label>
                <input type="text" class="form-control form-control-pribadi text-start" id="nama" name="nama" placeholder="Masukan nama anda" autocomplete="off" value="<?= $data_wali->nama ?>">
            </div>
            <div class="col-12" id="req_agama">
                <label for="agama" class="form-label fw-bold size-14">Agama</label>
                <select name="agama" id="agama" class="form-select form-select-select form-select-pribadi border-0">
                    <?php foreach ($data_agama as $agama) : ?>
                        <option style="color: black;" value="<?= $agama->id_agama ?>" <?= $agama->id_agama == $data_wali->id_agama ? 'selected' : ''   ?>><?= $agama->nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12" id="req_alamat">
                <label for="alamat" class="form-label fw-bold size-14">Alamat</label>
                <input type="text" class="form-control form-control-pribadi text-start" id="alamat" name="alamat" placeholder="Masukan alamat rumah" autocomplete="off" value="<?= $data_wali->alamat ?>">
            </div>
            <div class="col-12" id="req_nohp">
                <label for="nohp" class="form-label fw-bold size-14">No. Telepon</label>
                <input type="text" class="form-control form-control-pribadi text-start" id="nohp" name="nohp" placeholder="Masukan nomor telepon" value="<?= $data_wali->telp ?>">
            </div>
            <div class="col-12 mb-4" id="req_email">
                <label for="email" class="form-label fw-bold size-14">Email</label>
                <input type="email" class="form-control form-control-pribadi text-start" id="email" name="email" placeholder="Masukan email anda" autocomplete="off" value="<?= $data_wali->email ?>">
            </div>
        </form>
    </div>

    <div class="col-11 col-sm-11 mt-auto mx-auto pt-4 pb-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center d-grid">
                <button type="submit" id="button_submit" onclick="submit_form(this,'#form_ubah_profil')" class="w-100 py-3 rounded-pill btn btn-primary bg-ec3528 border-white size-10 fw-medium btn-simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>