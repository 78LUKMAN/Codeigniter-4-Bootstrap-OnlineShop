<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<table class="datatable">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Total Harga</th>
            <th>Ongkir</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksi as $transaksiData): ?>
            <tr>
                <td>
                    <?= $transaksiData['username'] ?>
                </td>
                <td>
                    <?= "Rp." . number_format($transaksiData['total_harga']) ?>
                </td>
                <td>
                    <?= "Rp." . number_format($transaksiData['ongkir']) ?>
                </td>
                <td>
                    <?= ($transaksiData['status'] == 0) ? 'Belum Selesai' : 'Selesai' ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne<?= $transaksiData['id'] ?>">
                        <i class="bi bi-view-list"></i>&nbsp;View Details
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="accordion accordion-collapse" id="accordionDetailTransaksi">
                        <div class="accordion-item">
                            <div id="collapseOne<?= $transaksiData['id'] ?>" class="accordion-collapse collapse"
                                aria-labelledby="headingOne" data-bs-parent="#accordionDetailTransaksi">
                                <div class="accordion-body">
                                    <p class="fs-5 fw-bold">Detail Transaksi</p>
                                    <?php foreach ($detailTransaksiData as $detailData) { ?>
                                        <?php if ($detailData['id_transaksi'] == $transaksiData['id']) { ?>
                                            <div class="row">
                                                <div class="col-4">ID Transaksi</div>
                                                <div class="col-1">:</div>
                                                <div class="col-3 fw-normal">
                                                    <?= $detailData['id_transaksi'] ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <?php
                                                foreach ($detailProduk as $dataDetailProduk) {
                                                    if ($detailData['id_barang'] == $dataDetailProduk['id']) {
                                                        ?>
                                                        <div class="col-4">Nama Barang</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-3 fw-normal">
                                                            <?php echo $dataDetailProduk['nama']; ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <div class="row " id="heading">
                                                <div class="col-4">Jumlah Barang</div>
                                                <div class="col-1">:</div>
                                                <div class="col-3 fw-normal">
                                                    <?= $detailData['jumlah'] ?>
                                                </div>
                                            </div>
                                            <div class="row " id="heading">
                                                <div class="col-4">Subtotal [tanpa ongkir]</div>
                                                <div class="col-1">:</div>
                                                <div class="col-3 fw-normal">
                                                    <?= "Rp." . number_format($detailData['subtotal_harga']) ?>
                                                </div>
                                            </div>
                                            <div class="row " id="heading">
                                                <div class="col-4">Tanggal Transaksi</div>
                                                <div class="col-1">:</div>
                                                <div class="col-4 fw-normal">
                                                    <?= $detailData['created_date'] ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>




            <!-- Modal Detail Transaksi -->
            <div class="modal fade" id="modal<?= $transaksiData['id'] ?>" tabindex="-1"
                aria-labelledby="modalTitle<?= $transaksiData['id'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#006193">
                            <h5 class="modal-title fw-6 text-light" id="modalTitle<?= $transaksiData['id'] ?>">
                                Detail Transaksi</h5>
                        </div>
                        <div class="modal-body modal-lg">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>