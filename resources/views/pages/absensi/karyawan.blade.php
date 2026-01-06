<x-sidetop role="karyawan" title="Absensi Saya">
    <div class="space-y-6" x-data="absensiCalendar()">
        <!-- Summary Card (Posisi Atas) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Hadir</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" x-text="summary.hadir"></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Alpha</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" x-text="summary.alpha"></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Persentase Hadir</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" x-text="summary.percentage + '%'"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kalender Container -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Header Bulan & Navigasi -->
            <div class="p-6 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Kalender Absensi</h2>
                <div class="flex items-center gap-4">
                    <button @click="previousMonth()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <span class="text-lg font-semibold min-w-[150px] text-center" x-text="currentMonthYear"></span>
                    <button @click="nextMonth()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <!-- Grid Kalender -->
            <div class="bg-gray-200 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                
                <!-- Nama Hari -->
                <div class="grid grid-cols-7 gap-px text-center bg-gray-50 dark:bg-gray-800">
                    <template x-for="day in ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']" :key="day">
                        <div class="py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            <span class="hidden sm:inline" x-text="day"></span>
                            <span class="sm:hidden" x-text="day.substring(0, 3)"></span>
                        </div>
                    </template>
                </div>

                <!-- Tanggal -->
                <div class="grid grid-cols-7 gap-px bg-gray-200 dark:bg-gray-700">
                    <template x-for="date in calendarDates" :key="date.dateString">
                        <div class="min-h-[100px] p-2 bg-white dark:bg-gray-800 relative transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <!-- Tanggal Badge -->
                            <div class="flex justify-between items-start">
                                <span class="w-7 h-7 flex items-center justify-center rounded-full text-sm font-medium"
                                    :class="{
                                        'bg-blue-600 text-white': date.isToday,
                                        'text-gray-900 dark:text-white': date.isCurrentMonth && !date.isToday,
                                        'text-gray-400 dark:text-gray-600': !date.isCurrentMonth
                                    }" 
                                    x-text="date.day"></span>
                            </div>

                            <!-- Status Badges -->
                            <div class="mt-2 space-y-1" x-show="date.isCurrentMonth">
                                <template x-if="date.isSunday">
                                    <div class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-1 rounded text-center font-medium">Libur</div>
                                </template>
                                
                                <template x-if="!date.isSunday && date.hasAttendance">
                                    <div class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs px-2 py-1 rounded text-center font-medium">Hadir</div>
                                </template>
                                
                                <template x-if="!date.isSunday && !date.hasAttendance && date.isPast">
                                    <div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs px-2 py-1 rounded text-center font-medium">Alpha</div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        function absensiCalendar() {
            return {
                currentDate: new Date(),
                attendanceData: @json($attendanceData ?? []),
                
                get currentMonthYear() {
                    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    return `${months[this.currentDate.getMonth()]} ${this.currentDate.getFullYear()}`;
                },
                
                get calendarDates() {
                    const year = this.currentDate.getFullYear();
                    const month = this.currentDate.getMonth();
                    const firstDay = new Date(year, month, 1);
                    const lastDay = new Date(year, month + 1, 0);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    
                    // Adjust for Monday start (0 = Monday, 6 = Sunday)
                    let startDay = firstDay.getDay() - 1;
                    if (startDay === -1) startDay = 6;
                    
                    const dates = [];
                    
                    // Previous month dates
                    const prevMonthLastDay = new Date(year, month, 0);
                    for (let i = startDay - 1; i >= 0; i--) {
                        const date = new Date(year, month - 1, prevMonthLastDay.getDate() - i);
                        dates.push(this.createDateObject(date, false));
                    }
                    
                    // Current month dates
                    for (let i = 1; i <= lastDay.getDate(); i++) {
                        const date = new Date(year, month, i);
                        dates.push(this.createDateObject(date, true));
                    }
                    
                    // Next month dates
                    const remainingDays = 42 - dates.length; // 6 weeks
                    for (let i = 1; i <= remainingDays; i++) {
                        const date = new Date(year, month + 1, i);
                        dates.push(this.createDateObject(date, false));
                    }
                    
                    return dates;
                },
                
                createDateObject(date, isCurrentMonth) {
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const dateString = date.toISOString().split('T')[0];
                    
                    return {
                        day: date.getDate(),
                        dateString: dateString,
                        isCurrentMonth: isCurrentMonth,
                        isToday: date.getTime() === today.getTime(),
                        isPast: date < today,
                        isSunday: date.getDay() === 0,
                        hasAttendance: this.attendanceData.includes(dateString)
                    };
                },
                
                get summary() {
                    const dates = this.calendarDates.filter(d => d.isCurrentMonth && !d.isSunday && d.isPast);
                    const hadir = dates.filter(d => d.hasAttendance).length;
                    const alpha = dates.filter(d => !d.hasAttendance).length;
                    const percentage = dates.length > 0 ? Math.round((hadir / dates.length) * 100) : 0;
                    
                    return { hadir, alpha, percentage };
                },
                
                previousMonth() {
                    this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
                    this.fetchAttendanceData();
                },
                
                nextMonth() {
                    this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
                    this.fetchAttendanceData();
                },
                
                fetchAttendanceData() {
                    // Fetch attendance data for current month via AJAX
                    const year = this.currentDate.getFullYear();
                    const month = this.currentDate.getMonth() + 1;
                    
                    fetch(`/karyawan/absensi/data?year=${year}&month=${month}`)
                        .then(response => response.json())
                        .then(data => {
                            this.attendanceData = data.attendanceData || [];
                        })
                        .catch(error => console.error('Error fetching attendance data:', error));
                }
            }
        }
    </script>
</x-sidetop>