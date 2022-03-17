<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<div class="card card-primary">
    <!-- /.card-header -->
    <div class="card-header">
        <h3 class="card-title">Riwayat Perjalanan</h3>
    </div>
    <div class="card-body" style="overflow-y: scroll;overflow-x: auto;">
        <table id="table-data" class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Lokasi Berkunjung</th>
                <th>Suhu Tubuh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            foreach($user->lihat_catatan() as $catatan){
                echo "
                <tr>
                    <td>".++$count."</td>
                    <td>".htmlspecialchars($catatan["tanggal"])."</td>
                    <td>".htmlspecialchars($catatan["jam"])."</td>
                    <td>".htmlspecialchars($catatan["lokasi"])."</td>
                    <td>".htmlspecialchars($catatan["suhu"])." Celcius</td>
                    <td class='text-center'><button class='btn btn-danger mx-1' onclick='hapus(".($count-1).");'><i class='fas fa-trash'></i></button><a class='btn btn-primary' href='user.php?page=tulis_catatan&index=".($count-1)."&tanggal=".htmlspecialchars($catatan['tanggal'])."&jam=".htmlspecialchars($catatan['jam'])."&lokasi=".htmlspecialchars($catatan['lokasi'])."&suhu=".htmlspecialchars($catatan['suhu'])."'><i class='fas fa-pencil-alt'></i></a></td>
                </tr>
                ";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<style>
    th {
      background-color: #0275d8;
      color: white;
    }
  </style>
  <script>
    (function(){
        $("#table-data").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "pagging": true, "pageLength": 5
      })
    })();
    function hapus(index){
        const form = new FormData();
        form.append('index', index);
        fetch('hapus.php', {
            method: 'POST',
            body: form
        }).then( async (resp)=>{
            const status = (await resp.json()).status;
            Swal.fire({
                position: 'top-end',
                icon:status?'success':'error',
                title: `Catatan ${status?'Berhasil':'Gagal'} Dihapus`,
                timer:1500
            });
            status && window.location.reload();
        })
    }
</script>