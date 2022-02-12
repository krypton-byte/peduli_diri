<div class="card card-primary">
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
                <td>".$count++."</td>
                <td>".htmlspecialchars($catatan["tanggal"])."</td>
                <td>".htmlspecialchars($catatan["jam"])."</td>
                <td>".htmlspecialchars($catatan["lokasi"])."</td>
                <td>".htmlspecialchars($catatan["suhu"])." Celcius</td>
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
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": true, "pageLength": 5
      })
    })();
</script>