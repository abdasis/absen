<table>
    <tbody>
        @foreach ($absens as $absen)
        <tr>
            <td>{{ $absen->nama }}</td>
            <td>{{ $absen->tanggal_absen }}</td>
            <td>
                @if (strtotime(Str::substr($absen->tanggal_absen, 11, 5)) < strtotime($absen->masuk))
                <div class="badge badge-success">Tepat Waktu</div>
            @else
                <div class="badge badge-warning">Telat</div>
            @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
