 <!-- Pop up Tambah Barang -->
 <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/prosesBarang.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_inventaris" value="">
                <label>Foto Barang</label>
                <br>
                <input type="file" name="foto" onchange="PreviewImage();">
                <br>
                <br>
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang">
                <label>Merk</label>
                <select name="merk" id="merk" class="selectpicker form-control" data-live-search="true" style="width:50%;">
                <option value="">pilih</option>
                <?php
                  foreach($merk->tampilMerk() as $data) {
                ?>
                <option value="<?php echo $data['kode_merk']?>"><?php echo $data['merk']?></option>
                <?php
                  }
                ?>
                </select>
                <label>Kategori</label>
                <select name="kategori" id="kategori" class="selectpicker form-control" data-live-search="true">
                <option value="">pilih</option>
                <?php
                  foreach($kategori->tampilKategori() as $data) {
                ?>
                <option value="<?php echo $data['kode_kategori']?>"><?php echo $data['kategori']?></option>
                <?php
                  }
                ?>
                </select>
                <label>Harga</label>
                <input type="number" name="harga" id="harga" value="">
                <label>Stok</label>
                <input type="number" name="stok" id="stok" value="">
                <label>Deskripsi</label>
                <textarea name="deskripsi" id="deskrisi"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            </div>
        </div>
        </div>
</div>