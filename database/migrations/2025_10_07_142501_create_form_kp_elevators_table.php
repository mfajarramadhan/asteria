<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_kp_elevator', function (Blueprint $table) {
            $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')
                ->constrained('job_order_tools')
                ->onDelete('cascade');

            // Informasi Pemeriksaan
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('jenis_elevator')->nullable();
            $table->string('pabrik_pembuat')->nullable();
            $table->string('negara_tahun_pembuat')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->string('kapasitas')->nullable();
            $table->string('jumlah_lantai_pemberhentian')->nullable();
            $table->string('kecepatan_elevator')->nullable();
            $table->string('lokasi_elevator')->nullable();

            // === Upload Foto ===
            $table->json('foto_mesin')->nullable();
            $table->json('foto_tali_penggantung')->nullable();
            $table->json('foto_teromol')->nullable();
            $table->json('foto_bangun_ruang_luncur')->nullable();
            $table->json('foto_komponen_kereta')->nullable();
            $table->json('foto_governor_rem')->nullable();

            // === A. Mesin ===
            $table->string('dudukan_mesin')->nullable();
            $table->string('rem_mekanik')->nullable();
            $table->string('rem_electric')->nullable();
            $table->string('konstruksi_kamar')->nullable();
            $table->string('ruang_bebas_kamar')->nullable();
            $table->string('penerangan_kamar_mesin')->nullable();
            $table->string('ventilasi_pendingin')->nullable();
            $table->string('pintu_kamar_mesin')->nullable();
            $table->string('posisi_panel')->nullable();
            $table->string('alat_pelindung')->nullable();
            $table->string('pelindung_lubang_talibaja')->nullable();
            $table->string('tangga_kamar_mesin')->nullable();
            $table->string('perbedaan_ketinggian')->nullable();
            $table->string('alat_pemadam_ringan')->nullable();
            $table->string('elevator_tanpa_kamar')->nullable();

            // === B. Tali / Sabuk Penggantung ===
            $table->string('tali_sabuk1')->nullable();
            $table->string('tali_sabuk2')->nullable();
            $table->string('nilai_faktor_keamanan')->nullable();
            $table->string('tali_penggantung_bobot_imbang')->nullable();
            $table->string('tali_penggantung_tanpa_bobot')->nullable();
            $table->string('sabuk')->nullable();
            $table->string('pengaman_tanpa_bobot')->nullable();

            // === C. Teromol ===
            $table->string('alur_teromol')->nullable();
            $table->string('diameter_teromol_penumpang')->nullable();
            $table->string('diameter_teromol_governor')->nullable();

            // === D. Bangunan Ruang Luncur ===
            $table->string('konstruksi_ruangLuncur')->nullable();
            $table->string('dinding_ruangLuncur')->nullable();
            $table->string('landasan_jalur')->nullable();
            $table->string('penerangan_ruangLuncur')->nullable();
            $table->string('pintu_darurat')->nullable();
            $table->string('ukuran_pintu_darurat')->nullable();
            $table->string('saklar_pengaman_pintu')->nullable();
            $table->string('jembatan_bantu')->nullable();
            $table->string('ruangBebas_atasSangkar')->nullable();
            $table->string('ruangBebas_lekukDasar')->nullable();
            $table->string('tangga_lekukDasar')->nullable();
            $table->string('syarat_lekukDasar')->nullable();
            $table->string('akses_lekukDasar')->nullable();
            $table->string('lekukDasar_antar2_elevator')->nullable();
            $table->string('daun_pintu_ruang_luncur')->nullable();
            $table->string('interlock_ruang_luncur')->nullable();
            $table->string('kerataan_lantai')->nullable();
            $table->string('sekat_ruang_luncur_2sangkar')->nullable();
            $table->string('elevator_miring')->nullable();

            // === E. Kereta ===
            $table->string('kerangka')->nullable();
            $table->string('badan_kereta')->nullable();
            $table->string('tinggi_dinding')->nullable();
            $table->string('luas_lantai')->nullable();
            $table->string('perluasan_luas_kereta')->nullable();
            $table->string('pintu_kereta')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('kunci_kait')->nullable();
            $table->string('celah_antar_pintu')->nullable();
            $table->string('sisi_luar_kereta')->nullable();
            $table->string('alarm_bell')->nullable();
            $table->string('sumber_tenaga_cadangan')->nullable();
            $table->string('intercom')->nullable();
            $table->string('ventilasi')->nullable(); // (sudah ada? kalau belum, pakai ini)
            $table->string('penerangan_darurat')->nullable();
            $table->string('panel_operasi')->nullable();
            $table->string('penunjuk_posisi_sangkar')->nullable();

            $table->string('nama_pembuat')->nullable();
            $table->string('kapasitas_beban')->nullable();
            $table->string('rambu_dilarang_merokok')->nullable();
            $table->string('indikasi_beban_lebih')->nullable();
            $table->string('tombol_buka_tutup')->nullable();
            $table->string('tombol_lantai_pemberhentian')->nullable();
            $table->string('tombol_bell_alarm')->nullable();
            $table->string('intercom_dua_arah')->nullable();

            $table->string('kekuatan_atap_kereta')->nullable();
            $table->string('syarat_pintu_darurat')->nullable();
            $table->string('syarat_pintu_darurat_samping')->nullable();
            $table->string('pagar_pengaman')->nullable();
            $table->string('ukuran_pagar')->nullable();
            $table->string('ukuran_pagar_pengaman')->nullable();
            $table->string('penerangan_atap')->nullable();
            $table->string('tombol_operasi_manual')->nullable();
            $table->string('syarat_interior_kereta')->nullable();

            //F. Governor
            $table->string('penjepit_tali')->nullable();
            $table->string('saklar_governor')->nullable();
            $table->string('fungsi_kecepatan_rem')->nullable();
            $table->string('rem_pengaman')->nullable();
            $table->string('bentuk_rem_pengaman')->nullable();
            $table->string('rem_pengaman_berangsur')->nullable();
            $table->string('rem_pengaman_mendadak')->nullable();
            $table->string('syarat_rem_pengaman')->nullable();
            $table->string('kecepatan_kereta')->nullable();
            $table->string('saklar_Pengaman')->nullable();
            $table->string('alat_pembatas')->nullable();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_kp_elevator');
    }
};
