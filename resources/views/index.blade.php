<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Healya Clinic (Modern Cyan Green)</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'healya-primary': '#10b981', // Emerald Green
                        'healya-dark': '#0f172a', // Slate Dark
                        'healya-light': '#ccfbf1', // Cyan Light
                        'healya-bg': '#f5f7fa', // Background Lembut Abu
                        'healya-secondary': '#06b6d4', // Cyan
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .max-h-\[80vh\] {
            max-height: 80vh;
        }

        .input-rm:focus {
            border-color: #10b981;
            /* Emerald Green */
            box-shadow: 0 0 0 1px #10b981;
        }

        /* Custom style untuk nama pasien yang bisa diklik */
        .patient-name-link {
            cursor: pointer;
        }

        /* Menyembunyikan spin button default untuk input type number yang tidak diinginkan, misalnya untuk hasil lab non-numerik*/
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            /* Digunakan untuk menyembunyikan panah jika diperlukan di beberapa input numerik khusus */
        }
    </style>
</head>

<body class="bg-healya-bg text-healya-dark font-sans" x-data="appointmentData()">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <header class="mb-8 pb-3 border-b-4 border-healya-primary">
            <h3 class="text-3xl font-extrabold text-healya-dark flex items-center">
                <i class="fas fa-stethoscope mr-3 text-healya-primary"></i>
                Dashboard Admin <span class="text-healya-primary ml-1">Healya Clinic</span>
            </h3>
        </header>

        <div class="bg-gradient-to-br from-emerald-50 to-cyan-100 p-8 rounded-2xl shadow-xl overflow-hidden">

            <div class="p-0 border-b border-gray-100/50 mb-5">
                <h5 class="text-xl font-semibold text-healya-dark">Daftar Janji Temu (Appointment)</h5>
            </div>

            <div class="">

                <nav class="flex space-x-4 border-b-2 border-healya-primary/30 mb-6" aria-label="Tabs">
                    <template x-for="tab in tabs" :key="tab.id">
                        <button @click="activeTab = tab.id"
                            :class="{ 'border-healya-primary text-healya-dark font-semibold': activeTab === tab
                                .id, 'border-transparent text-gray-500 hover:text-healya-primary hover:border-healya-primary/50': activeTab !==
                                    tab.id }"
                            class="px-3 py-2 text-sm font-medium border-b-4 transition duration-200 focus:outline-none flex items-center">
                            <i :class="tab.icon" class="mr-2"></i>
                            <span x-text="tab.name"></span>
                        </button>
                    </template>
                </nav>

                <template x-for="tab in tabs" :key="tab.id">
                    <div x-show="activeTab === tab.id" class="overflow-x-auto min-w-full">
                        <table
                            class="min-w-full divide-y divide-gray-200 text-sm bg-white rounded-lg overflow-hidden shadow-sm">
                            <thead class="bg-healya-light text-healya-dark uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Pasien</th>
                                    <th class="px-4 py-3 text-left"
                                        x-text="activeTab === 'all' ? 'Layanan (Kategori)' : 'Layanan'"></th>
                                    <th class="px-4 py-3 text-left">Tanggal</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                    <th class="px-4 py-3 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <template x-for="item in filteredAppointments" :key="item.id">
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-600" x-text="item.id"></td>
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-healya-dark patient-name-link hover:text-healya-primary hover:underline"
                                            @click="openPatientDetailModal(item.id)">
                                            <span x-text="item.pasien"></span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap" x-html="getLayananText(item)"></td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-500" x-text="item.tanggal">
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                :class="getStatusClasses(item.status)" x-text="item.status">
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap" x-html="getActionButtons(item)"></td>
                                    </tr>
                                </template>
                                <tr x-show="filteredAppointments.length === 0">
                                    <td colspan="6" class="py-10 text-center text-gray-500 italic">
                                        Tidak ada data janji temu untuk kategori ini.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </template>
            </div>

        </div>
    </div>

    <div x-show="isPatientDetailModalOpen"
        class="fixed inset-0 z-50 bg-gray-900 bg-opacity-75 transition-opacity duration-300"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="isPatientDetailModalOpen" @click.away="isPatientDetailModalOpen = false"
                class="bg-white rounded-xl shadow-3xl w-full max-w-xl transform transition-all duration-300 overflow-hidden"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div class="p-5 bg-healya-primary text-healya-dark flex justify-between items-center rounded-t-xl">
                    <h5 class="text-xl font-bold flex items-center">
                        <i class="fas fa-user-circle mr-2"></i> Detail Pasien: <span class="ml-2"
                            x-text="patientDetail.nama"></span>
                    </h5>
                    <button type="button" @click="isPatientDetailModalOpen = false"
                        class="text-healya-dark hover:text-gray-700">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <div class="p-6">
                    <p class="mb-4 text-gray-600">Informasi lengkap pasien berdasarkan data pendaftaran:</p>

                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day w-6 text-healya-primary"></i>
                            <p class="ml-3 text-sm"><span class="font-semibold">Tanggal Lahir:</span> <span
                                    x-text="patientDetail.dob"></span></p>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-venus-mars w-6 text-healya-primary"></i>
                            <p class="ml-3 text-sm"><span class="font-semibold">Jenis Kelamin:</span> <span
                                    x-text="patientDetail.gender"></span></p>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone w-6 text-healya-primary"></i>
                            <p class="ml-3 text-sm"><span class="font-semibold">No. Telp:</span> <span
                                    x-text="patientDetail.phone"></span></p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt w-6 text-healya-primary mt-1"></i>
                            <p class="ml-3 text-sm"><span class="font-semibold">Alamat:</span> <span
                                    x-text="patientDetail.address"></span></p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t flex justify-end space-x-3">
                    <button type="button" @click="isPatientDetailModalOpen = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="isApproveConfirmModalOpen"
        class="fixed inset-0 z-50 bg-gray-900 bg-opacity-75 transition-opacity duration-300"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="isApproveConfirmModalOpen" @click.away="isApproveConfirmModalOpen = false"
                class="bg-white rounded-xl shadow-3xl w-full max-w-md transform transition-all duration-300 overflow-hidden"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <form id="approveForm" method="POST" :action="modal.actionUrl">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="status" value="Dijadwalkan">

                    <div class="p-5 bg-healya-secondary text-white flex justify-between items-center rounded-t-xl">
                        <h5 class="text-xl font-bold flex items-center"><i class="fas fa-calendar-check mr-2"></i>
                            Konfirmasi Janji Temu</h5>
                        <button type="button" @click="isApproveConfirmModalOpen = false"
                            class="text-white hover:text-gray-200"><i class="fas fa-times text-2xl"></i></button>
                    </div>

                    <div class="p-6">
                        <p class="mb-4 text-healya-dark">Anda akan menyetujui janji temu berikut dan mengubah statusnya
                            menjadi Dijadwalkan :</p>

                        <div class="p-3 bg-healya-light rounded-lg text-sm space-y-1">
                            <p><strong>ID:</strong> <span class="font-bold" x-text="modal.id"></span></p>
                            <p><strong>Pasien:</strong> <span class="font-bold" x-text="modal.pasien"></span></p>
                            <p><strong>Layanan:</strong> <span x-text="modal.layanan"></span></p>
                            <p><strong>Tanggal:</strong> <span x-text="modal.tanggal"></span></p>
                        </div>

                        <p class="mt-4 text-xs text-gray-500">Pastikan semua sumber daya (dokter/alat) sudah tersedia
                            pada tanggal tersebut.</p>
                    </div>

                    <div class="p-4 bg-gray-50 border-t flex justify-end space-x-3">
                        <button type="button" @click="isApproveConfirmModalOpen = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-healya-primary rounded-lg hover:bg-healya-primary/80 transition duration-150">
                            <i class="fas fa-check-circle mr-2"></i> Jadwalkan (Approve)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div x-show="isModalOpen" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-75 transition-opacity duration-300"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="isModalOpen" @click.away="isModalOpen = false"
                class="bg-white rounded-xl shadow-3xl w-full max-w-6xl transform transition-all duration-300 overflow-hidden"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <form id="rekamMedisForm" method="POST" action="/clinic/medical-records/store">
                    @csrf
                    <div class="p-5 bg-healya-primary text-healya-dark flex justify-between items-center rounded-t-xl">
                        <h5 class="text-xl font-bold flex items-center">
                            <i class="fas fa-file-alt mr-2"></i> Input Hasil Layanan: <span class="ml-2"
                                x-text="modal.layanan"></span>
                        </h5>
                        <button type="button" @click="isModalOpen = false"
                            class="text-healya-dark hover:text-gray-700">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <div class="p-6 max-h-[80vh] overflow-y-auto">

                        <div class="p-4 mb-5 border-l-4 border-healya-primary bg-healya-light rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                                <div>
                                    <p class="mb-1 text-healya-dark"><strong>Pasien:</strong> <span class="font-bold"
                                            x-text="modal.pasien"></span></p>
                                    <p class="mb-0 text-healya-dark"><strong>Layanan:</strong> <span
                                            x-text="modal.layanan"></span></p>
                                </div>
                                <div>
                                    <p class="mb-1 text-healya-dark"><strong>ID Janji Temu:</strong> <span
                                            class="font-bold" x-text="modal.id"></span></p>
                                    <p class="mb-0 text-healya-dark"><strong>Tanggal Kunjungan:</strong> <span
                                            class="font-bold" x-text="modal.tanggal"></span></p>
                                </div>
                            </div>
                        </div>

                        <div x-show="modal.formType === 'tes_darah'" class="space-y-4">
                            <h5 class="text-lg font-semibold mb-3 text-healya-dark"><i class="fas fa-vial mr-2"></i>
                                Formulir Hasil Tes Darah</h5>
                            <div
                                class="grid grid-cols-5 gap-4 items-end text-xs font-semibold text-gray-600 border-b pb-1">
                                <div class="col-span-2">Parameter/Jenis Tes</div>
                                <div class="col-span-1">Hasil (Numerik)</div>
                                <div class="col-span-2">Kesimpulan/Interpretasi (Teks)</div>
                            </div>

                            <div class="p-4 bg-healya-light rounded-lg space-y-4">
                                <h6 class="font-semibold text-healya-dark">I. Hematologi (Darah Lengkap)</h6>

                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Hemoglobin (Hb)
                                            (g/dL)</label></div>
                                    <div class="col-span-1"><input type="number" step="0.1"
                                            name="darah[hb_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="14.5"></div>
                                    <div class="col-span-2"><input type="text" name="darah[hb_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Rendah (Anemia Ringan)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Leukosit (WBC)
                                            (/uL)</label></div>
                                    <div class="col-span-1"><input type="number" step="100"
                                            name="darah[leukosit_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="6800"></div>
                                    <div class="col-span-2"><input type="text" name="darah[leukosit_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Tinggi (Leukositosis)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Trombosit (PLT)
                                            (/uL)</label></div>
                                    <div class="col-span-1"><input type="number" step="1000"
                                            name="darah[trombosit_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="250000"></div>
                                    <div class="col-span-2"><input type="text" name="darah[trombosit_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Normal"></div>
                                </div>

                                <h6 class="font-semibold text-healya-dark pt-2">II. Metabolisme & Kimia Darah</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Gula Darah Puasa (GDP)
                                            (mg/dL)</label></div>
                                    <div class="col-span-1"><input type="number" name="darah[gdp_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="110"></div>
                                    <div class="col-span-2"><input type="text" name="darah[gdp_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Tinggi (Hiperglikemia)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Kolesterol Total
                                            (mg/dL)</label></div>
                                    <div class="col-span-1"><input type="number" name="darah[kolesterol_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="225"></div>
                                    <div class="col-span-2"><input type="text" name="darah[kolesterol_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Tinggi"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Trigliserida
                                            (mg/dL)</label></div>
                                    <div class="col-span-1"><input type="number" name="darah[trigliserida_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="170"></div>
                                    <div class="col-span-2"><input type="text"
                                            name="darah[trigliserida_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Tinggi Ringan"></div>
                                </div>

                                <h6 class="font-semibold text-healya-dark pt-2">III. Fungsi Organ (Dasar)</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">SGPT (U/L)</label></div>
                                    <div class="col-span-1"><input type="number" name="darah[sgpt_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="55"></div>
                                    <div class="col-span-2"><input type="text" name="darah[sgpt_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Sedikit Tinggi"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Kreatinin (mg/dL)</label>
                                    </div>
                                    <div class="col-span-1"><input type="number" step="0.1"
                                            name="darah[kreatinin_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="1.2"></div>
                                    <div class="col-span-2"><input type="text" name="darah[kreatinin_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Normal"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Asam Urat (mg/dL)</label>
                                    </div>
                                    <div class="col-span-1"><input type="number" step="0.1"
                                            name="darah[asam_urat_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="7.8"></div>
                                    <div class="col-span-2"><input type="text" name="darah[asam_urat_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Tinggi"></div>
                                </div>
                            </div>

                            <label class="block text-sm font-medium text-gray-700 pt-2">IV. Kesimpulan Keseluruhan
                                (Ringkasan Analis)</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg input-rm" name="darah[ringkasan_analis]" rows="3"
                                placeholder="Contoh: Terdapat Anemia ringan, leukositosis, dan indikasi Dislipidemia serta Hiperglikemia (GDP Tinggi). Semua indikator fungsi organ lain dalam batas normal. Diperlukan konsultasi lebih lanjut dengan Spesialis Penyakit Dalam."></textarea>
                        </div>

                        <div x-show="modal.formType === 'tes_urine'" class="space-y-4">
                            <h5 class="text-lg font-semibold mb-3 text-healya-dark"><i class="fas fa-vial mr-2"></i>
                                Formulir Hasil Tes Urine</h5>
                            <div
                                class="grid grid-cols-5 gap-4 items-end text-xs font-semibold text-gray-600 border-b pb-1">
                                <div class="col-span-2">Parameter/Jenis Tes</div>
                                <div class="col-span-1">Hasil (Teks/Nilai)</div>
                                <div class="col-span-2">Kesimpulan/Interpretasi (Teks)</div>
                            </div>
                            <div class="p-4 bg-healya-light rounded-lg space-y-4">
                                <h6 class="font-semibold text-healya-dark">I. Fisik</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Warna</label></div>
                                    <div class="col-span-1"><input type="text" name="urine[warna]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Kuning Pucat"></div>
                                    <div class="col-span-2"><input type="text" name="urine[warna_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Cokelat (Abnormal)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Kejernihan</label></div>
                                    <div class="col-span-1"><input type="text" name="urine[kejernihan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Jernih"></div>
                                    <div class="col-span-2"><input type="text" name="urine[kejernihan_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Keruh (Infeksi/Batu)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Berat Jenis (SG)</label>
                                    </div>
                                    <div class="col-span-1"><input type="text" name="urine[berat_jenis]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="1.020"></div>
                                    <div class="col-span-2"><input type="text"
                                            name="urine[berat_jenis_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: 1.005 (Sangat Rendah)"></div>
                                </div>

                                <h6 class="font-semibold text-healya-dark pt-2">II. Kimiawi</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Protein</label></div>
                                    <div class="col-span-1"><input type="text" name="urine[protein_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Negatif / Positif (+)"></div>
                                    <div class="col-span-2"><input type="text" name="urine[protein_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Positif (Proteinuria)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Glukosa</label></div>
                                    <div class="col-span-1"><input type="text" name="urine[glukosa_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Positif (++)"></div>
                                    <div class="col-span-2"><input type="text" name="urine[glukosa_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Positif (Glukosuria)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Keton</label></div>
                                    <div class="col-span-1"><input type="text" name="urine[keton_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Negatif"></div>
                                    <div class="col-span-2"><input type="text" name="urine[keton_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Positif (Ketonuria)"></div>
                                </div>

                                <h6 class="font-semibold text-healya-dark pt-2">III. Sedimen (Satuan /LPB)</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Eritrosit (RBC)</label>
                                    </div>
                                    <div class="col-span-1"><input type="text" name="urine[eritrosit_sedimen]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="0-1"></div>
                                    <div class="col-span-2"><input type="text" name="urine[eritrosit_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: 5-10 (Hematuria)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Leukosit (WBC)</label>
                                    </div>
                                    <div class="col-span-1"><input type="text" name="urine[leukosit_sedimen]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="5-8"></div>
                                    <div class="col-span-2"><input type="text" name="urine[leukosit_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: 20-30 (Leukosituria, ISK)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Bakteri</label></div>
                                    <div class="col-span-1"><input type="text" name="urine[bakteri_sedimen]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Negatif / Positif"></div>
                                    <div class="col-span-2"><input type="text" name="urine[bakteri_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Positif (Indikasi ISK)"></div>
                                </div>
                            </div>
                            <label class="block text-sm font-medium text-gray-700 pt-2">IV. Kesimpulan Keseluruhan
                                (Ringkasan Analis)</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg input-rm" name="urine[ringkasan_analis]" rows="3"
                                placeholder="Contoh: Glukosuria terdeteksi (Positif ++), Leukosituria ringan. Saran: Konsultasi lebih lanjut untuk evaluasi diabetes melitus."></textarea>
                        </div>

                        <div x-show="modal.formType === 'tes_hormon'" class="space-y-4">
                            <h5 class="text-lg font-semibold mb-3 text-healya-dark"><i class="fas fa-vial mr-2"></i>
                                Formulir Hasil Tes Hormon (Tiroid)</h5>
                            <div
                                class="grid grid-cols-5 gap-4 items-end text-xs font-semibold text-gray-600 border-b pb-1">
                                <div class="col-span-2">Parameter/Jenis Tes</div>
                                <div class="col-span-1">Hasil (Numerik/Nilai)</div>
                                <div class="col-span-2">Kesimpulan/Interpretasi (Teks)</div>
                            </div>
                            <div class="p-4 bg-healya-light rounded-lg space-y-4">
                                <h6 class="font-semibold text-healya-dark">I. Hormon Hipofisis</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label class="block text-xs font-medium text-gray-700">TSH
                                            (uIU/mL)</label></div>
                                    <div class="col-span-1"><input type="number" step="0.01"
                                            name="hormon[tsh_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="0.15"></div>
                                    <div class="col-span-2"><input type="text" name="hormon[tsh_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Sangat Rendah"></div>
                                </div>

                                <h6 class="font-semibold text-healya-dark pt-2">II. Hormon Aktif</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Tiroksin Bebas (FT4)
                                            (ng/dL)</label></div>
                                    <div class="col-span-1"><input type="number" step="0.1"
                                            name="hormon[ft4_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="2.5"></div>
                                    <div class="col-span-2"><input type="text" name="hormon[ft4_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Tinggi"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Triiodotironin Bebas (FT3)
                                            (pg/mL)</label></div>
                                    <div class="col-span-1"><input type="number" step="0.1"
                                            name="hormon[ft3_hasil]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm text-center"
                                            placeholder="5.2"></div>
                                    <div class="col-span-2"><input type="text" name="hormon[ft3_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Tinggi"></div>
                                </div>

                                <h6 class="font-semibold text-healya-dark pt-2">III. Antibodi (Jika Diperiksa)</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Anti-TPO (IU/mL atau
                                            Status)</label></div>
                                    <div class="col-span-1"><input type="text" name="hormon[anti_tpo]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Positif / 150"></div>
                                    <div class="col-span-2"><input type="text" name="hormon[anti_tpo_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Positif (Indikasi Autoimun)"></div>
                                </div>
                            </div>
                            <label class="block text-sm font-medium text-gray-700 pt-2">IV. Kesimpulan Keseluruhan
                                (Ringkasan Analis)</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg input-rm" name="hormon[ringkasan_analis]"
                                rows="3"
                                placeholder="Contoh: TSH rendah dengan FT4 dan FT3 tinggi, menunjukkan Hipertiroidisme. Anti-TPO positif mengindikasikan penyakit autoimun (Grave's Disease)."></textarea>
                        </div>

                        <div x-show="modal.formType === 'vaksin_anak'" class="space-y-4">
                            <h5 class="text-lg font-semibold mb-2 text-healya-dark"><i
                                    class="fas fa-syringe mr-2"></i> Formulir Tindakan Vaksinasi (Rutin Anak/Bayi)</h5>
                            <div class="p-4 bg-healya-light rounded-lg space-y-4">
                                <h6 class="font-semibold text-healya-dark">I. Detail Vaksin</h6>
                                <div class="grid grid-cols-3 gap-4">
                                    <div><label class="block text-sm font-medium text-gray-700">Jenis Vaksin
                                            (Lengkap)</label><input type="text" name="vaksin_anak[jenis_vaksin]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Vaksin DPT-HB-Hib-Polio"></div>
                                    <div><label class="block text-sm font-medium text-gray-700">Dosis ke-</label><input
                                            type="text" name="vaksin_anak[dosis_ke]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Dosis Ke-3"></div>
                                    <div><label class="block text-sm font-medium text-gray-700">Nama dan Nomor
                                            Batch</label><input type="text" name="vaksin_anak[batch_no]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Pediacel #BX784"></div>
                                </div>

                                <h6 class="font-semibold text-healya-dark pt-2">III. Tindakan Medis</h6>
                                <div class="grid grid-cols-2 gap-4">
                                    <div><label class="block text-sm font-medium text-gray-700">Rute
                                            Pemberian</label><input type="text" name="vaksin_anak[rute]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Intramuskular (IM)"></div>
                                    <div><label class="block text-sm font-medium text-gray-700">Lokasi
                                            Suntikan</label><input type="text" name="vaksin_anak[lokasi_suntikan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Paha Kiri Atas"></div>
                                </div>
                            </div>
                            <h6 class="font-semibold text-healya-dark mt-4 mb-2">IV. Hasil Keseluruhan</h6>
                            <div class="grid grid-cols-5 gap-4 items-end mb-4">
                                <div class="col-span-2"><label class="block text-sm font-medium text-gray-700">Kesan
                                        Status</label></div>
                                <div class="col-span-1"><input type="text" name="vaksin_anak[kesan_status]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Lengkap"></div>
                                <div class="col-span-2"><label
                                        class="block text-sm font-medium text-gray-700 sr-only">Interpretasi</label><input
                                        type="text" name="vaksin_anak[kesan_interpretasi]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Interpretasi: Dosis sudah mencukupi"></div>
                            </div>
                            <div class="grid grid-cols-5 gap-4 items-end mb-4">
                                <div class="col-span-2"><label
                                        class="block text-sm font-medium text-gray-700">Reaksi/Efek Samping
                                        (KIPI)</label></div>
                                <div class="col-span-1"><input type="text" name="vaksin_anak[reaksi]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Demam ringan"></div>
                                <div class="col-span-2"><label
                                        class="block text-sm font-medium text-gray-700 sr-only">Interpretasi</label><input
                                        type="text" name="vaksin_anak[reaksi_interpretasi]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Interpretasi: Reaksi normal/ringan pasca-vaksin"></div>
                            </div>
                            <label class="block text-sm font-medium text-gray-700">Rekomendasi (Kesimpulan
                                Keseluruhan)</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg input-rm" name="vaksin_anak[rekomendasi]"
                                rows="2"
                                placeholder="Anjurkan Paracetamol jika demam, kompres dingin, dan jaga hidrasi. Jadwal vaksin Campak-Rubella (MR) berikutnya 3 bulan lagi."></textarea>
                        </div>

                        <div x-show="modal.formType === 'vaksin_hpv'" class="space-y-4">
                            <h5 class="text-lg font-semibold mb-2 text-healya-dark"><i
                                    class="fas fa-syringe mr-2"></i> Formulir Tindakan Vaksinasi (HPV)</h5>
                            <div class="p-4 bg-healya-light rounded-lg space-y-4">
                                <h6 class="font-semibold text-healya-dark">II. Detail Vaksin</h6>
                                <div class="grid grid-cols-3 gap-4">
                                    <div><label class="block text-sm font-medium text-gray-700">Jenis Vaksin
                                            (Lengkap)</label><input type="text" name="vaksin_hpv[jenis_vaksin]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Gardasil 9 / Cervarix"></div>
                                    <div><label class="block text-sm font-medium text-gray-700">Dosis ke-</label><input
                                            type="text" name="vaksin_hpv[dosis_ke]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Dosis Ke-1 dari 3"></div>
                                    <div><label class="block text-sm font-medium text-gray-700">Nomor
                                            Batch</label><input type="text" name="vaksin_hpv[batch_no]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="HPV-Vax #G9B78"></div>
                                </div>
                                <h6 class="font-semibold text-healya-dark pt-2">III. Tindakan Medis</h6>
                                <div class="grid grid-cols-2 gap-4">
                                    <div><label class="block text-sm font-medium text-gray-700">Rute
                                            Pemberian</label><input type="text" name="vaksin_hpv[rute]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Intramuskular (IM)"></div>
                                    <div><label class="block text-sm font-medium text-gray-700">Lokasi
                                            Suntikan</label><input type="text" name="vaksin_hpv[lokasi_suntikan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Otot Deltoid Kanan"></div>
                                </div>
                            </div>
                            <h6 class="font-semibold text-healya-dark mt-4 mb-2">IV. Hasil Keseluruhan</h6>
                            <div class="grid grid-cols-5 gap-4 items-end mb-4">
                                <div class="col-span-2"><label class="block text-sm font-medium text-gray-700">Kesan
                                        Status</label></div>
                                <div class="col-span-1"><input type="text" name="vaksin_hpv[kesan_status]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Lanjut Dosis 2"></div>
                                <div class="col-span-2"><label
                                        class="block text-sm font-medium text-gray-700 sr-only">Interpretasi</label><input
                                        type="text" name="vaksin_hpv[kesan_interpretasi]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Interpretasi: Perlu jadwal dosis kedua"></div>
                            </div>
                            <div class="grid grid-cols-5 gap-4 items-end mb-4">
                                <div class="col-span-2"><label class="block text-sm font-medium text-gray-700">Reaksi
                                        Pasca-Vaksinasi (KIPI)</label></div>
                                <div class="col-span-1"><input type="text" name="vaksin_hpv[reaksi]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Nyeri lokal"></div>
                                <div class="col-span-2"><label
                                        class="block text-sm font-medium text-gray-700 sr-only">Interpretasi</label><input
                                        type="text" name="vaksin_hpv[reaksi_interpretasi]"
                                        class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        placeholder="Interpretasi: Reaksi normal/ringan pasca-vaksin"></div>
                            </div>
                            <label class="block text-sm font-medium text-gray-700">Rekomendasi (Kesimpulan
                                Keseluruhan)</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg input-rm" name="vaksin_hpv[rekomendasi]" rows="2"
                                placeholder="Jadwal Dosis ke-2 HPV dalam 2 bulan. Pastikan tidak ada gejala berat."></textarea>
                        </div>

                        <div x-show="modal.formType === 'mcu'" class="space-y-4">
                            <h5 class="text-lg font-semibold mb-2 text-healya-dark"><i
                                    class="fas fa-stethoscope mr-2"></i> Formulir Pemeriksaan Kesehatan Menyeluruh
                                (MCU)</h5>
                            <div
                                class="grid grid-cols-5 gap-4 items-end text-xs font-semibold text-gray-600 border-b pb-1">
                                <div class="col-span-2">Parameter/Jenis Tes</div>
                                <div class="col-span-1">Hasil (Teks/Nilai)</div>
                                <div class="col-span-2">Kesimpulan/Interpretasi (Teks)</div>
                            </div>
                            <div class="p-4 bg-healya-light rounded-lg space-y-4">
                                <h6 class="font-semibold text-healya-dark">I. Pemeriksaan Fisik</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Tanda Vital (TD, Nadi,
                                            Suhu, RR)</label></div>
                                    <div class="col-span-1"><input type="text" name="mcu[tanda_vital]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="140/90, 88, 36.8"></div>
                                    <div class="col-span-2"><input type="text" name="mcu[tanda_vital_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: TD Tinggi (Hipertensi Grade 1)"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Antropometri (BB, TB,
                                            IMT)</label></div>
                                    <div class="col-span-1"><input type="text" name="mcu[antropometri]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="78kg, 165cm, 28.6"></div>
                                    <div class="col-span-2"><input type="text" name="mcu[antropometri_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Overweight"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Klinis (Keluhan/Temuan
                                            Organ)</label></div>
                                    <div class="col-span-1"><input type="text" name="mcu[klinis]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Konjungtiva anemis"></div>
                                    <div class="col-span-2"><input type="text" name="mcu[klinis_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Konjungtiva Anemis (Indikasi Anemia)"></div>
                                </div>
                            </div>

                            <div class="p-4 bg-healya-light rounded-lg space-y-4">
                                <h6 class="font-semibold text-healya-dark">II. Pencitraan (Imaging)</h6>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label
                                            class="block text-xs font-medium text-gray-700">Rontgen Toraks</label>
                                    </div>
                                    <div class="col-span-1"><input type="text" name="mcu[rontgen]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Normal"></div>
                                    <div class="col-span-2"><input type="text" name="mcu[rontgen_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Normal"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label class="block text-xs font-medium text-gray-700">EKG
                                            (Elektrokardiogram)</label></div>
                                    <div class="col-span-1"><input type="text" name="mcu[ekg]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Sinus Rhythm"></div>
                                    <div class="col-span-2"><input type="text" name="mcu[ekg_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Normal"></div>
                                </div>
                                <div class="grid grid-cols-5 gap-4 items-end">
                                    <div class="col-span-2"><label class="block text-xs font-medium text-gray-700">USG
                                            Abdomen</label></div>
                                    <div class="col-span-1"><input type="text" name="mcu[usg]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Echogenic"></div>
                                    <div class="col-span-2"><input type="text" name="mcu[usg_kesimpulan]"
                                            class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                            placeholder="Contoh: Fatty Liver Grade 1"></div>
                                </div>
                            </div>

                            <h6 class="font-semibold text-healya-dark mt-4 mb-2">III. Hasil Lab (Ringkasan)</h6>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="block text-sm font-medium text-gray-700">Panel Metabolisme (GDP,
                                        Kolesterol, Trigliserida)</label>
                                    <textarea class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm" name="mcu[panel_metabolisme]"
                                        rows="3" placeholder="GDP: 140 mg/dL. Kolesterol: 250 mg/dL. Trigliserida: 180 mg/dL."></textarea>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700">Interpretasi Lab
                                        Metabolisme</label>
                                    <textarea class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm"
                                        name="mcu[panel_metabolisme_kesimpulan]" rows="3"
                                        placeholder="Contoh: GDP Tinggi (Indikasi DM), Kolesterol Tinggi, Trigliserida Tinggi (Dislipidemia)."></textarea>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-2">
                                <div><label class="block text-sm font-medium text-gray-700">Fungsi Organ (SGPT,
                                        Kreatinin, Asam Urat)</label>
                                    <textarea class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm" name="mcu[fungsi_organ]"
                                        rows="3" placeholder="SGPT: 60 U/L. Kreatinin: 1.0 mg/dL. Asam Urat: 6.5 mg/dL."></textarea>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700">Interpretasi Lab Fungsi
                                        Organ</label>
                                    <textarea class="w-full p-2 border border-gray-300 rounded-lg text-sm input-rm" name="mcu[fungsi_organ_kesimpulan]"
                                        rows="3"
                                        placeholder="Contoh: SGPT sedikit di atas normal (Potensi gangguan hati ringan). Kreatinin & Asam Urat normal."></textarea>
                                </div>
                            </div>

                            <h6 class="font-semibold text-healya-dark mt-4 mb-2">IV. Kesimpulan Keseluruhan</h6>
                            <label class="block text-sm font-medium text-gray-700">Diagnosis/Kesan Akhir Dokter
                                (Kesimpulan Keseluruhan)</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg mb-4 input-rm" name="mcu[diagnosa]" rows="3"
                                placeholder="Diagnosis: Hipertensi Grade 1, Dislipidemia, Fatty Liver Grade 1. Status: Unfit with restriction (Modifikasi Gaya Hidup)."></textarea>
                            <label class="block text-sm font-medium text-gray-700">Rekomendasi Tindak Lanjut
                                (Kesimpulan Keseluruhan)</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg input-rm" name="mcu[rekomendasi]" rows="3"
                                placeholder="Konsultasi ke Spesialis Jantung (Hipertensi) dan Gizi (Diet). Ulang tes lab 6 bulan lagi."></textarea>
                        </div>

                    </div>

                    <div class="p-4 bg-gray-50 border-t flex justify-end space-x-3">
                        <button type="button" @click="isModalOpen = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Tutup</button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-healya-primary rounded-lg hover:bg-healya-primary/80 transition duration-150">
                            <i class="fas fa-save mr-2"></i> Simpan Hasil & Selesaikan Kunjungan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div x-show="isCancelModalOpen"
        class="fixed inset-0 z-50 bg-gray-900 bg-opacity-75 transition-opacity duration-300"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="isCancelModalOpen" @click.away="isCancelModalOpen = false"
                class="bg-white rounded-xl shadow-3xl w-full max-w-lg transform transition-all duration-300 overflow-hidden"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <form id="pembatalanForm" method="POST" :action="modal.actionUrl">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="p-5 bg-red-600 text-white flex justify-between items-center rounded-t-xl">
                        <h5 class="text-xl font-bold flex items-center"><i class="fas fa-times-circle mr-2"></i> Tolak
                            Janji Temu</h5>
                        <button type="button" @click="isCancelModalOpen = false"
                            class="text-white hover:text-gray-200"><i class="fas fa-times text-2xl"></i></button>
                    </div>

                    <div class="p-6">
                        <p class="text-red-500 text-sm mb-4">Anda akan menolak janji temu ID: <span class="font-bold"
                                x-text="modal.id"></span>. Mohon masukkan alasan penolakan.</p>
                        <input type="hidden" name="appointment_id" :value="modal.id">
                        <input type="hidden" name="status" value="Ditolak">
                        <div class="mb-3">
                            <label for="cancelReason" class="block text-sm font-medium text-gray-700 mb-1">Alasan
                                Penolakan</label>
                            <textarea class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                                id="cancelReason" name="alasan_pembatalan" rows="3" required
                                placeholder="Contoh: Jadwal dokter penuh, Pasien belum melengkapi dokumen, dll."></textarea>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 border-t flex justify-end space-x-3">
                        <button type="button" @click="isCancelModalOpen = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition duration-150">
                            <i class="fas fa-ban mr-2"></i> Tolak Janji Temu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div x-show="isShowResultModalOpen"
        class="fixed inset-0 z-50 bg-gray-900 bg-opacity-75 transition-opacity duration-300"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="isShowResultModalOpen" @click.away="isShowResultModalOpen = false"
                class="bg-white rounded-xl shadow-3xl w-full max-w-6xl transform transition-all duration-300 overflow-hidden"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div class="p-5 bg-healya-dark text-white flex justify-between items-center rounded-t-xl">
                    <h5 class="text-xl font-bold flex items-center">
                        <i class="fas fa-file-invoice mr-2"></i> Hasil Rekam Medis: <span class="ml-2"
                            x-text="resultModal.layanan"></span>
                    </h5>
                    <button type="button" @click="isShowResultModalOpen = false"
                        class="text-white hover:text-gray-300">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <div class="p-6 max-h-[80vh] overflow-y-auto">
                    <div class="p-4 mb-5 border-l-4 border-healya-primary bg-gray-50 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                            <div>
                                <p class="mb-1 text-healya-dark"><strong>Pasien:</strong> <span class="font-semibold"
                                        x-text="resultModal.pasien"></span></p>
                                <p class="mb-0 text-healya-dark"><strong>Layanan:</strong> <span
                                        x-text="resultModal.layanan"></span></p>
                            </div>
                            <div>
                                <p class="mb-1 text-healya-dark"><strong>ID Rekam Medis:</strong> <span
                                        class="font-semibold" x-text="resultModal.id"></span></p>
                                <p class="mb-0 text-healya-dark"><strong>Tanggal Selesai:</strong> <span
                                        class="font-semibold" x-text="resultModal.tanggal"></span></p>
                            </div>
                        </div>
                    </div>

                    <div x-show="resultModal.category === 'lab_darah'" class="space-y-4">
                        <h6 class="font-semibold text-healya-dark border-b pb-1 mb-2"><i
                                class="fas fa-flask mr-1"></i> I. Hematologi (Darah Lengkap)</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div> Hemoglobin (Hb): <span x-text="resultModal.data.darah_hb"></span></div>
                            <div> Leukosit (WBC): <span x-text="resultModal.data.darah_leukosit"></span></div>
                            <div> Trombosit (PLT): <span x-text="resultModal.data.darah_trombosit"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-water mr-1"></i> II. Metabolisme & Kimia Darah</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div> Gula Darah Puasa (GDP): <span x-text="resultModal.data.darah_gdp"></span></div>
                            <div> Kolesterol Total: <span x-text="resultModal.data.darah_kolesterol"></span></div>
                            <div> Trigliserida: <span x-text="resultModal.data.darah_trigliserida"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-heartbeat mr-1"></i> III. Fungsi Organ (Dasar)</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div> SGPT (Fungsi Hati): <span x-text="resultModal.data.darah_sgpt"></span></div>
                            <div> Kreatinin (Fungsi Ginjal): <span x-text="resultModal.data.darah_kreatinin"></span>
                            </div>
                            <div> Asam Urat: <span x-text="resultModal.data.darah_asamurat"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-chart-line mr-1"></i> IV. Ringkasan Analis (Kesimpulan Keseluruhan)</h6>
                        <p class="p-3 bg-gray-100 rounded text-sm italic" x-text="resultModal.data.darah_kesimpulan">
                        </p>
                    </div>

                    <div x-show="resultModal.category === 'lab_urine'" class="space-y-4">
                        <h6 class="font-semibold text-healya-dark border-b pb-1 mb-2"><i
                                class="fas fa-flask mr-1"></i> I. Fisik Urine</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> Warna: <span x-text="resultModal.data.urine_warna"></span></div>
                            <div> Kejernihan: <span x-text="resultModal.data.urine_kejernihan"></span></div>
                            <div> Berat Jenis (SG): <span x-text="resultModal.data.urine_sg"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-tint mr-1"></i> II. Kimiawi Urine</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> pH: <span x-text="resultModal.data.urine_ph"></span></div>
                            <div> Protein: <span x-text="resultModal.data.urine_protein"></span></div>
                            <div> Glukosa: <span x-text="resultModal.data.urine_glukosa"></span></div>
                            <div> Keton: <span x-text="resultModal.data.urine_keton"></span></div>
                            <div> Bilirubin: <span x-text="resultModal.data.urine_bilirubin"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-microscope mr-1"></i> III. Sedimen Urine</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> Eritrosit (RBC): <span x-text="resultModal.data.urine_rbc"></span></div>
                            <div> Leukosit (WBC): <span x-text="resultModal.data.urine_wbc"></span></div>
                            <div> Epitel: <span x-text="resultModal.data.urine_epitel"></span></div>
                            <div> Bakteri: <span x-text="resultModal.data.urine_bakteri"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-chart-line mr-1"></i> IV. Ringkasan Analis (Kesimpulan Keseluruhan)</h6>
                        <p class="p-3 bg-gray-100 rounded text-sm italic" x-text="resultModal.data.urine_kesimpulan">
                        </p>
                    </div>

                    <div x-show="resultModal.category === 'lab_hormon'" class="space-y-4">
                        <h6 class="font-semibold text-healya-dark border-b pb-1 mb-2"><i class="fas fa-dna mr-1"></i>
                            I. Hormon Tiroid</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> TSH (Thyroid-Stimulating Hormone): <span x-text="resultModal.data.hormon_tsh"></span>
                            </div>
                            <div> Tiroksin Bebas (FT4): <span x-text="resultModal.data.hormon_ft4"></span></div>
                            <div> Triiodotironin Bebas (FT3): <span x-text="resultModal.data.hormon_ft3"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-antibody mr-1"></i> II. Antibodi</h6>
                        <div class="text-sm">
                            Anti-TPO (Antibodi Tiroid): <span x-text="resultModal.data.hormon_anti_tpo"></span>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-chart-line mr-1"></i> III. Ringkasan Analis (Kesimpulan Keseluruhan)</h6>
                        <p class="p-3 bg-gray-100 rounded text-sm italic" x-text="resultModal.data.hormon_kesimpulan">
                        </p>
                    </div>

                    <div x-show="resultModal.category === 'vaksin_anak'" class="space-y-4">
                        <h6 class="font-semibold text-healya-dark border-b pb-1 mb-2"><i
                                class="fas fa-syringe mr-1"></i> I. Detail Vaksin</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> Jenis Vaksin: <span x-text="resultModal.data.vaksin_jenis"></span></div>
                            <div> Dosis Ke-: <span x-text="resultModal.data.vaksin_dosis"></span></div>
                            <div> No. Batch: <span x-text="resultModal.data.vaksin_batch"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-user-md mr-1"></i> II. Tindakan Medis</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div> Rute Pemberian: <span x-text="resultModal.data.vaksin_rute"></span></div>
                            <div> Lokasi Suntikan: <span x-text="resultModal.data.vaksin_lokasi"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-clipboard-check mr-1"></i> III. Hasil Keseluruhan</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div> Kesan Status: <span x-text="resultModal.data.vaksin_kesan"></span></div>
                            <div> Reaksi/Efek Samping (KIPI): <span x-text="resultModal.data.vaksin_reaksi"></span>
                            </div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-hand-holding-medical mr-1"></i> IV. Rekomendasi (Kesimpulan Keseluruhan)
                        </h6>
                        <p class="p-3 bg-gray-100 rounded text-sm italic"
                            x-text="resultModal.data.vaksin_rekomendasi"></p>
                    </div>

                    <div x-show="resultModal.category === 'vaksin_hpv'" class="space-y-4">
                        <h6 class="font-semibold text-healya-dark border-b pb-1 mb-2"><i
                                class="fas fa-syringe mr-1"></i> I. Detail Vaksin (HPV)</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> Jenis Vaksin: <span x-text="resultModal.data.vaksin_jenis"></span></div>
                            <div> Dosis Ke-: <span x-text="resultModal.data.vaksin_dosis"></span></div>
                            <div> No. Batch: <span x-text="resultModal.data.vaksin_batch"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-user-md mr-1"></i> II. Tindakan Medis (HPV)</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div> Rute Pemberian: <span x-text="resultModal.data.vaksin_rute"></span></div>
                            <div> Lokasi Suntikan: <span x-text="resultModal.data.vaksin_lokasi"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-clipboard-check mr-1"></i> III. Hasil Keseluruhan (HPV)</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div> Kesan Status: <span x-text="resultModal.data.vaksin_kesan"></span></div>
                            <div> Reaksi Pasca-Vaksinasi (KIPI): <span x-text="resultModal.data.vaksin_reaksi"></span>
                            </div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-hand-holding-medical mr-1"></i> IV. Rekomendasi (Kesimpulan Keseluruhan)
                        </h6>
                        <p class="p-3 bg-gray-100 rounded text-sm italic"
                            x-text="resultModal.data.vaksin_rekomendasi"></p>
                    </div>

                    <div x-show="resultModal.category === 'mcu'" class="space-y-4">
                        <h6 class="font-semibold text-healya-dark border-b pb-1 mb-2"><i
                                class="fas fa-user-md mr-1"></i> I. Pemeriksaan Fisik</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> Tanda Vital: <span x-text="resultModal.data.mcu_vital"></span></div>
                            <div> Antropometri: <span x-text="resultModal.data.mcu_antropometri"></span></div>
                            <div> Klinis: <span x-text="resultModal.data.mcu_klinis"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-x-ray mr-1"></i> II. Pencitraan (Imaging)</h6>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div> Rontgen Toraks: <span x-text="resultModal.data.mcu_rontgen"></span></div>
                            <div> EKG: <span x-text="resultModal.data.mcu_ekg"></span></div>
                            <div> USG Abdomen: <span x-text="resultModal.data.mcu_usg"></span></div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-flask mr-1"></i> III. Hasil Lab (Ringkasan)</h6>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold">Panel Metabolisme</p>
                                <p class="p-2 bg-gray-100 rounded italic"
                                    x-text="resultModal.data.mcu_panel_metabolisme"></p>
                            </div>
                            <div>
                                <p class="font-semibold">Fungsi Organ</p>
                                <p class="p-2 bg-gray-100 rounded italic"
                                    x-text="resultModal.data.mcu_fungsi_organ"></p>
                            </div>
                        </div>

                        <h6 class="font-semibold text-healya-dark border-b pb-1 pt-4 mb-2"><i
                                class="fas fa-clipboard-list mr-1"></i> IV. Kesimpulan & Rekomendasi (Kesimpulan
                            Keseluruhan)</h6>
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="font-semibold">Diagnosis/Kesan Akhir Dokter</p>
                                <p class="p-2 bg-healya-light rounded italic font-semibold"
                                    x-text="resultModal.data.mcu_diagnosa"></p>
                            </div>
                            <div>
                                <p class="font-semibold">Rekomendasi Tindak Lanjut</p>
                                <p class="p-2 bg-gray-100 rounded italic" x-text="resultModal.data.mcu_rekomendasi">
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 border-t flex justify-end space-x-3 mt-6">
                        <button type="button" @click="isShowResultModalOpen = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Tutup</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        // Data Dummy Hasil Rekam Medis (Untuk simulasi "Lihat Hasil")
        const medicalRecords = {
            '4001': {
                category: 'lab_darah',
                layanan: 'Tes Darah',
                pasien: 'Ali Fahmi',
                tanggal: '07 November 2025',
                data: {
                    darah_hb: '10.8 g/dL (Rendah)',
                    darah_leukosit: '12,000 /uL (Tinggi)',
                    darah_trombosit: '180,000 /uL',
                    darah_gdp: '180 mg/dL (Tinggi)',
                    darah_kolesterol: '230 mg/dL (Tinggi)',
                    darah_trigliserida: '250 mg/dL (Tinggi)',
                    darah_sgpt: '45 U/L (Normal)',
                    darah_kreatinin: '1.0 mg/dL (Normal)',
                    darah_asamurat: '6.5 mg/dL (Normal)',
                    darah_kesimpulan: 'Terdapat Anemia ringan, leukositosis, dan indikasi Dislipidemia serta Hiperglikemia. Semua indikator fungsi organ lain dalam batas normal. Diperlukan konsultasi lebih lanjut dengan Spesialis Penyakit Dalam.'
                }
            },
            '4002': {
                category: 'lab_urine',
                layanan: 'Tes Urine',
                pasien: 'Doni Firmansyah',
                tanggal: '09 November 2025',
                data: {
                    urine_warna: 'Kuning Pucat (Normal)',
                    urine_kejernihan: 'Jernih (Normal)',
                    urine_sg: '1.020 (Normal)',
                    urine_ph: '6.0 (Normal)',
                    urine_protein: 'Negatif (Normal)',
                    urine_glukosa: 'Positif (++ / 150 mg/dL) (Glukosuria)',
                    urine_keton: 'Negatif (Normal)',
                    urine_bilirubin: 'Negatif (Normal)',
                    urine_rbc: '0-1 /LPB (Normal)',
                    urine_wbc: '3-5 /LPB (Normal)',
                    urine_epitel: 'Sedikit (Normal)',
                    urine_bakteri: 'Negatif (Normal)',
                    urine_kesimpulan: 'Glukosuria terdeteksi. Hasil ini konsisten dengan potensi Diabetes Melitus yang tidak terkontrol. Direkomendasikan tes darah lanjutan.'
                }
            },
            '4003': {
                category: 'lab_hormon',
                layanan: 'Tes Hormon',
                pasien: 'Citra Dewi',
                tanggal: '09 November 2025',
                data: {
                    hormon_tsh: '0.15 uIU/mL (Rendah)',
                    hormon_ft4: '2.5 ng/dL (Tinggi)',
                    hormon_ft3: '5.2 pg/mL (Tinggi)',
                    hormon_anti_tpo: 'Positif (150 IU/mL)',
                    hormon_kesimpulan: 'TSH rendah dengan FT4 dan FT3 tinggi, menunjukkan Hipertiroidisme. Anti-TPO positif mengindikasikan kemungkinan penyakit autoimun (Grave\'s Disease). Segera konsultasi ke Sp.PD-KEMD.'
                }
            },
            '5001': {
                category: 'vaksin_anak',
                layanan: 'Vaksin Rutin Anak/Bayi',
                pasien: 'Rina Wijaya',
                tanggal: '11 November 2025',
                data: {
                    vaksin_jenis: 'Vaksin DPT-HB-Hib-Polio',
                    vaksin_dosis: 'Dosis Ke-3',
                    vaksin_batch: 'Pediacel #BX784',
                    vaksin_rute: 'Intramuskular (IM)',
                    vaksin_lokasi: 'Paha Kiri Atas',
                    vaksin_kesan: 'Dosis Lengkap',
                    vaksin_reaksi: 'Demam ringan (37.8 °C) & kemerahan lokal selama 1 hari.',
                    vaksin_rekomendasi: 'Anjurkan Paracetamol jika demam, kompres dingin, dan jaga hidrasi. Jadwal vaksin Campak-Rubella (MR) berikutnya 3 bulan lagi.'
                }
            },
            '5002': {
                category: 'vaksin_hpv',
                layanan: 'Vaksin HPV',
                pasien: 'Fajar Riyadi',
                tanggal: '10 November 2025',
                data: {
                    vaksin_jenis: 'Gardasil 9',
                    vaksin_dosis: 'Dosis Ke-1 dari 3',
                    vaksin_batch: 'HPV-Vax #G9B78',
                    vaksin_rute: 'Intramuskular (IM)',
                    vaksin_lokasi: 'Otot Deltoid Kanan',
                    vaksin_kesan: 'Lanjut Dosis 2 / Imunisasi Primer',
                    vaksin_reaksi: 'Nyeri lokal ringan di bekas suntikan. Tanpa demam.',
                    vaksin_rekomendasi: 'Jadwal Dosis ke-2 HPV dalam 2 bulan (Januari 2026). Pastikan tidak ada gejala berat dan istirahat cukup.'
                }
            },
            '6001': {
                category: 'mcu',
                layanan: 'Medical Checkup Full Body',
                pasien: 'Siti Aisyah',
                tanggal: '10 November 2025',
                data: {
                    mcu_vital: 'TD: 140/90 mmHg. Nadi: 88x/m. Suhu: 36.8°C.',
                    mcu_antropometri: 'BB: 78kg, TB: 165cm, IMT: 28.6 (Overweight).',
                    mcu_klinis: 'Konjungtiva anemis, Jantung dan Paru dalam batas normal. Pemeriksaan fisik lain normal.',
                    mcu_rontgen: 'Cor (Jantung) dan Pulmo (Paru) dalam batas normal (Normal).',
                    mcu_ekg: 'Sinus Rhythm, Normal Axis, HR 75x/m (Normal).',
                    mcu_usg: 'Hepar (Hati) tampak Echogenic (Fatty Liver Grade 1). Ginjal normal.',
                    mcu_panel_metabolisme: 'GDP: 140 mg/dL. Kolesterol Total: 250 mg/dL. Trigliserida: 180 mg/dL.',
                    mcu_fungsi_organ: 'SGPT: 60 U/L. Kreatinin: 1.0 mg/dL. Asam Urat: 6.5 mg/dL.',
                    mcu_diagnosa: 'Hipertensi Grade 1, Dislipidemia, Fatty Liver Grade 1. Status: Unfit with restriction (Modifikasi Gaya Hidup).',
                    mcu_rekomendasi: 'Konsultasi ke Spesialis Jantung (Hipertensi) dan Gizi (Diet). Perlu penurunan berat badan 5-10%. Ulang tes lab dan MCU 6 bulan lagi.'
                }
            },
        };

        // Data Dummy Detail Pasien (Mapping ke nama pasien)
        const patientDetails = {
            'Joko Purnomo': {
                dob: '15/03/1985',
                gender: 'Laki-laki',
                phone: '0812-3456-7890',
                address: 'Jl. Merdeka No. 45, Bandung'
            },
            'Karina Putri': {
                dob: '22/07/1997',
                gender: 'Perempuan',
                phone: '0857-1111-2222',
                address: 'Perumahan Indah Blok C10, Jakarta'
            },
            'Budi Santoso': {
                dob: '01/01/1970',
                gender: 'Laki-laki',
                phone: '0811-9999-8888',
                address: 'Jl. Kenanga Raya No. 12, Surabaya'
            },
            'Citra Dewi': {
                dob: '10/12/1990',
                gender: 'Perempuan',
                phone: '0878-5555-4444',
                address: 'Gg. Melati No. 5, Bogor'
            },
            'Doni Firmansyah': {
                dob: '29/02/1992',
                gender: 'Laki-laki',
                phone: '0813-7777-6666',
                address: 'Apartemen Green View, Lantai 15'
            },
            'Siti Aisyah': {
                dob: '05/04/1965',
                gender: 'Perempuan',
                phone: '0812-2345-6789',
                address: 'Jl. Pahlawan No. 7, Semarang'
            },
            'Fajar Riyadi': {
                dob: '18/09/2000',
                gender: 'Laki-laki',
                phone: '0815-4321-0987',
                address: 'Komplek Griya Asri Blok D3'
            },
            'Gita Melani': {
                dob: '03/06/2020',
                gender: 'Perempuan',
                phone: '0858-6666-5555',
                address: 'Jl. Pendidikan No. 20, Depok'
            },
            'Ali Fahmi': {
                dob: '11/11/1980',
                gender: 'Laki-laki',
                phone: '0811-1234-5678',
                address: 'Jl. Mawar No. 1, Yogyakarta'
            },
            'Rina Wijaya': {
                dob: '25/10/2023',
                gender: 'Perempuan',
                phone: '0817-8765-4321',
                address: 'Jalan Baru No. 8, Tangerang'
            },
        };


        // Alpine.js Data dan Logika
        function appointmentData() {

            const appointmentsData = [
                // DATA MENUNGGU REVIEW
                {
                    id: '0001',
                    pasien: 'Joko Purnomo',
                    layanan: 'Tes Darah',
                    display_layanan: 'Tes Darah',
                    category: 'lab',
                    status: 'Menunggu Review',
                    tanggal: '12 November 2025'
                },
                {
                    id: '0002',
                    pasien: 'Karina Putri',
                    layanan: 'Vaksin HPV',
                    display_layanan: 'Vaksin HPV',
                    category: 'vaksin',
                    status: 'Menunggu Review',
                    tanggal: '13 November 2025'
                },

                // DATA DIJADWALKAN
                {
                    id: '1001',
                    pasien: 'Budi Santoso',
                    layanan: 'Tes Darah',
                    display_layanan: 'Tes Darah',
                    category: 'lab',
                    status: 'Dijadwalkan',
                    tanggal: '08 November 2025'
                },
                {
                    id: '1002',
                    pasien: 'Citra Dewi',
                    layanan: 'Tes Hormon',
                    display_layanan: 'Tes Hormon',
                    category: 'lab',
                    status: 'Dijadwalkan',
                    tanggal: '09 November 2025'
                },
                {
                    id: '1003',
                    pasien: 'Doni Firmansyah',
                    layanan: 'Tes Urine',
                    display_layanan: 'Tes Urine',
                    category: 'lab',
                    status: 'Dijadwalkan',
                    tanggal: '09 November 2025'
                },
                {
                    id: '2001',
                    pasien: 'Siti Aisyah',
                    layanan: 'Medical Checkup Full Body',
                    display_layanan: 'Full Body',
                    category: 'mcu',
                    status: 'Dijadwalkan',
                    tanggal: '10 November 2025'
                },
                {
                    id: '3001',
                    pasien: 'Fajar Riyadi',
                    layanan: 'Vaksin HPV',
                    display_layanan: 'Vaksin HPV',
                    category: 'vaksin',
                    status: 'Dijadwalkan',
                    tanggal: '10 November 2025'
                },
                {
                    id: '3002',
                    pasien: 'Gita Melani',
                    layanan: 'Vaksin Rutin Anak/Bayi',
                    display_layanan: 'Vaksin Anak',
                    category: 'vaksin',
                    status: 'Dijadwalkan',
                    tanggal: '11 November 2025'
                },

                // DATA SELESAI
                {
                    id: '4001',
                    pasien: 'Ali Fahmi',
                    layanan: 'Tes Darah',
                    display_layanan: 'Tes Darah',
                    category: 'lab',
                    status: 'Selesai',
                    tanggal: '07 November 2025',
                    record_id: '4001'
                },
                {
                    id: '4002',
                    pasien: 'Doni Firmansyah',
                    layanan: 'Tes Urine',
                    display_layanan: 'Tes Urine',
                    category: 'lab',
                    status: 'Selesai',
                    tanggal: '09 November 2025',
                    record_id: '4002'
                },
                {
                    id: '4003',
                    pasien: 'Citra Dewi',
                    layanan: 'Tes Hormon',
                    display_layanan: 'Tes Hormon',
                    category: 'lab',
                    status: 'Selesai',
                    tanggal: '09 November 2025',
                    record_id: '4003'
                },
                {
                    id: '5001',
                    pasien: 'Rina Wijaya',
                    layanan: 'Vaksin Rutin Anak/Bayi',
                    display_layanan: 'Vaksin Anak',
                    category: 'vaksin',
                    status: 'Selesai',
                    tanggal: '11 November 2025',
                    record_id: '5001'
                },
                {
                    id: '5002',
                    pasien: 'Fajar Riyadi',
                    layanan: 'Vaksin HPV',
                    display_layanan: 'Vaksin HPV',
                    category: 'vaksin',
                    status: 'Selesai',
                    tanggal: '10 November 2025',
                    record_id: '5002'
                },
                {
                    id: '6001',
                    pasien: 'Siti Aisyah',
                    layanan: 'Medical Checkup Full Body',
                    display_layanan: 'Full Body',
                    category: 'mcu',
                    status: 'Selesai',
                    tanggal: '10 November 2025',
                    record_id: '6001'
                },

            ];

            return {
                appointments: appointmentsData,
                activeTab: 'all',
                isModalOpen: false,
                isCancelModalOpen: false,
                isShowResultModalOpen: false,
                isPatientDetailModalOpen: false,
                isApproveConfirmModalOpen: false,

                modal: {
                    id: '',
                    pasien: '',
                    layanan: '',
                    tanggal: '',
                    formType: '',
                    actionUrl: ''
                },
                patientDetail: {
                    nama: '',
                    dob: '',
                    gender: '',
                    phone: '',
                    address: ''
                },
                resultModal: {
                    id: '',
                    pasien: '',
                    layanan: '',
                    tanggal: '',
                    category: '',
                    data: {}
                },

                tabs: [{
                        id: 'all',
                        name: 'Semua',
                        icon: 'fas fa-list-ul'
                    },
                    {
                        id: 'lab',
                        name: 'Tes Laboratorium',
                        icon: 'fas fa-vial'
                    },
                    {
                        id: 'mcu',
                        name: 'Medical Checkup',
                        icon: 'fas fa-stethoscope'
                    },
                    {
                        id: 'vaksin',
                        name: 'Vaksinasi',
                        icon: 'fas fa-syringe'
                    },
                ],


                // Computed Property untuk memfilter data
                get filteredAppointments() {
                    if (this.activeTab === 'all') {
                        return this.appointments;
                    }
                    return this.appointments.filter(item => item.category === this.activeTab);
                },

                // Menentukan kelas Tailwind untuk status
                getStatusClasses(status) {
                    if (status.includes('Menunggu Review')) return 'bg-yellow-100 text-yellow-800';
                    if (status.includes('Dijadwalkan')) return 'bg-healya-primary/30 text-healya-dark font-semibold';
                    if (status.includes('Selesai')) return 'bg-green-100 text-green-800';
                    if (status.includes('Ditolak')) return 'bg-red-100 text-red-800';
                    return 'bg-gray-200 text-gray-700';
                },

                // Menentukan teks Layanan di tabel
                getLayananText(data) {
                    if (this.activeTab === 'all') {
                        let categoryText = '';
                        if (data.category === 'lab') categoryText = 'Tes Laboratorium';
                        else if (data.category === 'mcu') categoryText = 'Medical Checkup';
                        else if (data.category === 'vaksin') categoryText = 'Vaksinasi';
                        return `${data.layanan} (<span class="font-semibold text-healya-dark">${categoryText}</span>)`;
                    }
                    return data.display_layanan;
                },

                // Membuka Modal Detail Pasien
                openPatientDetailModal(id) {
                    const item = this.appointments.find(a => a.id === id);
                    if (!item) return;

                    const detail = patientDetails[item.pasien];
                    if (!detail) {
                        alert('Detail pasien tidak ditemukan untuk ' + item.pasien);
                        return;
                    }

                    this.patientDetail.nama = item.pasien;
                    this.patientDetail.dob = detail.dob;
                    this.patientDetail.gender = detail.gender;
                    this.patientDetail.phone = detail.phone;
                    this.patientDetail.address = detail.address;
                    this.isPatientDetailModalOpen = true;
                },

                // Membuka Modal Konfirmasi Approve
                openApproveConfirmModal(item) {
                    this.modal.id = item.id;
                    this.modal.pasien = item.pasien;
                    this.modal.layanan = item.layanan;
                    this.modal.tanggal = item.tanggal;
                    this.modal.actionUrl = `/clinic/appointments/${item.id}/update-status`;
                    this.isApproveConfirmModalOpen = true;
                },

                // Membuka Modal Pembatalan (Tolak)
                openCancelModal(item) {
                    this.modal.id = item.id;
                    this.modal.actionUrl = `/clinic/appointments/${item.id}/update-status`;
                    this.isCancelModalOpen = true;
                },

                // Membuka Modal Input Hasil (Mulai Tindakan)
                openRekamMedisModal(item) {
                    this.modal.id = item.id;
                    this.modal.pasien = item.pasien;
                    this.modal.layanan = item.layanan;
                    this.modal.tanggal = item.tanggal;

                    let targetForm = 'mcu';
                    const lowerLayanan = item.layanan.toLowerCase();

                    if (lowerLayanan.includes('checkup') || lowerLayanan.includes('full body')) {
                        targetForm = 'mcu';
                    } else if (lowerLayanan.includes('darah')) {
                        targetForm = 'tes_darah';
                    } else if (lowerLayanan.includes('urine')) {
                        targetForm = 'tes_urine';
                    } else if (lowerLayanan.includes('hormon')) {
                        targetForm = 'tes_hormon';
                    } else if (lowerLayanan.includes('hpv')) {
                        targetForm = 'vaksin_hpv';
                    } else if (lowerLayanan.includes('vaksin') && (lowerLayanan.includes('anak') || lowerLayanan.includes(
                            'bayi') || lowerLayanan.includes('rutin'))) {
                        targetForm = 'vaksin_anak';
                    }

                    this.modal.formType = targetForm;
                    this.isModalOpen = true;
                },

                // Membuka Modal Lihat Hasil (Rekam Medis)
                openShowResultModal(item) {
                    const record = medicalRecords[item.record_id];
                    if (!record) {
                        alert('Data rekam medis tidak ditemukan untuk ID: ' + item.record_id);
                        return;
                    }

                    this.resultModal.id = item.record_id;
                    this.resultModal.pasien = item.pasien;
                    this.resultModal.layanan = item.layanan;
                    this.resultModal.tanggal = item.tanggal;
                    this.resultModal.category = record.category;
                    this.resultModal.data = record.data;

                    this.isShowResultModalOpen = true;
                },


                // Generate Tombol Aksi
                getActionButtons(item) {
                    if (item.status === 'Selesai') {
                        return `<button type="button" @click="openShowResultModal(item)" class="text-sm font-medium text-healya-dark hover:text-healya-primary transition duration-150 border border-gray-300 py-1 px-3 rounded-lg"><i class="fas fa-eye mr-1"></i> Lihat Hasil</button>`;
                    }

                    if (item.status === 'Menunggu Review') {
                        // Tombol Approve (Membuka Modal Konfirmasi) dan Tolak (Membuka Modal Pembatalan)
                        return `
                            <button type="button" @click="openApproveConfirmModal(item)" class="text-sm font-medium text-white bg-healya-primary hover:bg-healya-primary/80 py-1 px-3 rounded-lg mr-2 transition duration-150">
                                <i class="fas fa-check-circle mr-1"></i> Approve
                            </button>
                            <button type="button" @click="openCancelModal(item)" class="text-sm font-medium text-white bg-red-500 hover:bg-red-600 py-1 px-3 rounded-lg transition duration-150">
                                <i class="fas fa-times mr-1"></i> Tolak
                            </button>
                        `;
                    }

                    if (item.status.includes('Dijadwal')) {
                        // Tombol Mulai Tindakan
                        return `
                            <button type="button" @click="openRekamMedisModal(item)" class="text-sm font-medium text-white bg-healya-secondary hover:bg-healya-secondary/80 py-1 px-3 rounded-lg transition duration-150">
                                <i class="fas fa-play mr-1"></i> Mulai Tindakan
                            </button>
                        `;
                    }

                    if (item.status.includes('Ditolak')) {
                        return `<span class="text-xs text-gray-500 italic">Dibatalkan Admin</span>`;
                    }

                    return '';
                }
            }
        }
    </script>
</body>

</html>
