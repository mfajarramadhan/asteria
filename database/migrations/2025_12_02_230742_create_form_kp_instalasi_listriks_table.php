<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_kp_instalasi_listrik', function (Blueprint $table) {
            $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');

            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();

            $table->decimal('daya_terpasang', 15, 4)->nullable();
            $table->string('untuk_tenaga', 100)->nullable();
            $table->string('untuk_instalaltir', 100)->nullable();
            $table->decimal('ampere_mcb', 15, 4)->nullable();
            $table->string('sumber_daya_listrik', 100)->nullable();
            $table->string('tahun_pemasangan', 50)->nullable();

            // konstruksi
            $table->string('konstruksi_hasil', 255)->nullable();
            $table->string('konstruksi_keterangan', 100)->nullable();
            $table->json('konstruksi_foto')->nullable();

            // baut pengikat
            $table->string('baut_pengikat_hasil', 255)->nullable();
            $table->string('baut_pengikat_keterangan', 100)->nullable();
            $table->json('baut_pengikat_foto')->nullable();

            // kabel
            $table->string('kabel_hasil', 255)->nullable();
            $table->string('kabel_keterangan', 100)->nullable();
            $table->json('kabel_foto')->nullable();

            // plat tembaga
            $table->string('plat_tembaga_hasil', 255)->nullable();
            $table->string('plat_tembaga_keterangan', 100)->nullable();
            $table->json('plat_tembaga_foto')->nullable();

            // baut pengikat (ulang, sesuai foto)
            $table->string('baut_pengikat_hasil2', 255)->nullable();
            $table->string('baut_pengikat_keterangan2', 100)->nullable();
            $table->json('baut_pengikat_foto2')->nullable();

            // pembatas
            $table->string('pembatas_hasil', 255)->nullable();
            $table->string('pembatas_keterangan', 100)->nullable();
            $table->json('pembatas_foto')->nullable();

            // tanda peringatan
            $table->string('tanda_peringatan_hasil', 255)->nullable();
            $table->string('tanda_peringatan_keterangan', 100)->nullable();
            $table->json('tanda_peringatan_foto')->nullable();

            // apar
            $table->string('apar_hasil', 255)->nullable();
            $table->string('apar_keterangan', 100)->nullable();
            $table->json('apar_foto')->nullable();

            // oil gauge
            $table->string('oil_gauge_hasil', 255)->nullable();
            $table->string('oil_gauge_keterangan', 100)->nullable();
            $table->json('oil_gauge_foto')->nullable();

            // thermal gauge
            $table->string('thermal_gauge_hasil', 255)->nullable();
            $table->string('thermal_gauge_keterangan', 100)->nullable();
            $table->json('thermal_gauge_foto')->nullable();

            // lampu indikator
            $table->string('lampu_indikator_hasil', 255)->nullable();
            $table->string('lampu_indikator_keterangan', 100)->nullable();
            $table->json('lampu_indikator_foto')->nullable();

            // alat ukur
            $table->string('alat_ukur_hasil', 255)->nullable();
            $table->string('alat_ukur_keterangan', 100)->nullable();
            $table->json('alat_ukur_foto')->nullable();

            // tanda pintu panel
            $table->string('tanda_pintu_panel_hasil', 255)->nullable();
            $table->string('tanda_pintu_panel_keterangan', 100)->nullable();
            $table->json('tanda_pintu_panel_foto')->nullable();

            // kunci pintu panel
            $table->string('kunci_pintu_panel_hasil', 255)->nullable();
            $table->string('kunci_pintu_panel_keterangan', 100)->nullable();
            $table->json('kunci_pintu_panel_foto')->nullable();

            // cover pelindung
            $table->string('cover_pelindung_hasil', 255)->nullable();
            $table->string('cover_pelindung_keterangan', 100)->nullable();
            $table->json('cover_pelindung_foto')->nullable();

            // gambar single line
            $table->string('gambar_single_line_hasil', 255)->nullable();
            $table->string('gambar_single_line_keterangan', 100)->nullable();
            $table->json('gambar_single_line_foto')->nullable();

            // kabel bonding
            $table->string('kabel_bonding_hasil', 255)->nullable();
            $table->string('kabel_bonding_keterangan', 100)->nullable();
            $table->json('kabel_bonding_foto')->nullable();

            // label
            $table->string('label_hasil', 255)->nullable();
            $table->string('label_keterangan', 100)->nullable();
            $table->json('label_foto')->nullable();

            // kode warna kabel
            $table->string('kode_warna_kabel_hasil', 255)->nullable();
            $table->string('kode_warna_kabel_keterangan', 100)->nullable();
            $table->json('kode_warna_kabel_foto')->nullable();

            // kebersihan panel
            $table->string('kebersihan_panel_hasil', 255)->nullable();
            $table->string('kebersihan_panel_keterangan', 100)->nullable();
            $table->json('kebersihan_panel_foto')->nullable();

            // kerapian instalasi
            $table->string('kerapian_instalasi_hasil', 255)->nullable();
            $table->string('kerapian_instalasi_keterangan', 100)->nullable();
            $table->json('kerapian_instalasi_foto')->nullable();

            // jarak depan
            $table->string('jarak_depan_hasil', 255)->nullable();
            $table->string('jarak_depan_keterangan', 100)->nullable();
            $table->json('jarak_depan_foto')->nullable();

            // jarak samping
            $table->string('jarak_samping_hasil', 255)->nullable();
            $table->string('jarak_samping_keterangan', 100)->nullable();
            $table->json('jarak_samping_foto')->nullable();

            // jarak belakang
            $table->string('jarak_belakang_hasil', 255)->nullable();
            $table->string('jarak_belakang_keterangan', 100)->nullable();
            $table->json('jarak_belakang_foto')->nullable();

            // bebas buka panel
            $table->string('bebas_buka_panel_hasil', 255)->nullable();
            $table->string('bebas_buka_panel_keterangan', 100)->nullable();
            $table->json('bebas_buka_panel_foto')->nullable();

            // pencahayaan
            $table->string('pencahayaan_hasil', 255)->nullable();
            $table->string('pencahayaan_keterangan', 100)->nullable();
            $table->json('pencahayaan_foto')->nullable();

            // barang tidak pakai
            $table->string('barang_tidak_pakai_hasil', 255)->nullable();
            $table->string('barang_tidak_pakai_keterangan', 100)->nullable();
            $table->json('barang_tidak_pakai_foto')->nullable();

            // ventilasi
            $table->string('ventilasi_hasil', 255)->nullable();
            $table->string('ventilasi_keterangan', 100)->nullable();
            $table->json('ventilasi_foto')->nullable();

            // saluran uap
            $table->string('saluran_uap_hasil', 255)->nullable();
            $table->string('saluran_uap_keterangan', 100)->nullable();
            $table->json('saluran_uap_foto')->nullable();

            // dimensi
            $table->json('dimensi_foto')->nullable();

            $table->decimal('jarak_bagian_depan', 15, 4)->nullable();
            $table->decimal('jarak_bagian_samping', 15, 4)->nullable();
            $table->decimal('jarak_bagian_belakang_tr', 15, 4)->nullable();
            $table->decimal('jarak_bagian_belakang_tm', 15, 4)->nullable();
            $table->decimal('jarak_antar_panel', 15, 4)->nullable();
            $table->decimal('lebar_pintu_masuk', 15, 4)->nullable();
            $table->decimal('tinggi_panel', 15, 4)->nullable();

            $table->text('keterangan')->nullable();

            // pembumian
            $table->json('pembumian_foto')->nullable();

            $table->decimal('trafo1', 15, 4)->nullable();
            $table->decimal('trafo2', 15, 4)->nullable();
            $table->decimal('trafo3', 15, 4)->nullable();
            $table->decimal('panel', 15, 4)->nullable();
            $table->decimal('bonding_panel', 15, 4)->nullable();

            $table->text('keterangan2')->nullable();

            // pencahayaan panel
            $table->json('pencahayaan_foto2')->nullable();

            $table->decimal('area_depan_panel', 15, 4)->nullable();
            $table->decimal('area_blikg_panel', 15, 4)->nullable();
            $table->decimal('area_trafo', 15, 4)->nullable();

            $table->text('keterangan3')->nullable();

            // thermography
            $table->json('thermography_foto')->nullable();

            $table->decimal('trafo1_thermal', 15, 4)->nullable();
            $table->decimal('trafo2_thermal', 15, 4)->nullable();
            $table->decimal('trafo3_thermal', 15, 4)->nullable();
            $table->decimal('circuit_breaker_utama', 15, 4)->nullable();
            $table->decimal('circuit_breaker_distribusi', 15, 4)->nullable();
            $table->decimal('busbar', 15, 4)->nullable();
            
            $table->text('keterangan4')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_instalasi_listrik');
    }
};
