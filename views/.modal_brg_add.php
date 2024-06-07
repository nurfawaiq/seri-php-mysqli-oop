<div id="tambah" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Data Barang</h4>
			</div>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label" for="nm_brg">Nama Barang</label>
						<input type="text" name="nm_brg" class="form-control" id="nm_brg" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="hrg_brg">Harga Barang</label>
						<input type="number" name="hrg_brg" class="form-control" id="hrg_brg" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="stok_brg">Stok Barang</label>
						<input type="number" name="stok_brg" class="form-control" id="stok_brg" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="gbr_brg">Gambar Barang</label>
						<input type="file" name="gbr_brg" class="form-control" id="gbr_brg" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-danger">Reset</button>
					<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
				</div>
			</form>
			<?php
			if(@$_POST['tambah']) {
				$nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
				$hrg_brg = $connection->conn->real_escape_string($_POST['hrg_brg']);
				$stok_brg = $connection->conn->real_escape_string($_POST['stok_brg']);

				$extensi = explode(".", $_FILES['gbr_brg']['name']);
				$gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
				$sumber = $_FILES['gbr_brg']['tmp_name'];

				$upload = move_uploaded_file($sumber, "assets/img/barang/".$gbr_brg);
				if($upload) {
					$brg->tambah($nm_brg, $hrg_brg, $stok_brg, $gbr_brg);
					header("location: ?page=barang");
				} else {
					echo "<script>alert('Upload gambar gagal!')</script>";
				}
			}
			?>
		</div>
	</div>
</div>