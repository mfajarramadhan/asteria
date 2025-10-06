<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpEskalator extends Model
{
    use HasFactory;

    protected $table = 'form_kp_eskalator';

    protected $fillable = [
        'job_order_tool_id',
        'tanggal_pemeriksaan',
        'nama_perusahaan',
        'jenis_eskalator',
        'merk_eskalator',
        'nomor_seri',
        'kapasitas',
        'melayani',
        'lokasi_eskalator',
        'pagar_pelindung',
        'ban_pegangan_foto',
        'peralatan_pengaman_foto',
        'tinggi',
        'tinggi_keterangan',
        'tekanan_samping',
        'tekanan_samping_keterangan',
        'tekanan_vertikal',
        'tekanan_vertikal_keterangan',
        'pelindung_bawah',
        'pelindung_bawah_keterangan',
        'kelenturan_pelindung_bawah',
        'kelenturan_pelindung_bawah_keterangan',
        'celah_anak_tangga',
        'celah_anak_tangga_keterangan',
        'kondisi_ban_pegangan',
        'kondisi_ban_pegangan_keterangan',
        'kecepatan_ban_pegangan',
        'kecepatan_ban_pegangan_keterangan',
        'lebar_ban_pegangan',
        'lebar_ban_pegangan_keterangan',
        'kunci_pengendali',
        'kunci_pengendali_keterangan',
        'saklar_henti',
        'saklar_henti_keterangan',
        'pengaman_rantai',
        'pengaman_rantai_keterangan',
        'rantai_penarik',
        'rantai_penarik_keterangan',
        'pengaman_anak_tangga',
        'pengaman_anak_tangga_keterangan',
        'pengaman_ban_pegangan',
        'pengaman_ban_pegangan_keterangan',
        'pengaman_pencegah_balik_arah',
        'pengaman_pencegah_balik_arah_keterangan',
        'pengaman_area_masuk_ban',
        'pengaman_area_masuk_ban_keterangan',
        'pengaman_pelat_sisir',
        'pengaman_pelat_sisir_keterangan',
        'sikat_pelindung_dalam',
        'sikat_pelindung_dalam_keterangan',
        'tombol_penghenti',
        'tombol_penghenti_keterangan',
    ];

    // Konversi otomatis JSON <-> array
    protected $casts = [
        'pagar_pelindung' => 'array',
        'ban_pegangan_foto' => 'array',
        'peralatan_pengaman_foto' => 'array',
    ];
}
