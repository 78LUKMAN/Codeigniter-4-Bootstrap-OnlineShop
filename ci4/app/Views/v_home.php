<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session()->getFlashData('success') ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php
}
?>
<div class="row">
	<?php foreach ($produks as $index => $produk): ?>
		<div class="row-lg-6">
			<?= form_open('keranjang') ?>
			<?php
			echo form_hidden('id', $produk['id']);
			echo form_hidden('nama', $produk['nama']);
			echo form_hidden('hrg', $produk['hrg']);
			echo form_hidden('foto', $produk['foto']);
			?>
			<div class="card">
				<div class="card-body">
					<div class="col d-flex">
						<img src="<?php echo base_url() . "public/img/" . $produk['foto'] ?>" alt="..." width="200px"
							class="mt-4">
						<h5 class="card-title p-5">
							<?php echo $produk['nama'] ?><br>
							<p style="font-size:18px" class="mt-1">
								<?php echo "Rp." . number_format($produk['hrg']) ?><br><br>
							</p>
							<p style="font-size:13px; color:gray">
								<?php echo "Deskripsi : " . $produk['keterangan'] ?><br>
							</p>
							<button type="submit" class="btn btn-info rounded" style="font-size:15px"><i class="bi bi-cart"></i>&nbsp;Beli</button>
						</h5>
					</div>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	<?php endforeach ?>
</div>
<?= $this->endSection() ?>