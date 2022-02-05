<?php
    session_start();
    if($_SESSION['nik'] && $_SESSION['nama']){
        require 'Engine/csv.php';
        try{
            $user = new User($_SESSION['nik'], $_SESSION['nama']);
            $user->Masuk();
        }catch(Exception $e){
            header('location: logout.php');
            exit();
        }
    }else{
        header('location: index.php');
        exit();
    }
    include 'components/header.php';
        if($_GET['page'] === 'tulis_catatan'){
            ?>

            <section class="content">
            <div class="card card-info">
        <div class="card-header">
        <h3 class="card-title">Tulis Catatan</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Pilih Tanggal</label>
                <div class="col-sm-8">
                <input type="date" class="form-control" name="tanggal" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Pilih Jam</label>
                <div class="col-sm-8">
                <input type="time" class="form-control" name="jam" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Lokasi Yang Dikunjungi</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Suhu Tubuh</label>
                <div class="col-sm-8">
                <input type="number" class="form-control" name="suhu" placeholder="Masukkan Suhu Tubuh (Celcius)" required="">
                </div>
            </div>
            </div>
            <div class="card-footer">
            <button id="submit" class="btn btn-info float-right m-2"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" id="reset" class="btn btn-warning float-right m-2"><i class="fa fa-trash"></i> Kosongkan</button>
            </div>
        </div>
        </div>

            </section>
        <script>
            (function(){
                document.getElementById('reset').onclick = function (){
                    Array.from(document.getElementsByTagName('input')).forEach(x => {
                        x.value = '';
                    })
                }
                document.getElementById('submit').onclick = function (){
                    const form = new FormData();
                    Array.from(document.getElementsByTagName('input')).forEach(x => {
                        form.append(x.name, x.value);
                    })
                    fetch('api/buat_catatan.php', {
                        method: 'POST',
                        body: form
                    }).then(async (resp)=>{
                        const rjson = await resp.json();
                        Swal.fire({
                            position: 'top-end',
                            icon: rjson.status?'success':'error',
                            title: `Catatan ${rjson.status?'Berhasil': 'Gagal'} Di Tambahkan`,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        rjson.status && document.getElementById('reset').click();
                    });
                }
            })()
        </script>
        <?php
    } else if($_GET['page'] === 'riwayat_perjalanan'){

        ?>

      <section class="content">
        <div class="card card-info">
            <!-- /.card-header -->
            <div class="card-header">
                <h3 class="card-title">Riwayat Perjalanan</h3>
            </div>
            <div class="card-body" style="overflow-y: scroll;overflow-x: auto;">
                <table id="table-data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Lokasi Berkunjung</th>
                    <th>Suhu Tubuh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach($user->lihat_catatan() as $catatan){
                        echo "
                        <tr>
                        <td>".$count."</td>
                        <td>".htmlspecialchars($catatan["tanggal"])."</td>
                        <td>".htmlspecialchars($catatan["jam"])."</td>
                        <td>".htmlspecialchars($catatan["lokasi"])."</td>
                        <td>".htmlspecialchars($catatan["suhu"])." Celcius</td>
                        </tr>
                        ";
                        $count++;
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
      </section>
      <script>
    (function(){
        $("#table-data").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": true, "pageLength": 5
      })
    })();
</script>

        <?php
        }else{

?>


      <section class="content">
         <div class="callout callout-info">
            <h5>Aplikasi Peduli Diri</h5>
            <p>
              Dibuat oleh : <strong><a style="color: gray;" href="https://github.com/krypton-byte" target="_blank" rel="noopener noreferrer">Puja</a></strong> <br>
              Untuk Memenuhi Uji Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL) Tahun Pelajaran 2021/2022
            </p>
          </div>

                    
          <div class="row">
            <div class="col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $user->catatan()?></h3>
                  <p>Total Catatan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-alt"></i>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $user->user()?></h3>
                  <p>Total Pengguna</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
              </div>
            </div>
          </div>
      </section>
<?php
}
include 'components/footer.php';
?>