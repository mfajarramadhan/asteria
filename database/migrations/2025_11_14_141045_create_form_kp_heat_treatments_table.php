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
        Schema::create('form_kp_heat_treatment', function (Blueprint $table) {
            $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');

            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();
            $table->string('jenis_tipe', 100)->nullable();

            $table->json('foto_billet')->nullable();
            $table->decimal('dimensi_billet_maks', 15, 4)->nullable();
            $table->decimal('berat_billet_maks', 15, 4)->nullable();
            $table->decimal('kapasitas_maks', 15, 4)->nullable();
            $table->decimal('kapasitas_efektif', 15, 4)->nullable();

            $table->json('foto_shell')->nullable();
            $table->decimal('tebal_dinding_shell', 15, 4)->nullable();
            $table->string('material_shell', 100)->nullable();
            $table->decimal('tebal_refractory_shaped', 15, 4)->nullable();
            $table->decimal('tebal_refractory_unshaped', 15, 4)->nullable();
            $table->decimal('jarak_antar_refractory', 15, 4)->nullable();

            $table->json('foto_jalur_furnace')->nullable();
            $table->integer('jumlah_jalur_operasi')->nullable();
            $table->decimal('panjang_jalur_operasi', 15, 4)->nullable();
            $table->string('dimensi_total_furnace', 100)->nullable();
            $table->string('dimensi_efektif_furnace', 100)->nullable();

            $table->json('foto_pembakaran')->nullable();
            $table->string('bahan_bakar', 100)->nullable();
            $table->decimal('temp_awal', 15, 4)->nullable();
            $table->decimal('temp_akhir', 15, 4)->nullable();
            $table->decimal('tekanan_nozel_ng', 15, 4)->nullable();
            $table->decimal('kapasitas_nozel_ng', 15, 4)->nullable();
            $table->decimal('tekanan_nozel_oksigen', 15, 4)->nullable();
            $table->decimal('kapasitas_nozel_oksigen', 15, 4)->nullable();
            $table->decimal('tekanan_nozel_n2', 15, 4)->nullable();
            $table->decimal('kapasitas_nozel_n2', 15, 4)->nullable();
            $table->decimal('tebal_pipa_bakar', 15, 4)->nullable();
            $table->decimal('diameter_pipa_bakar', 15, 4)->nullable();
            $table->string('jenis_pipa', 100)->nullable();
            $table->string('dimensi_pondasi', 100)->nullable();

            $table->json('foto_pendingin')->nullable();
            $table->decimal('temp_air_masuk', 15, 4)->nullable();
            $table->decimal('temp_air_keluar', 15, 4)->nullable();
            $table->decimal('tekanan_air', 15, 4)->nullable();
            $table->decimal('laju_aliran_air', 15, 4)->nullable();
            $table->decimal('diameter_pipa_pendingin', 15, 4)->nullable();
            $table->decimal('tebal_pipa_pendingin', 15, 4)->nullable();
            $table->string('konstruksi_pondasi_furnace', 100)->nullable();
            $table->text('keterangan_konstruksi_pondasi_furnace')->nullable();
            $table->json('foto_konstruksi_pondasi_furnace')->nullable();
            $table->string('furnace_shell', 100)->nullable();
            $table->text('keterangan_furnace_shell')->nullable();
            $table->json('foto_furnace_shell')->nullable();
            $table->string('sambungan_las', 100)->nullable();
            $table->text('keterangan_sambungan_las')->nullable();
            $table->json('foto_sambungan_las')->nullable();
            $table->string('tutup_furnace', 100)->nullable();
            $table->text('keterangan_tutup_furnace')->nullable();
            $table->json('foto_tutup_furnace')->nullable();
            $table->string('refractory', 100)->nullable();
            $table->text('keterangan_refractory')->nullable();
            $table->json('foto_refractory')->nullable();
            $table->string('furnace_roof', 100)->nullable();
            $table->text('keterangan_furnace_roof')->nullable();
            $table->json('foto_furnace_roof')->nullable();
            $table->string('furnace_sidewalls_refractory', 100)->nullable();
            $table->text('keterangan_sidewalls_refractory')->nullable();
            $table->json('foto_sidewalls_refractory')->nullable();
            $table->string('furnace_hearth_refractory', 100)->nullable();
            $table->text('keterangan_hearth_refractory')->nullable();
            $table->json('foto_hearth_refractory')->nullable();
            $table->string('clamping_hydraulic', 100)->nullable();
            $table->text('keterangan_clamping_hydraulic')->nullable();
            $table->json('foto_clamping_hydraulic')->nullable();
            $table->string('keterangan_charging_table', 100)->nullable();
            $table->json('foto_charging_table')->nullable();
            $table->string('furnace_top_igniter', 100)->nullable();
            $table->text('keterangan_furnace_top_igniter')->nullable();
            $table->json('foto_furnace_top_igniter')->nullable();
            $table->string('burner', 100)->nullable();
            $table->text('keterangan_burner')->nullable();
            $table->json('foto_burner')->nullable();
            $table->string('conveyor', 100)->nullable();
            $table->text('keterangan_conveyor')->nullable();
            $table->json('foto_conveyor')->nullable();
            $table->string('control_room', 100)->nullable();
            $table->text('keterangan_control_room')->nullable();
            $table->json('foto_control_room')->nullable();
            $table->string('pipa_nosel', 100)->nullable();
            $table->text('keterangan_pipa_nosel')->nullable();
            $table->json('foto_pipa_nosel')->nullable();
            $table->string('nosel_ng', 100)->nullable();
            $table->text('keterangan_nosel_ng')->nullable();
            $table->json('foto_nosel_ng')->nullable();
            $table->string('pipa_ng', 100)->nullable();
            $table->text('keterangan_pipa_ng')->nullable();
            $table->json('foto_pipa_ng')->nullable();
            $table->string('nosel_oksigen', 100)->nullable();
            $table->text('keterangan_nosel_oksigen')->nullable();
            $table->json('foto_nosel_oksigen')->nullable();
            $table->string('pipa_oksigen', 100)->nullable();
            $table->text('keterangan_pipa_oksigen')->nullable();
            $table->json('foto_pipa_oksigen')->nullable();
            $table->string('nosel_n2', 100)->nullable();
            $table->text('keterangan_nosel_n2')->nullable();
            $table->json('foto_nosel_n2')->nullable();
            $table->string('pipa_n2', 100)->nullable();
            $table->text('keterangan_pipa_n2')->nullable();
            $table->json('foto_pipa_n2')->nullable();
            $table->string('safety_valve', 100)->nullable();
            $table->text('keterangan_safety_valve')->nullable();
            $table->json('foto_safety_valve')->nullable();
            $table->string('holder_cap', 100)->nullable();
            $table->text('keterangan_holder_cap')->nullable();
            $table->json('foto_holder_cap')->nullable();
            $table->string('sistem_pendingin', 100)->nullable();
            $table->text('keterangan_sistem_pendingin')->nullable();
            $table->json('foto_sistem_pendingin')->nullable();
            $table->string('sistem_pendingin_tutup', 100)->nullable();
            $table->text('keterangan_sistem_pendingin_tutup')->nullable();
            $table->json('foto_sistem_pendingin_tutup')->nullable();
            $table->string('sistem_pendingin_shell', 100)->nullable();
            $table->text('keterangan_sistem_pendingin_shell')->nullable();
            $table->json('foto_sistem_pendingin_shell')->nullable();
            $table->string('pipa_air_pendingin_shell', 100)->nullable();
            $table->text('keterangan_pipa_air_pendingin_shell')->nullable();
            $table->json('foto_pipa_air_pendingin_shell')->nullable();
            $table->string('sistem_pendingin_kejut', 100)->nullable();
            $table->text('keterangan_sistem_pendingin_kejut')->nullable();
            $table->json('foto_sistem_pendingin_kejut')->nullable();
            $table->string('sistem_kelistrikan', 100)->nullable();
            $table->text('keterangan_sistem_kelistrikan')->nullable();
            $table->json('foto_sistem_kelistrikan')->nullable();
            $table->string('mcb', 100)->nullable();
            $table->text('keterangan_mcb')->nullable();
            $table->json('foto_mcb')->nullable();
            $table->string('sambungan_bracket', 100)->nullable();
            $table->text('keterangan_sambungan_bracket')->nullable();
            $table->json('foto_sambungan_bracket')->nullable();
            $table->string('tahanan_isolasi', 100)->nullable();
            $table->text('keterangan_tahanan_isolasi')->nullable();
            $table->json('foto_tahanan_isolasi')->nullable();
            $table->string('safety_device', 100)->nullable();
            $table->text('keterangan_safety_device')->nullable();
            $table->json('foto_safety_device')->nullable();
            $table->string('pressure_gauge', 100)->nullable();
            $table->text('keterangan_pressure_gauge')->nullable();
            $table->json('foto_pressure_gauge')->nullable();
            $table->string('temp_idicator', 100)->nullable();
            $table->text('keterangan_temp_idicator')->nullable();
            $table->json('foto_temp_idicator')->nullable();
            $table->string('sensor_bahan_bakar', 100)->nullable();
            $table->text('keterangan_sensor_bahan_bakar')->nullable();
            $table->json('foto_sensor_bahan_bakar')->nullable();
            $table->string('thermocouple', 100)->nullable();
            $table->text('keterangan_thermocouple')->nullable();
            $table->json('foto_thermocouple')->nullable();
            $table->string('sistem_pembumian', 100)->nullable();
            $table->text('keterangan_sistem_pembumian')->nullable();
            $table->json('foto_sistem_pembumian')->nullable();
            $table->string('furnace_top_bleeding', 100)->nullable();
            $table->text('keterangan_furnace_top_bleeding')->nullable();
            $table->json('foto_furnace_top_bleeding')->nullable();
            $table->string('safety_valve_nitrogen_supply', 100)->nullable();
            $table->text('keterangan_safety_valve_nitrogen_supply')->nullable();
            $table->json('foto_safety_valve_nitrogen_supply')->nullable();
            $table->string('safety_valve_ng_cng', 100)->nullable();
            $table->text('keterangan_safety_valve_ng_cng')->nullable();
            $table->json('foto_safety_valve_ng_cng')->nullable();
            $table->string('safety_valve_oksigen', 100)->nullable();
            $table->text('keterangan_safety_valve_oksigen')->nullable();
            $table->json('foto_safety_valve_oksigen')->nullable();
            $table->string('safety_valve_n2', 100)->nullable();
            $table->text('keterangan_safety_valve_n2')->nullable();
            $table->json('foto_safety_valve_n2')->nullable();
            $table->string('dust_collector', 100)->nullable();
            $table->text('keterangan_dust_collector')->nullable();
            $table->json('foto_dust_collector')->nullable();
            $table->string('gas_stop_valve', 100)->nullable();
            $table->text('keterangan_gas_stop_valve')->nullable();
            $table->json('foto_gas_stop_valve')->nullable();
            $table->string('dust_remover', 100)->nullable();
            $table->text('keterangan_dust_remover')->nullable();
            $table->json('foto_dust_remover')->nullable();
            $table->string('electrostatis_precipitator_bag', 100)->nullable();
            $table->text('keterangan_electrostatis_precipitator_bag')->nullable();
            $table->json('foto_electrostatis_precipitator_bag')->nullable();
            $table->string('emergency_stop', 100)->nullable();
            $table->text('keterangan_emergency_stop')->nullable();
            $table->json('foto_emergency_stop')->nullable();
            $table->string('pagar_pengaman_lantai', 100)->nullable();
            $table->text('keterangan_pagar_pengaman_lantai')->nullable();
            $table->json('foto_pagar_pengaman_lantai')->nullable();
            $table->string('lantai_dapur', 100)->nullable();
            $table->text('keterangan_lantai_dapur')->nullable();
            $table->json('foto_lantai_dapur')->nullable();
            $table->string('pagar_pengaman_tangga', 100)->nullable();
            $table->text('keterangan_pagar_pengaman_tangga')->nullable();
            $table->json('foto_pagar_pengaman_tangga')->nullable();      
            $table->text('catatan')->nullable();      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_heat_treatment');
    }
};
