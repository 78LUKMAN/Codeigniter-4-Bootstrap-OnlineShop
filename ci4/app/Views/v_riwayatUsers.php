<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<table class="table datatable">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal<?= $transaksiData['id'] ?>">
                        <i class="bi bi-view-list"></i>&nbsp;View Details
                    </button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#editStatus<?= $transaksiData['id'] ?>">
                        <i class="bi bi-pencil-square"></i>&nbsp;Edit Status
                    </button>
                </td>
            </tr>
            <!-- Modal Detail Transaksi -->
            <div class="modal fade" id="modal<?= $transaksiData['id'] ?>" tabindex="-1"
                aria-labelledby="modalTitle<?= $transaksiData['id'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle<?= $transaksiData['id'] ?>">Detail Transaksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-lg">
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
                                                    <?php echo $dataDetailProduk['nama'];?>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="editStatus<?= $transaksiData['id'] ?>" tabindex="-1"
                aria-labelledby="modalTitle<?= $transaksiData['id'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle<?= $transaksiData['id'] ?>">Detail Transaksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= site_url('transaksi/editStatus/' . $transaksiData['id']) ?>"
                                method="post">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="current_status" class="form-label">Status Saat Ini</label>
                                    <input type="text" class="form-control" id="current_status" name="tatus"
                                        value="<?= ($transaksiData['status'] == 0) ? 'Belum Selesai' : 'Selesai' ?>"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="new_status" class="form-label">Ubah ke (0 : Belum Selesai, 1 :
                                        Selesai)</label>
                                    <input type="text" class="form-control" id="new_status" name="new_status"
                                        placeholder="New Status" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Ubah Status</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>