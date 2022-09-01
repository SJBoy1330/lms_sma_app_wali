<!-- main page content -->
<div class="main-container container top-20">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="row">
                <div class="col-12">
                    <figure class="overflow-hidden rounded-15 text-center detail-berita" style="background-position: center; background-size: cover; background-image: url('<?= $berita->gambar != '' || $berita->gambar != NULL ? $berita->gambar : 'kosong' ?>');">
                    </figure>
                </div>
            </div>

            <div class="row mx-2">
                <p class="mt-2 fw-medium size-18"><?= $berita->judul ?></p>
                <p class="mb-1 title-2">Tanggal dibuat : </p>
                <p class="mb-1 title-3"><?= $berita->nice_tanggal; ?></p>
            </div>

            <div class="mt-3 mb-4 mx-2">
                <p class="text-secondary deskripsi-berita"><?= $berita->detail ?></p>
            </div>
        </div>
    </div>
</div>
<!-- main page content ends -->


</main>
<!-- Page ends-->