<x-filament-panels::page>

    <form wire:submit.prevent="callMounted">
        {{ $this->form }}
    </form>

    <div class="flex justify-end space-x-2 mb-4 gap-2">
        <x-filament::button wire:click="exportToPdf" color="danger" class="px-4 py-2">
            Exportar a PDF
        </x-filament::button>

        <x-filament::button wire:click="exportToExcel" color="present" class="px-4 py-2">
            Exportar a Excel
        </x-filament::button>
    </div>

    @php
        $days = $this->getDaysInMonth();
        $data = $this->getAttendanceData();
    @endphp

    <div class="relative overflow-x-auto shadow-md rounded-t-xl  mt-6">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs text-white uppercase bg-gray-300">
            <tr>
                <th class="p-2 border border-gray-300 font-medium text-gray-700">DEPORTISTAS</th>
                @foreach ($days as $day)
                    <th class="p-2 border border-gray-300 font-medium text-gray-700 text-center text-xs">
                        {{ \Carbon\Carbon::parse($day)->locale('es')->isoFormat('dd') }}
                        <br>
                        {{ \Carbon\Carbon::parse($day)->format('d') }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
                <tr>
                    <td class="p-2 border border-gray-300 text-xs">{{ $row['name'] }}</td>
                    @foreach ($days as $day)
                        <td class="p-2 border border-gray-300 text-center {{ $row[$day] == '✓' ? 'text-danger-600' : ($row[$day] == '✗' ? 'text-green-600' : '') }}">
                            {{ $row[$day] }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>





</x-filament-panels::page>
