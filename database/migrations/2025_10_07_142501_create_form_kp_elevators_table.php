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
            $table->text('nama_perusahaan')->nullable();
            $table->text('jenis_elevator')->nullable();
            $table->text('pabrik_pembuat')->nullable();
            $table->text('negara_tahun_pembuat')->nullable();
            $table->text('nomor_seri')->nullable();
            $table->text('kapasitas')->nullable();
            $table->text('jumlah_lantai_pemberhentian')->nullable();
            $table->text('kecepatan_elevator')->nullable();
            $table->text('lokasi_elevator')->nullable();

            // === Upload Foto ===
            $table->json('foto_mesin')->nullable();
            $table->json('foto_tali_penggantung')->nullable();
            $table->json('foto_teromol')->nullable();
            $table->json('foto_bangun_ruang_luncur')->nullable();
            $table->json('foto_komponen_kereta')->nullable();
            $table->json('foto_governor_rem')->nullable();

            // === A. Mesin ===
            $table->text('dudukan_mesin')->nullable();
            $table->text('rem_mekanik')->nullable();
            $table->text('rem_electric')->nullable();
            $table->text('konstruksi_kamar')->nullable();
            $table->text('ruang_bebas_kamar')->nullable();
            $table->text('penerangan_kamar_mesin')->nullable();
            $table->text('ventilasi_pendingin')->nullable();
            $table->text('pintu_kamar_mesin')->nullable();
            $table->text('posisi_panel')->nullable();
            $table->text('alat_pelindung')->nullable();
            $table->text('pelindung_lubang_talibaja')->nullable();
            $table->text('tangga_kamar_mesin')->nullable();
            $table->text('perbedaan_ketinggian')->nullable();
            $table->text('alat_pemadam_ringan')->nullable();
            $table->text('elevator_tanpa_kamar')->nullable();

            // === B. Tali / Sabuk Penggantung ===
            $table->text('tali_sabuk1')->nullable();
            $table->text('tali_sabuk2')->nullable();
            $table->text('nilai_faktor_keamanan')->nullable();
            $table->text('tali_penggantung_bobot_imbang')->nullable();
            $table->text('tali_penggantung_tanpa_bobot')->nullable();
            $table->text('sabuk')->nullable();
            $table->text('pengaman_tanpa_bobot')->nullable();

            // === C. Teromol ===
            $table->text('alur_teromol')->nullable();
            $table->text('diameter_teromol_penumpang')->nullable();
            $table->text('diameter_teromol_governor')->nullable();

            // === D. Bangunan Ruang Luncur ===
            $table->text('konstruksi_ruangLuncur')->nullable();
            $table->text('dinding_ruangLuncur')->nullable();
            $table->text('landasan_jalur')->nullable();
            $table->text('penerangan_ruangLuncur')->nullable();
            $table->text('pintu_darurat')->nullable();
            $table->text('ukuran_pintu_darurat')->nullable();
            $table->text('saklar_pengaman_pintu')->nullable();
            $table->text('jembatan_bantu')->nullable();
            $table->text('ruangBebas_atasSangkar')->nullable();
            $table->text('ruangBebas_lekukDasar')->nullable();
            $table->text('tangga_lekukDasar')->nullable();
            $table->text('syarat_lekukDasar')->nullable();
            $table->text('akses_lekukDasar')->nullable();
            $table->text('lekukDasar_antar2_elevator')->nullable();
            $table->text('daun_pintu_ruang_luncur')->nullable();
            $table->text('interlock_ruang_luncur')->nullable();
            $table->text('kerataan_lantai')->nullable();
            $table->text('sekat_ruang_luncur_2sangkar')->nullable();
            $table->text('elevator_miring')->nullable();

            // === E. Kereta ===
            $table->text('kerangka')->nullable();
            $table->text('badan_kereta')->nullable();
            $table->text('tinggi_dinding')->nullable();
            $table->text('luas_lantai')->nullable();
            $table->text('perluasan_luas_kereta')->nullable();
            $table->text('pintu_kereta')->nullable();
            $table->text('ukuran')->nullable();
            $table->text('kunci_kait')->nullable();
            $table->text('celah_antar_pintu')->nullable();
            $table->text('sisi_luar_kereta')->nullable();
            $table->text('alarm_bell')->nullable();
            $table->text('sumber_tenaga_cadangan')->nullable();
            $table->text('intercom')->nullable();
            $table->text('ventilasi')->nullable(); // (sudah ada? kalau belum, pakai ini)
            $table->text('penerangan_darurat')->nullable();
            $table->text('panel_operasi')->nullable();
            $table->text('penunjuk_posisi_sangkar')->nullable();

            $table->text('nama_pembuat')->nullable();
            $table->text('kapasitas_beban')->nullable();
            $table->text('rambu_dilarang_merokok')->nullable();
            $table->text('indikasi_beban_lebih')->nullable();
            $table->text('tombol_buka_tutup')->nullable();
            $table->text('tombol_lantai_pemberhentian')->nullable();
            $table->text('tombol_bell_alarm')->nullable();
            $table->text('intercom_dua_arah')->nullable();

            $table->text('kekuatan_atap_kereta')->nullable();
            $table->text('syarat_pintu_darurat')->nullable();
            $table->text('syarat_pintu_darurat_samping')->nullable();
            $table->text('pagar_pengaman')->nullable();
            $table->text('ukuran_pagar')->nullable();
            $table->text('ukuran_pagar_pengaman')->nullable();
            $table->text('penerangan_atap')->nullable();
            $table->text('tombol_operasi_manual')->nullable();
            $table->text('syarat_interior_kereta')->nullable();

            //F. Governor
            $table->text('penjepit_tali')->nullable();
            $table->text('saklar_governor')->nullable();
            $table->text('fungsi_kecepatan_rem')->nullable();
            $table->text('rem_pengaman')->nullable();
            $table->text('bentuk_rem_pengaman')->nullable();
            $table->text('rem_pengaman_berangsur')->nullable();
            $table->text('rem_pengaman_mendadak')->nullable();
            $table->text('syarat_rem_pengaman')->nullable();
            $table->text('kecepatan_kereta')->nullable();
            $table->text('saklar_Pengaman')->nullable();
            $table->text('alat_pembatas')->nullable();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_kp_elevator');
    }
};
