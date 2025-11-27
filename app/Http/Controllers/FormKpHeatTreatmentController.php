<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\FormKpHeatTreatment;
use Illuminate\Support\Facades\Storage;

class FormKpHeatTreatmentController extends Controller
{
    public function index()
    {
        $heatTreatments = FormKpHeatTreatment::with(['jobOrderTool.jobOrder', 'jobOrderTool.tool'])
            ->whereHas('jobOrderTool', function ($q) {
                $q->where('status_tool', 'selesai')
                ->whereHas('tool', function ($q2) {
                    $q2->where('jenis_riksa_uji_id', 2)
                        ->where('sub_jenis_riksa_uji_id', 7);
                });
            })
            ->get();

        return view('form_kp.ptp.heat_treatment.index', [
            'title' => 'Hasil Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle' => 'Daftar alat selesai diperiksa',
            'heatTreatments' => $heatTreatments,
        ]);
    }


    public function create($jobOrderToolId)
    {
        // ambil pivot berdasarkan ID pivot
        $jobOrderTool = JobOrderTool::with('tool', 'jobOrder')
            ->findOrFail($jobOrderToolId);

        return view('form_kp.ptp.heat_treatment.create', [
            'title'         => 'Form Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle'         => 'Isi Form KP Heat Treatment/Oven',
            'jobOrderTool'  => $jobOrderTool,
        ]);
    }

    public function store(Request $request, $jobOrderToolId)
    {
        // dd($request->all());
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        // Validasi input
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'pabrik_pembuat' => 'nullable|string|max:255',

            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'jenis_bejana' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'jenis_tipe' => 'nullable|string|max:255',

            'foto_billet' => 'nullable|array',
            'foto_billet.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'dimensi_billet_maks' => 'nullable|numeric',
            'berat_billet_maks' => 'nullable|numeric',
            'kapasitas_maks' => 'nullable|numeric',
            'kapasitas_efektif' => 'nullable|numeric',

            'foto_shell' => 'nullable|array',
            'foto_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'tebal_dinding_shell' => 'nullable|numeric',
            'material_shell' => 'nullable|string|max:255',
            'tebal_refractory_shaped' => 'nullable|numeric',
            'tebal_refractory_unshaped' => 'nullable|numeric',
            'jarak_antar_refractory' => 'nullable|numeric',

            'foto_jalur_furnace' => 'nullable|array',
            'foto_jalur_furnace.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'jumlah_jalur_operasi' => 'nullable|integer',
            'panjang_jalur_operasi' => 'nullable|numeric',
            'dimensi_total_furnace' => 'nullable|string|max:255',
            'dimensi_efektif_furnace' => 'nullable|string|max:255',

            'foto_pembakaran' => 'nullable|array',
            'foto_pembakaran.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'bahan_bakar' => 'nullable|string|max:255',
            'temp_awal' => 'nullable|numeric',
            'temp_akhir' => 'nullable|numeric',

            'tekanan_nozel_ng' => 'nullable|numeric',
            'kapasitas_nozel_ng' => 'nullable|numeric',
            'tekanan_nozel_oksigen' => 'nullable|numeric',
            'kapasitas_nozel_oksigen' => 'nullable|numeric',
            'tekanan_nozel_n2' => 'nullable|numeric',
            'kapasitas_nozel_n2' => 'nullable|numeric',

            'tebal_pipa_bakar' => 'nullable|numeric',
            'diameter_pipa_bakar' => 'nullable|numeric',
            'jenis_pipa' => 'nullable|string|max:255',
            'dimensi_pondasi' => 'nullable|string|max:255',

            'foto_pendingin' => 'nullable|array',
            'foto_pendingin.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'temp_air_masuk' => 'nullable|numeric',
            'temp_air_keluar' => 'nullable|numeric',
            'tekanan_air' => 'nullable|numeric',
            'laju_aliran_air' => 'nullable|numeric',
            'diameter_pipa_pendingin' => 'nullable|numeric',
            'tebal_pipa_pendingin' => 'nullable|numeric',

            'konstruksi_pondasi_furnace' => 'nullable|string|max:100',
            'keterangan_konstruksi_pondasi_furnace' => 'nullable|string',
            'foto_konstruksi_pondasi_furnace' => 'nullable|array',
            'foto_konstruksi_pondasi_furnace.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_shell' => 'nullable|string|max:100',
            'keterangan_furnace_shell' => 'nullable|string',
            'foto_furnace_shell' => 'nullable|array',
            'foto_furnace_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sambungan_las' => 'nullable|string|max:100',
            'keterangan_sambungan_las' => 'nullable|string',
            'foto_sambungan_las' => 'nullable|array',
            'foto_sambungan_las.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'tutup_furnace' => 'nullable|string|max:100',
            'keterangan_tutup_furnace' => 'nullable|string',
            'foto_tutup_furnace' => 'nullable|array',
            'foto_tutup_furnace.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'refractory' => 'nullable|string|max:100',
            'keterangan_refractory' => 'nullable|string',
            'foto_refractory' => 'nullable|array',
            'foto_refractory.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_sidewalls_refractory' => 'nullable|string|max:100',
            'keterangan_sidewalls_refractory' => 'nullable|string',
            'foto_sidewalls_refractory' => 'nullable|array',
            'foto_sidewalls_refractory.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_hearth_refractory' => 'nullable|string|max:100',
            'keterangan_hearth_refractory' => 'nullable|string',
            'foto_hearth_refractory' => 'nullable|array',
            'foto_hearth_refractory.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'clamping_hydraulic' => 'nullable|string|max:100',
            'keterangan_clamping_hydraulic' => 'nullable|string',
            'foto_clamping_hydraulic' => 'nullable|array',
            'foto_clamping_hydraulic.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'keterangan_charging_table' => 'nullable|string',
            'foto_charging_table' => 'nullable|array',
            'foto_charging_table.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_top_igniter' => 'nullable|string|max:100',
            'keterangan_furnace_top_igniter' => 'nullable|string',
            'foto_furnace_top_igniter' => 'nullable|array',
            'foto_furnace_top_igniter.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'burner' => 'nullable|string|max:100',
            'keterangan_burner' => 'nullable|string',
            'foto_burner' => 'nullable|array',
            'foto_burner.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'conveyor' => 'nullable|string|max:100',
            'keterangan_conveyor' => 'nullable|string',
            'foto_conveyor' => 'nullable|array',
            'foto_conveyor.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'control_room' => 'nullable|string|max:100',
            'keterangan_control_room' => 'nullable|string',
            'foto_control_room' => 'nullable|array',
            'foto_control_room.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'pipa_nosel' => 'nullable|string|max:100',
            'keterangan_pipa_nosel' => 'nullable|string',
            'foto_pipa_nosel' => 'nullable|array',
            'foto_pipa_nosel.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'nosel_ng' => 'nullable|string|max:100',
            'keterangan_nosel_ng' => 'nullable|string',
            'foto_nosel_ng' => 'nullable|array',
            'foto_nosel_ng.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_ng' => 'nullable|string|max:100',
            'keterangan_pipa_ng' => 'nullable|string',
            'foto_pipa_ng' => 'nullable|array',
            'foto_pipa_ng.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'nosel_oksigen' => 'nullable|string|max:100',
            'keterangan_nosel_oksigen' => 'nullable|string',
            'foto_nosel_oksigen' => 'nullable|array',
            'foto_nosel_oksigen.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_oksigen' => 'nullable|string|max:100',
            'keterangan_pipa_oksigen' => 'nullable|string',
            'foto_pipa_oksigen' => 'nullable|array',
            'foto_pipa_oksigen.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'nosel_n2' => 'nullable|string|max:100',
            'keterangan_nosel_n2' => 'nullable|string',
            'foto_nosel_n2' => 'nullable|array',
            'foto_nosel_n2.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_n2' => 'nullable|string|max:100',
            'keterangan_pipa_n2' => 'nullable|string',
            'foto_pipa_n2' => 'nullable|array',
            'foto_pipa_n2.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve' => 'nullable|string|max:100',
            'keterangan_safety_valve' => 'nullable|string',
            'foto_safety_valve' => 'nullable|array',
            'foto_safety_valve.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'holder_cap' => 'nullable|string|max:100',
            'keterangan_holder_cap' => 'nullable|string',
            'foto_holder_cap' => 'nullable|array',
            'foto_holder_cap.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin' => 'nullable|string',
            'foto_sistem_pendingin' => 'nullable|array',
            'foto_sistem_pendingin.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin_tutup' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin_tutup' => 'nullable|string',
            'foto_sistem_pendingin_tutup' => 'nullable|array',
            'foto_sistem_pendingin_tutup.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin_shell' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin_shell' => 'nullable|string',
            'foto_sistem_pendingin_shell' => 'nullable|array',
            'foto_sistem_pendingin_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_air_pendingin_shell' => 'nullable|string|max:100',
            'keterangan_pipa_air_pendingin_shell' => 'nullable|string',
            'foto_pipa_air_pendingin_shell' => 'nullable|array',
            'foto_pipa_air_pendingin_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin_kejut' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin_kejut' => 'nullable|string',
            'foto_sistem_pendingin_kejut' => 'nullable|array',
            'foto_sistem_pendingin_kejut.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_kelistrikan' => 'nullable|string|max:100',
            'keterangan_sistem_kelistrikan' => 'nullable|string',
            'foto_sistem_kelistrikan' => 'nullable|array',
            'foto_sistem_kelistrikan.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'mcb' => 'nullable|string|max:100',
            'keterangan_mcb' => 'nullable|string',
            'foto_mcb' => 'nullable|array',
            'foto_mcb.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sambungan_bracket' => 'nullable|string|max:100',
            'keterangan_sambungan_bracket' => 'nullable|string',
            'foto_sambungan_bracket' => 'nullable|array',
            'foto_sambungan_bracket.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'tahanan_isolasi' => 'nullable|string|max:100',
            'keterangan_tahanan_isolasi' => 'nullable|string',
            'foto_tahanan_isolasi' => 'nullable|array',
            'foto_tahanan_isolasi.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_device' => 'nullable|string|max:100',
            'keterangan_safety_device' => 'nullable|string',
            'foto_safety_device' => 'nullable|array',
            'foto_safety_device.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pressure_gauge' => 'nullable|string|max:100',
            'keterangan_pressure_gauge' => 'nullable|string',
            'foto_pressure_gauge' => 'nullable|array',
            'foto_pressure_gauge.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'temp_idicator' => 'nullable|string|max:100',
            'keterangan_temp_idicator' => 'nullable|string',
            'foto_temp_idicator' => 'nullable|array',
            'foto_temp_idicator.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sensor_bahan_bakar' => 'nullable|string|max:100',
            'keterangan_sensor_bahan_bakar' => 'nullable|string',
            'foto_sensor_bahan_bakar' => 'nullable|array',
            'foto_sensor_bahan_bakar.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'thermocouple' => 'nullable|string|max:100',
            'keterangan_thermocouple' => 'nullable|string',
            'foto_thermocouple' => 'nullable|array',
            'foto_thermocouple.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pembumian' => 'nullable|string|max:100',
            'keterangan_sistem_pembumian' => 'nullable|string',
            'foto_sistem_pembumian' => 'nullable|array',
            'foto_sistem_pembumian.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_top_bleeding' => 'nullable|string|max:100',
            'keterangan_furnace_top_bleeding' => 'nullable|string',
            'foto_furnace_top_bleeding' => 'nullable|array',
            'foto_furnace_top_bleeding.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_nitrogen_supply' => 'nullable|string|max:100',
            'keterangan_safety_valve_nitrogen_supply' => 'nullable|string',
            'foto_safety_valve_nitrogen_supply' => 'nullable|array',
            'foto_safety_valve_nitrogen_supply.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_ng_cng' => 'nullable|string|max:100',
            'keterangan_safety_valve_ng_cng' => 'nullable|string',
            'foto_safety_valve_ng_cng' => 'nullable|array',
            'foto_safety_valve_ng_cng.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_oksigen' => 'nullable|string|max:100',
            'keterangan_safety_valve_oksigen' => 'nullable|string',
            'foto_safety_valve_oksigen' => 'nullable|array',
            'foto_safety_valve_oksigen.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_n2' => 'nullable|string|max:100',
            'keterangan_safety_valve_n2' => 'nullable|string',
            'foto_safety_valve_n2' => 'nullable|array',
            'foto_safety_valve_n2.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'dust_collector' => 'nullable|string|max:100',
            'keterangan_dust_collector' => 'nullable|string',
            'foto_dust_collector' => 'nullable|array',
            'foto_dust_collector.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'gas_stop_valve' => 'nullable|string|max:100',
            'keterangan_gas_stop_valve' => 'nullable|string',
            'foto_gas_stop_valve' => 'nullable|array',
            'foto_gas_stop_valve.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'dust_remover' => 'nullable|string|max:100',
            'keterangan_dust_remover' => 'nullable|string',
            'foto_dust_remover' => 'nullable|array',
            'foto_dust_remover.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'electrostatis_precipitator_bag' => 'nullable|string|max:100',
            'keterangan_electrostatis_precipitator_bag' => 'nullable|string',
            'foto_electrostatis_precipitator_bag' => 'nullable|array',
            'foto_electrostatis_precipitator_bag.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'emergency_stop' => 'nullable|string|max:100',
            'keterangan_emergency_stop' => 'nullable|string',
            'foto_emergency_stop' => 'nullable|array',
            'foto_emergency_stop.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pagar_pengaman_lantai' => 'nullable|string|max:100',
            'keterangan_pagar_pengaman_lantai' => 'nullable|string',
            'foto_pagar_pengaman_lantai' => 'nullable|array',
            'foto_pagar_pengaman_lantai.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'lantai_dapur' => 'nullable|string|max:100',
            'keterangan_lantai_dapur' => 'nullable|string',
            'foto_lantai_dapur' => 'nullable|array',
            'foto_lantai_dapur.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pagar_pengaman_tangga' => 'nullable|string|max:100',
            'keterangan_pagar_pengaman_tangga' => 'nullable|string',
            'foto_pagar_pengaman_tangga' => 'nullable|array',
            'foto_pagar_pengaman_tangga.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'catatan'             => 'nullable|string',
        ]);

        // Konversi tanggal ke format Y-m-d
        $toDate = fn($date) => $date 
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') 
            : null;

        $validated['tanggal_pemeriksaan'] = $toDate($validated['tanggal_pemeriksaan']);

        // Simpan file jika ada upload foto  
        foreach ([
            'foto_informasi_umum',
            'foto_billet',
            'foto_shell',
            'foto_jalur_furnace',
            'foto_pembakaran',
            'foto_pendingin',
            'foto_konstruksi_pondasi_furnace',
            'foto_furnace_shell',
            'foto_sambungan_las',
            'foto_tutup_furnace',
            'foto_refractory',
            'foto_sidewalls_refractory',
            'foto_hearth_refractory',
            'foto_clamping_hydraulic',
            'foto_charging_table',
            'foto_furnace_top_igniter',
            'foto_burner',
            'foto_conveyor',
            'foto_control_room',
            'foto_pipa_nosel',
            'foto_nosel_ng',
            'foto_pipa_ng',
            'foto_nosel_oksigen',
            'foto_pipa_oksigen',
            'foto_nosel_n2',
            'foto_pipa_n2',
            'foto_safety_valve',
            'foto_holder_cap',
            'foto_sistem_pendingin',
            'foto_sistem_pendingin_tutup',
            'foto_sistem_pendingin_shell',
            'foto_pipa_air_pendingin_shell',
            'foto_sistem_pendingin_kejut',
            'foto_sistem_kelistrikan',
            'foto_mcb',
            'foto_sambungan_bracket',
            'foto_tahanan_isolasi',
            'foto_safety_device',
            'foto_pressure_gauge',
            'foto_temp_idicator',
            'foto_sensor_bahan_bakar',
            'foto_thermocouple',
            'foto_sistem_pembumian',
            'foto_furnace_top_bleeding',
            'foto_safety_valve_nitrogen_supply',
            'foto_safety_valve_ng_cng',
            'foto_safety_valve_oksigen',
            'foto_safety_valve_n2',
            'foto_dust_collector',
            'foto_gas_stop_valve',
            'foto_dust_remover',
            'foto_electrostatis_precipitator_bag',
            'foto_emergency_stop',
            'foto_pagar_pengaman_lantai',
            'foto_lantai_dapur',
            'foto_pagar_pengaman_tangga',
        ] as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('ptp/heat_treatment', 'public');
                }
                $validated[$field] = json_encode($paths);
            } else {
                $validated[$field] = null;
            }
        }

        // Tambahkan kolom lain yang tidak berasal dari request
        $validated['job_order_tool_id'] = $jobOrderToolId;

        // Simpan data ke tabel
        FormKpHeatTreatment::create($validated);

        // Update status_tool di job_order_tools
        $jobOrderTool = JobOrderTool::findOrFail($jobOrderToolId);
        $jobOrderTool->update([
            'status_tool' => 'selesai',
            'finished_at' => now(),
        ]);

        return redirect()->route('form_kp.ptp.heat_treatment.index')->with('success', 'Form KP Heat Treatment/Oven berhasil disimpan!');
    }

    public function show(FormKpHeatTreatment $formKpHeatTreatment)
    {
        // load relasi
        $formKpHeatTreatment->load([
            'jobOrderTool.jobOrder',
            'jobOrderTool.tool'
        ]);

        return view('form_kp.ptp.heat_treatment.show', [
            'title' => 'Detail Hasil Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle' => '',
            'formKpHeatTreatment' => $formKpHeatTreatment,
        ]);
    }

    public function edit(FormKpHeatTreatment $formKpHeatTreatment)
    {
        return view('form_kp.ptp.heat_treatment.edit', [
            'title' => 'Edit Hasil Kartu Pemeriksaan Heat Treatment/Oven',
            'subtitle' => 'Perbarui data hasil pemeriksaan',
            'formKpHeatTreatment' => $formKpHeatTreatment,
        ]);
    }

    public function update(Request $request, FormKpHeatTreatment $formKpHeatTreatment)
    {
        // dd($request->all());
        $validated = $request->validate([
            'tanggal_pemeriksaan' => 'nullable|date',
            'pabrik_pembuat' => 'nullable|string|max:255',

            'foto_informasi_umum' => 'nullable|array',
            'foto_informasi_umum.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'jenis_bejana' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'jenis_tipe' => 'nullable|string|max:255',

            'foto_billet' => 'nullable|array',
            'foto_billet.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'dimensi_billet_maks' => 'nullable|numeric',
            'berat_billet_maks' => 'nullable|numeric',
            'kapasitas_maks' => 'nullable|numeric',
            'kapasitas_efektif' => 'nullable|numeric',

            'foto_shell' => 'nullable|array',
            'foto_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'tebal_dinding_shell' => 'nullable|numeric',
            'material_shell' => 'nullable|string|max:255',
            'tebal_refractory_shaped' => 'nullable|numeric',
            'tebal_refractory_unshaped' => 'nullable|numeric',
            'jarak_antar_refractory' => 'nullable|numeric',

            'foto_jalur_furnace' => 'nullable|array',
            'foto_jalur_furnace.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'jumlah_jalur_operasi' => 'nullable|integer',
            'panjang_jalur_operasi' => 'nullable|numeric',
            'dimensi_total_furnace' => 'nullable|string|max:255',
            'dimensi_efektif_furnace' => 'nullable|string|max:255',

            'foto_pembakaran' => 'nullable|array',
            'foto_pembakaran.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'bahan_bakar' => 'nullable|string|max:255',
            'temp_awal' => 'nullable|numeric',
            'temp_akhir' => 'nullable|numeric',

            'tekanan_nozel_ng' => 'nullable|numeric',
            'kapasitas_nozel_ng' => 'nullable|numeric',
            'tekanan_nozel_oksigen' => 'nullable|numeric',
            'kapasitas_nozel_oksigen' => 'nullable|numeric',
            'tekanan_nozel_n2' => 'nullable|numeric',
            'kapasitas_nozel_n2' => 'nullable|numeric',

            'tebal_pipa_bakar' => 'nullable|numeric',
            'diameter_pipa_bakar' => 'nullable|numeric',
            'jenis_pipa' => 'nullable|string|max:255',
            'dimensi_pondasi' => 'nullable|string|max:255',

            'foto_pendingin' => 'nullable|array',
            'foto_pendingin.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'temp_air_masuk' => 'nullable|numeric',
            'temp_air_keluar' => 'nullable|numeric',
            'tekanan_air' => 'nullable|numeric',
            'laju_aliran_air' => 'nullable|numeric',
            'diameter_pipa_pendingin' => 'nullable|numeric',
            'tebal_pipa_pendingin' => 'nullable|numeric',

            'konstruksi_pondasi_furnace' => 'nullable|string|max:100',
            'keterangan_konstruksi_pondasi_furnace' => 'nullable|string',
            'foto_konstruksi_pondasi_furnace' => 'nullable|array',
            'foto_konstruksi_pondasi_furnace.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_shell' => 'nullable|string|max:100',
            'keterangan_furnace_shell' => 'nullable|string',
            'foto_furnace_shell' => 'nullable|array',
            'foto_furnace_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sambungan_las' => 'nullable|string|max:100',
            'keterangan_sambungan_las' => 'nullable|string',
            'foto_sambungan_las' => 'nullable|array',
            'foto_sambungan_las.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'tutup_furnace' => 'nullable|string|max:100',
            'keterangan_tutup_furnace' => 'nullable|string',
            'foto_tutup_furnace' => 'nullable|array',
            'foto_tutup_furnace.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'refractory' => 'nullable|string|max:100',
            'keterangan_refractory' => 'nullable|string',
            'foto_refractory' => 'nullable|array',
            'foto_refractory.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_sidewalls_refractory' => 'nullable|string|max:100',
            'keterangan_sidewalls_refractory' => 'nullable|string',
            'foto_sidewalls_refractory' => 'nullable|array',
            'foto_sidewalls_refractory.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_hearth_refractory' => 'nullable|string|max:100',
            'keterangan_hearth_refractory' => 'nullable|string',
            'foto_hearth_refractory' => 'nullable|array',
            'foto_hearth_refractory.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'clamping_hydraulic' => 'nullable|string|max:100',
            'keterangan_clamping_hydraulic' => 'nullable|string',
            'foto_clamping_hydraulic' => 'nullable|array',
            'foto_clamping_hydraulic.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'keterangan_charging_table' => 'nullable|string',
            'foto_charging_table' => 'nullable|array',
            'foto_charging_table.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_top_igniter' => 'nullable|string|max:100',
            'keterangan_furnace_top_igniter' => 'nullable|string',
            'foto_furnace_top_igniter' => 'nullable|array',
            'foto_furnace_top_igniter.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'burner' => 'nullable|string|max:100',
            'keterangan_burner' => 'nullable|string',
            'foto_burner' => 'nullable|array',
            'foto_burner.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'conveyor' => 'nullable|string|max:100',
            'keterangan_conveyor' => 'nullable|string',
            'foto_conveyor' => 'nullable|array',
            'foto_conveyor.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'control_room' => 'nullable|string|max:100',
            'keterangan_control_room' => 'nullable|string',
            'foto_control_room' => 'nullable|array',
            'foto_control_room.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'pipa_nosel' => 'nullable|string|max:100',
            'keterangan_pipa_nosel' => 'nullable|string',
            'foto_pipa_nosel' => 'nullable|array',
            'foto_pipa_nosel.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'nosel_ng' => 'nullable|string|max:100',
            'keterangan_nosel_ng' => 'nullable|string',
            'foto_nosel_ng' => 'nullable|array',
            'foto_nosel_ng.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_ng' => 'nullable|string|max:100',
            'keterangan_pipa_ng' => 'nullable|string',
            'foto_pipa_ng' => 'nullable|array',
            'foto_pipa_ng.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'nosel_oksigen' => 'nullable|string|max:100',
            'keterangan_nosel_oksigen' => 'nullable|string',
            'foto_nosel_oksigen' => 'nullable|array',
            'foto_nosel_oksigen.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_oksigen' => 'nullable|string|max:100',
            'keterangan_pipa_oksigen' => 'nullable|string',
            'foto_pipa_oksigen' => 'nullable|array',
            'foto_pipa_oksigen.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'nosel_n2' => 'nullable|string|max:100',
            'keterangan_nosel_n2' => 'nullable|string',
            'foto_nosel_n2' => 'nullable|array',
            'foto_nosel_n2.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_n2' => 'nullable|string|max:100',
            'keterangan_pipa_n2' => 'nullable|string',
            'foto_pipa_n2' => 'nullable|array',
            'foto_pipa_n2.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve' => 'nullable|string|max:100',
            'keterangan_safety_valve' => 'nullable|string',
            'foto_safety_valve' => 'nullable|array',
            'foto_safety_valve.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'holder_cap' => 'nullable|string|max:100',
            'keterangan_holder_cap' => 'nullable|string',
            'foto_holder_cap' => 'nullable|array',
            'foto_holder_cap.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin' => 'nullable|string',
            'foto_sistem_pendingin' => 'nullable|array',
            'foto_sistem_pendingin.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin_tutup' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin_tutup' => 'nullable|string',
            'foto_sistem_pendingin_tutup' => 'nullable|array',
            'foto_sistem_pendingin_tutup.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin_shell' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin_shell' => 'nullable|string',
            'foto_sistem_pendingin_shell' => 'nullable|array',
            'foto_sistem_pendingin_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pipa_air_pendingin_shell' => 'nullable|string|max:100',
            'keterangan_pipa_air_pendingin_shell' => 'nullable|string',
            'foto_pipa_air_pendingin_shell' => 'nullable|array',
            'foto_pipa_air_pendingin_shell.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pendingin_kejut' => 'nullable|string|max:100',
            'keterangan_sistem_pendingin_kejut' => 'nullable|string',
            'foto_sistem_pendingin_kejut' => 'nullable|array',
            'foto_sistem_pendingin_kejut.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_kelistrikan' => 'nullable|string|max:100',
            'keterangan_sistem_kelistrikan' => 'nullable|string',
            'foto_sistem_kelistrikan' => 'nullable|array',
            'foto_sistem_kelistrikan.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'mcb' => 'nullable|string|max:100',
            'keterangan_mcb' => 'nullable|string',
            'foto_mcb' => 'nullable|array',
            'foto_mcb.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sambungan_bracket' => 'nullable|string|max:100',
            'keterangan_sambungan_bracket' => 'nullable|string',
            'foto_sambungan_bracket' => 'nullable|array',
            'foto_sambungan_bracket.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'tahanan_isolasi' => 'nullable|string|max:100',
            'keterangan_tahanan_isolasi' => 'nullable|string',
            'foto_tahanan_isolasi' => 'nullable|array',
            'foto_tahanan_isolasi.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_device' => 'nullable|string|max:100',
            'keterangan_safety_device' => 'nullable|string',
            'foto_safety_device' => 'nullable|array',
            'foto_safety_device.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pressure_gauge' => 'nullable|string|max:100',
            'keterangan_pressure_gauge' => 'nullable|string',
            'foto_pressure_gauge' => 'nullable|array',
            'foto_pressure_gauge.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'temp_idicator' => 'nullable|string|max:100',
            'keterangan_temp_idicator' => 'nullable|string',
            'foto_temp_idicator' => 'nullable|array',
            'foto_temp_idicator.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sensor_bahan_bakar' => 'nullable|string|max:100',
            'keterangan_sensor_bahan_bakar' => 'nullable|string',
            'foto_sensor_bahan_bakar' => 'nullable|array',
            'foto_sensor_bahan_bakar.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'thermocouple' => 'nullable|string|max:100',
            'keterangan_thermocouple' => 'nullable|string',
            'foto_thermocouple' => 'nullable|array',
            'foto_thermocouple.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'sistem_pembumian' => 'nullable|string|max:100',
            'keterangan_sistem_pembumian' => 'nullable|string',
            'foto_sistem_pembumian' => 'nullable|array',
            'foto_sistem_pembumian.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'furnace_top_bleeding' => 'nullable|string|max:100',
            'keterangan_furnace_top_bleeding' => 'nullable|string',
            'foto_furnace_top_bleeding' => 'nullable|array',
            'foto_furnace_top_bleeding.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_nitrogen_supply' => 'nullable|string|max:100',
            'keterangan_safety_valve_nitrogen_supply' => 'nullable|string',
            'foto_safety_valve_nitrogen_supply' => 'nullable|array',
            'foto_safety_valve_nitrogen_supply.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_ng_cng' => 'nullable|string|max:100',
            'keterangan_safety_valve_ng_cng' => 'nullable|string',
            'foto_safety_valve_ng_cng' => 'nullable|array',
            'foto_safety_valve_ng_cng.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_oksigen' => 'nullable|string|max:100',
            'keterangan_safety_valve_oksigen' => 'nullable|string',
            'foto_safety_valve_oksigen' => 'nullable|array',
            'foto_safety_valve_oksigen.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'safety_valve_n2' => 'nullable|string|max:100',
            'keterangan_safety_valve_n2' => 'nullable|string',
            'foto_safety_valve_n2' => 'nullable|array',
            'foto_safety_valve_n2.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'dust_collector' => 'nullable|string|max:100',
            'keterangan_dust_collector' => 'nullable|string',
            'foto_dust_collector' => 'nullable|array',
            'foto_dust_collector.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'gas_stop_valve' => 'nullable|string|max:100',
            'keterangan_gas_stop_valve' => 'nullable|string',
            'foto_gas_stop_valve' => 'nullable|array',
            'foto_gas_stop_valve.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'dust_remover' => 'nullable|string|max:100',
            'keterangan_dust_remover' => 'nullable|string',
            'foto_dust_remover' => 'nullable|array',
            'foto_dust_remover.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'electrostatis_precipitator_bag' => 'nullable|string|max:100',
            'keterangan_electrostatis_precipitator_bag' => 'nullable|string',
            'foto_electrostatis_precipitator_bag' => 'nullable|array',
            'foto_electrostatis_precipitator_bag.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'emergency_stop' => 'nullable|string|max:100',
            'keterangan_emergency_stop' => 'nullable|string',
            'foto_emergency_stop' => 'nullable|array',
            'foto_emergency_stop.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pagar_pengaman_lantai' => 'nullable|string|max:100',
            'keterangan_pagar_pengaman_lantai' => 'nullable|string',
            'foto_pagar_pengaman_lantai' => 'nullable|array',
            'foto_pagar_pengaman_lantai.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'lantai_dapur' => 'nullable|string|max:100',
            'keterangan_lantai_dapur' => 'nullable|string',
            'foto_lantai_dapur' => 'nullable|array',
            'foto_lantai_dapur.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'pagar_pengaman_tangga' => 'nullable|string|max:100',
            'keterangan_pagar_pengaman_tangga' => 'nullable|string',
            'foto_pagar_pengaman_tangga' => 'nullable|array',
            'foto_pagar_pengaman_tangga.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'catatan'             => 'nullable|string',
        ]);

        // konversi tanggal
        $validated['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal_pemeriksaan'])->format('Y-m-d');

        // upload file baru kalau ada
        foreach ([
            'foto_informasi_umum',
            'foto_billet',
            'foto_shell',
            'foto_jalur_furnace',
            'foto_pembakaran',
            'foto_pendingin',
            'foto_konstruksi_pondasi_furnace',
            'foto_furnace_shell',
            'foto_sambungan_las',
            'foto_tutup_furnace',
            'foto_refractory',
            'foto_sidewalls_refractory',
            'foto_hearth_refractory',
            'foto_clamping_hydraulic',
            'foto_charging_table',
            'foto_furnace_top_igniter',
            'foto_burner',
            'foto_conveyor',
            'foto_control_room',
            'foto_pipa_nosel',
            'foto_nosel_ng',
            'foto_pipa_ng',
            'foto_nosel_oksigen',
            'foto_pipa_oksigen',
            'foto_nosel_n2',
            'foto_pipa_n2',
            'foto_safety_valve',
            'foto_holder_cap',
            'foto_sistem_pendingin',
            'foto_sistem_pendingin_tutup',
            'foto_sistem_pendingin_shell',
            'foto_pipa_air_pendingin_shell',
            'foto_sistem_pendingin_kejut',
            'foto_sistem_kelistrikan',
            'foto_mcb',
            'foto_sambungan_bracket',
            'foto_tahanan_isolasi',
            'foto_safety_device',
            'foto_pressure_gauge',
            'foto_temp_idicator',
            'foto_sensor_bahan_bakar',
            'foto_thermocouple',
            'foto_sistem_pembumian',
            'foto_furnace_top_bleeding',
            'foto_safety_valve_nitrogen_supply',
            'foto_safety_valve_ng_cng',
            'foto_safety_valve_oksigen',
            'foto_safety_valve_n2',
            'foto_dust_collector',
            'foto_gas_stop_valve',
            'foto_dust_remover',
            'foto_electrostatis_precipitator_bag',
            'foto_emergency_stop',
            'foto_pagar_pengaman_lantai',
            'foto_lantai_dapur',
            'foto_pagar_pengaman_tangga',
        ] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($formKpHeatTreatment->$field) {
                    $oldFiles = json_decode($formKpHeatTreatment->$field, true) ?? [];
                    foreach ($oldFiles as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                // Upload file baru
                $paths = [];
                foreach ((array) $request->file($field) as $file) {
                    $paths[] = $file->store('ptp/heat_treatment', 'public');
                }

                $validated[$field] = json_encode($paths);
            } else {
                // Jika tidak upload baru, pertahankan lama
                $validated[$field] = $formKpHeatTreatment->$field;
            }
        }

        $formKpHeatTreatment->update($validated);

        return redirect()->route('form_kp.ptp.heat_treatment.index', $formKpHeatTreatment->id)
            ->with('success', 'Form KP Heat Treatment/Oven berhasil diperbarui!');
    }
}
