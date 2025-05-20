<x-filament-panels::page>

    <form wire:submit.prevent="callMounted">
        {{ $this->form }}
    </form>

    @php
        $days = $this->getDaysInMonth();
        $data = $this->getAttendanceData();
    @endphp

    <div class="relative overflow-x-auto shadow-md rounded-t-xl  mt-6">
        <table class="w-full text-sm text-left rtl:text-right text-blue-100">
            <thead class="text-xs text-white uppercase bg-gray-300">
            <tr>
                <th class="p-2 border border-gray-300 font-medium text-gray-700">DEPORTISTAS</th>
                @foreach ($days as $day)
                    <th class="p-2 border border-gray-300 font-medium text-gray-700 text-center">
                        {{ \Carbon\Carbon::parse($day)->format('d') }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="p-2 border border-gray-300 text-gray-800 text-xs">{{ $row['name'] }}</td>
                    @foreach ($days as $day)
                        <td class="p-2 border border-gray-300 text-center  {{ $row[$day] === '✓' ? 'bg-green-100 text-green-600' : '' }}">
                            {{ $row[$day] }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-filament-panels::page>
