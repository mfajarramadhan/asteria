<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpInstalasiListrik extends Model
{
    use HasFactory;

    protected $table = 'form_kp_instalasi_listrik';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'foto_informasi_umum' => 'array',
        'konstruksi_foto' => 'array',
        'baut_pengikat_foto' => 'array',
        'baut_pengikat_foto2' => 'array',
        'kabel_foto' => 'array',
        'plat_tembaga_foto' => 'array',
        'pembatas_foto' => 'array',
        'tanda_peringatan_foto' => 'array',
        'apar_foto' => 'array',
        'oil_gauge_foto' => 'array',
        'thermal_gauge_foto' => 'array',
        'lampu_indikator_foto' => 'array',
        'alat_ukur_foto' => 'array',
        'tanda_pintu_panel_foto' => 'array',
        'kunci_pintu_panel_foto' => 'array',
        'cover_pelindung_foto' => 'array',
        'gambar_single_line_foto' => 'array',
        'kabel_bonding_foto' => 'array',
        'label_foto' => 'array',
        'kode_warna_kabel_foto' => 'array',
        'kebersihan_panel_foto' => 'array',
        'kerapian_instalasi_foto' => 'array',
        'jarak_depan_foto' => 'array',
        'jarak_samping_foto' => 'array',
        'jarak_belakang_foto' => 'array',
        'bebas_buka_panel_foto' => 'array',
        'pencahayaan_foto' => 'array',
        'barang_tidak_pakai_foto' => 'array',
        'ventilasi_foto' => 'array',
        'saluran_uap_foto' => 'array',
        'dimensi_foto' => 'array',
        'pembumian_foto' => 'array',
        'pencahayaan_foto2' => 'array',
        'thermography_foto' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
