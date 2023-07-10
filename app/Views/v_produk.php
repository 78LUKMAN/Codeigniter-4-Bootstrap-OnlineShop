<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
	?>
	<div class="alert alert-info alert-dismissible fade show" role="alert">
		<?= session()->getFlashData('success') ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php
}
?>
<?php
if (session()->getFlashData('failed')) {
	?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= session()->getFlashData('failed') ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
<i class="bi bi-plus-square"></i>&nbsp;Tambah Data
</button>
<!-- Table with stripped rows -->
<table class="table datatable">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama</th>
			<th scope="col">Harga</th>
			<th scope="col">Jumlah</th>
			<th scope="col">Keterangan</th>
			<th scope="col">Foto</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($produks as $index => $produk): ?>
			<tr>
				<th scope="row">
					<?php echo $index + 1 ?>
				</th>
				<td>
					<?php echo $produk['nama'] ?>
				</td>
				<td>
					<?php echo "Rp." . number_format($produk['hrg'])?>
				</td>
				<td>
					<?php echo $produk['jml'] ?>
				</td>
				<td>
					<?php echo $produk['keterangan'] ?>
				</td>
				<td><img src="<?php echo base_url() . "public/img/" . $produk['foto'] ?>" width="100px"></td>
				<td>
					<button type="button" class="btn btn-warning" data-bs-toggle="modal"
						data-bs-target="#editModal-<?= $produk['id'] ?>">
						<i class="bi bi-pencil-square"></i>&nbsp;Ubah &nbsp;
					</button>
					<a href="<?= base_url('produk/delete/' . $produk['id']) ?>" class="btn btn-danger"
						onclick="return confirm('Yakin hapus data ini ?')">
						<i class="bi bi-trash"></i>&nbsp;Hapus
					</a>
				</td>
			</tr>
			<!-- Edit Modal Begin -->
			<div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Data</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post"
							enctype="multipart/form-data">
							<?= csrf_field(); ?>
							<div class="modal-body">
								<div class="form-group">
									<label for="name">Nama</label>
									<input type="text" name="nama" class="form-control" id="nama"
										value="<?= $produk['nama'] ?>" placeholder="Nama Barang" required>
								</div>
								<div class="form-group">
									<label for="name">Harga</label>
									<input type="text" name="harga" class="form-control" id="harga"
										value="<?= $produk['hrg'] ?>" placeholder="Harga Barang" required>
								</div>
								<div class="form-group">
									<label for="name">Jumlah</label>
									<input type="text" name="jumlah" class="form-control" id="jumlah"
										value="<?= $produk['jml'] ?>" placeholder="Jumlah Barang" required>
								</div>
								<div class="form-group">
									<label for="name">Keterangan</label>
									<input type="text" name="keterangan" class="form-control" id="keterangan"
										value="<?= $produk['keterangan'] ?>" placeholder="Keterangan Barang" required>
								</div>
								<img src="<?php echo base_url() . "public/img/" . $produk['foto'] ?>" width="100px">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="check" name="check" value="1">
									<label class="form-check-label" for="check">
										Ceklis jika ingin mengganti foto
									</label>
								</div>
								<div class="form-group">
									<label for="name">Foto</label>
									<input type="file" class="form-control" id="foto" name="foto">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Edit Modal End -->
		<?php endforeach ?>
	</tbody>
</table>
<!-- End Table with stripped rows -->
<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Nama</label>
						<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang"
							required>
					</div>
					<div class="form-group">
						<label for="name">Harga</label>
						<input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang"
							required>
					</div>
					<div class="form-group">
						<label for="name">Jumlah</label>
						<input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Barang"
							required>
					</div>
					<div class="form-group">
						<label for="name">Keterangan</label>
						<input type="text" name="keterangan" class="form-control" id="keterangan"
							placeholder="Keterangan Barang" required>
					</div>
					<div class="form-group">
						<label for="name">Foto</label>
						<input type="file" class="form-control" id="foto" name="foto">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Add Modal End -->
<?= $this->endSection() ?>