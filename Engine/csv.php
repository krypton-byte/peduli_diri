<?php

class Catatan {
    private string $filename = __DIR__.'/catatan.csv';
    public function Masuk(){}
    public function buat_catatan(string $tanggal, string $jam, string $lokasi, int $suhu): array{
        $this->Masuk();
        $file = fopen($this->filename, 'a');
        fputcsv($file, [$this->nis, $tanggal, $jam, $lokasi, $suhu]);
        return [
            'tanggal' => $tanggal,
            'jam' => $jam,
            'lokasi' => $lokasi,
            'suhu' => $suhu
        ];
    }
    
    public function lihat_catatan(?int $OFFSET = null, ?int $LIMIT = null): array {
        $rows = [];
        if (($handle = fopen($this->filename, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $num = count($data);
                if($num !== 5){
                    continue;
                }
                if($this->nis === $data[0]){
                    $data = [
                        'nis' => $data[0],
                        'tanggal' => $data[1],
                        'jam' => $data[2],
                        'lokasi' => $data[3],
                        'suhu' => $data[4],
                    ];
                    array_push($rows, array_slice($data, 1));
                }
            }
            fclose($handle);
            return array_slice($rows, $OFFSET, $LIMIT);
        }
        throw new Exception('File CSV Tidak Ditemukan');
    }

    public function Hapus(int $index): bool {
        $status = false;
        if(($handle = fopen($this->filename, 'r')) !== FALSE){
            $n = 0;
            $narray = array();
            while($data = fgetcsv($handle)){
                if($data[0] === $this->nis && $n === $index){
                    $status = true;
                    $n++;
                }elseif($this->nis === $data[0]){
                    array_push($narray, $data);
                    $n++;
                }else{
                    array_push($narray, $data);
                }
            }
            $flush = fopen($this->filename, 'w');
            fwrite($flush, '');
            fclose($flush);
            $file = fopen($this->filename, 'a');
            foreach($narray as $val){
                fputcsv($file, $val);
            }
            fclose($file);
        }
        return $status;
    }

    public function Edit(int $index, string $tanggal, string $jam, string $lokasi, int $suhu): bool {
        $status = false;
        if(($handle = fopen($this->filename, 'r')) !== FALSE){
            $n = 0;
            $narray = array();
            while($data = fgetcsv($handle)){
                if($data[0] === $this->nis && $n === $index){
                    array_push($narray,[$this->nis, $tanggal, $jam, $lokasi, $suhu]);
                    $n++;
                    $status = true;
                }elseif($this->nis === $data[0]){
                    array_push($narray, $data);
                    $n++;
                }else{
                    array_push($narray, $data);
                }
            }
            $flush = fopen($this->filename, 'w');
            fwrite($flush, '');
            $file = fopen($this->filename, 'a');
            foreach($narray as $val){
                fputcsv($file, $val);
            }
        }
        return $status;
    }

    public function catatan(): int {
        return count(file($this->filename));
    }
}

class User extends Catatan { //NIK|Nama
    private string $filename = __DIR__.'/user.csv';
    public string $nis;
    public string $nama;
    public function __construct(string $NIS, string $Nama) 
    {
      $this->nis = $NIS;
        $this->nama = $Nama;
    }

    public function Masuk(): array
    {
        if (($handle = fopen($this->filename, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $num = count($data);
                if($num !== 2){
                    continue;
                }
                if($this->nama === $data[1] && $this->nis === $data[0]){
                    return [
                        'nis' => $data[0],
                        'nama' => $data[1]
                    ];
                }
            }
            fclose($handle);
        throw new Exception('NIS Atau Nama Lengkap Salah');
        }
        throw new Exception('File CSV Tidak Ditemukan');
    }
    public function user(): int
    {
        return count(file($this->filename));
        
    }
    public function Daftar(): array
    {
        if(!(is_numeric($this->nis) && strlen($this->nis) === 10)) throw new Exception('NIS Tidak Valid');
        if (($handle = fopen($this->filename, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $num = count($data);
                if($num !== 2){
                    continue;
                }
                if($this->nis === $data[0]){
                    throw new Exception('NIS telah terdaftar');
                }
            }
            $fcsv = fopen($this->filename, 'a');
            fputcsv($fcsv, [$this->nis, $this->nama]);
            fclose($fcsv);
            fclose($handle);
            return ['nis' => $this->nis, 'nama' => $this->nama];
        }
        throw new Exception('File CSV Tidak Ditemukan');
    }
}
?>
