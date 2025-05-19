<x-filament-panels::page>

        <form wire:submit.prevent="callMounted">
            {{ $this->form }}
        </form>

        @php
            $days = $this->getDaysInMonth();
            $data = $this->getAttendanceData();
        @endphp

        <div class="overflow-auto mt-6">
            <table class="w-full text-sm text-left border">
                <thead>
                <tr>
                    <th class="p-2 border">Estudiante</th>
                    @foreach ($days as $day)
                        <th class="p-2 border">{{ \Carbon\Carbon::parse($day)->format('d') }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td class="p-2 border">{{ $row['name'] }}</td>
                        @foreach ($days as $day)
                            <td class="p-2 border text-center">{{ $row[$day] }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


</x-filament-panels::page>
