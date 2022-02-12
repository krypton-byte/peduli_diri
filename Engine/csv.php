<?php

class Catatan {
    private $filename = __DIR__.'/catatan.csv';
    public function Masuk(){}
    public function buat_catatan($tanggal, $jam, $lokasi, $suhu){
        $this->Masuk();
        $file = fopen($this->filename, 'a');
        fputcsv($file, [$this->nik, $tanggal, $jam, $lokasi, $suhu]);
        return [
            'tanggal' => $tanggal,
            'jam' => $jam,
            'lokasi' => $lokasi,
            'suhu' => $suhu
        ];
    }
    
    public function lihat_catatan() {
        $rows = [];
        if (($handle = fopen($this->filename, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $num = count($data);
                if($num !== 5){
                    continue;
                }
                if($this->nik === $data[0]){
                    $data = [
                        'nik' => $data[0],
                        'tanggal' => $data[1],
                        'jam' => $data[2],
                        'lokasi' => $data[3],
                        'suhu' => $data[4],
                    ];
                    array_push($rows, array_slice($data, 1));
                }
            }
            fclose($handle);
            return $rows;
        }
        throw new Exception('File CSV Tidak Ditemukan');
    }
    public function catatan() {
        return count(file($this->filename));
    }
}

class User extends Catatan { //NIK|Nama
    private $filename = __DIR__.'/user.csv';
    public $nik;
    public $nama;
    public function __construct($NIK, $Nama) 
    {
        $this->nik = $NIK;
        $this->nama = $Nama;
    }

    public function Masuk()
    {
        if (($handle = fopen($this->filename, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $num = count($data);
                if($num !== 2){
                    continue;
                }
                if($this->nama === $data[1] && $this->nik === $data[0]){
                    return [
                        'nik' => $data[0],
                        'nama' => $data[1]
                    ];
                }
            }
            fclose($handle);
        throw new Exception('NIK Atau Nama Lengkap Salah');
        }
        throw new Exception('File CSV Tidak Ditemukan');
    }
    public function user()
    {
        return count(file($this->filename));
        
    }
    public function Daftar()
    {
        if(!(is_numeric($this->nik) && strlen($this->nik) === 16)) throw new Exception('NIK Tidak Valid');
        if (($handle = fopen($this->filename, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $num = count($data);
                if($num !== 2){
                    continue;
                }
                if($this->nik === $data[0]){
                    throw new Exception('NIK telah terdaftar');
                }
            }
            $fcsv = fopen($this->filename, 'a');
            fputcsv($fcsv, [$this->nik, $this->nama]);
            fclose($fcsv);
            fclose($handle);
            return ['nik' => $this->nik, 'nama' => $this->nama];
        }
        throw new Exception('File CSV Tidak Ditemukan');
    }
}
?>
