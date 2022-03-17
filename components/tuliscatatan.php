<div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Tulis Catatan</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Pilih Tanggal</label>
                <div class="col-sm-8">
                <input type="date" class="form-control" name="tanggal" value="<?php echo isset($_GET['tanggal'])?htmlspecialchars($_GET['tanggal']):''?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Pilih Jam</label>
                <div class="col-sm-8">
                <input type="time" class="form-control" name="jam" value="<?php echo isset($_GET['jam'])?htmlspecialchars($_GET['jam']):''?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Lokasi Yang Dikunjungi</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi" value="<?php echo isset($_GET['lokasi'])?htmlspecialchars($_GET['lokasi']):''?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Suhu Tubuh</label>
                <div class="col-sm-8">
                <input type="number" class="form-control" name="suhu" placeholder="Masukkan Suhu Tubuh (Celcius)" value="<?php echo isset($_GET['suhu'])?htmlspecialchars($_GET['suhu']):''?>" required>
                </div>
            </div>
            </div>
            <div class="card-footer">
            <button id="submit" class="btn btn-primary float-right m-2"><i class="fa fa-save"></i> <?php echo isset($_GET['index']) && is_numeric($_GET['index'])?'Perbarui':'Simpan'?></button>
            <button type="reset" id="reset" class="btn btn-danger float-right m-2"><i class="fa fa-trash"></i> Kosongkan</button>
            </div>
        </div>
        </div>
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
                    });
                    <?php
                        if(isset($_GET['index']) && is_numeric($_GET['index'])){
                            echo 'form.append("index", '.$_GET['index'].');';
                        }
                    ?>
                    fetch('api/buat_catatan.php', {
                        method: 'POST',
                        body: form
                    }).then(async (resp)=>{
                        const rjson = await resp.json();
                        Swal.fire({
                            position: 'top-end',
                            icon: rjson.status?'success':'error',
                            title: `Catatan ${rjson.status?'Berhasil': 'Gagal'} Di <?php echo isset($_GET['index']) && is_numeric($_GET['index'])?'Perbarui':'Tambahkan'?>`,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        rjson.status && document.getElementById('reset').click();
                    });
                }
            })()
</script>