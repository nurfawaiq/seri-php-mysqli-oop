<?php
include "models/m_barang.php";
$brg = new Barang($connection);

if(@$_GET['act'] == '') {
?>
	<div class="row">
      <div class="col-lg-12">
        <h1>Barang <small>Data Barang</small></h1>
        <ol class="breadcrumb">
          <li><a href=""><i class="fa fa-dashboard"></i></a></li>
          <li><a href="">Barang</a></li>
          <li class="active">Data Barang</li>
        </ol>
      </div>
    </div>

    <div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="datatables">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Barang</th>
							<th>Harga Barang</th>
							<th>Stok Barang</th>
							<th>Gambar Barang</th>
							<th>Tgl Publish</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            $tampil = $brg->tampil();
			            while($data =  $tampil->fetch_object()) {
			            ?>
			    		<tr>
			                <td align="center"><?php echo $no++."."; ?></td>
			                <td><?php echo $data->nama_brg; ?></td>
			                <td><?php echo "Rp. ".number_format($data->harga_brg, 2, ",", "."); ?></td>
			                <td><?php echo $data->stok_brg; ?></td>
			                <td align="center">
			                	<img src="assets/img/barang/<?php echo $data->gbr_brg; ?>" width="70px">
			                </td>
			                <td><?=date('d F Y', strtotime($data->tgl_publish)); ?></td>
							<td align="center">
								<a id="edit_brg" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_brg; ?>" data-nama="<?php echo $data->nama_brg; ?>" data-harga="<?php echo $data->harga_brg; ?>" data-stok="<?php echo $data->stok_brg; ?>" data-gbr="<?php echo $data->gbr_brg; ?>"><button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
								
								<a href="?page=barang&act=del&id=<?=$data->id_brg; ?>" onclick="return confirm('Yakin akan menghapus data ini?')"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button></a>
								
								<a href="./report/cetak_barang.php?id=<?=$data->id_brg; ?>" target="_blank"><button class="btn btn-default btn-xs"><i class="fa fa-print"></i> Cetak</button></a>
							</td>
						</tr>
						<?php
						} ?>
					</tbody>
				</table>
			</div>

			<a class="btn btn-success" data-toggle="modal" data-target="#tambah" style="margin-bottom: 5px;"><i class="fa fa-plus"></i> Tambah Data</a> 
			
			<a class="btn btn-default" href="./report/export_excel_barang.php" target="_blank" style="margin-bottom: 5px;"><i class="fa fa-print"></i> Export Excel</a>
			
			<a class="btn btn-default" data-toggle="modal" data-target="#cetakpdf" style="margin-bottom: 5px;"><i class="fa fa-print"></i> Cetak PDF</a>

			<?php
			include ".modal_brg_add.php";
			include ".modal_brg_edit.php";
			include ".modal_brg_cetak.php";
			?>

		</div>
    </div>
<?php
} else if(@$_GET['act'] == 'del') {
	$gbr_awal = $brg->tampil($_GET['id'])->fetch_object()->gbr_brg;
	unlink("assets/img/barang/".$gbr_awal);

	$brg->hapus($_GET['id']);
	header("location: ?page=barang");	
}