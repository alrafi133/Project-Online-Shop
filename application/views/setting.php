<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="cart-title">Setting Website</h3>
    </div>
    <div class="card-body">
      <?php
      if ($this->session->flashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i></h5>';
        echo $this->session->flashdata('pesan');
        echo '</div>';
      }
       echo form_open('admin/setting'); ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Provinsi</label>
            <select class="form-control" name="provinsi"></select>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
          <label>Kota</label>
          <select class="form-control" name="kota">
            <option value="<?= $setting->lokasi ?>"><?= $setting->lokasi ?></option>
          </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="nama_toko">Nama Toko</label>
            <input type="text" name="nama_toko"  class="form-control" required value="<?= $setting->nama_toko ?>">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="no_telp">Nomor Telepon</label>
            <input type="text" name="no_telp"  class="form-control" required value="<?= $setting->no_telp ?>">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="alamat_toko">Alamat Toko</label>
        <input type="text" name="alamat_toko"  class="form-control" required value="<?= $setting->alamat_toko ?>">
      </div>

      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-sm btn-primary">Simpan Data</button>
        <a href="<?= base_url('admin') ?>" class="btn btn-sm btn-warning">Kembali</a>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    //Data Provinsi
    $.ajax({
      type: "POST",
      url: "<?= base_url('rajaongkir/provinsi') ?>",
      success : function(hasil_provinsi) {
          // console.log(hasil_provinsi);
          $("select[name = provinsi]").html(hasil_provinsi);
      }
    });
    //Data Kota/Kabupaten
    $("select[name = provinsi]").on("change", function() {
      var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
      $.ajax({
        type: "POST",
        url: "<?= base_url('rajaongkir/kota') ?>",
        data: 'id_provinsi='+ id_provinsi_terpilih,
        success: function(hasil_kota) {
        $("select[name = kota]").html(hasil_kota);
        }
      });
    });
  });
</script>
