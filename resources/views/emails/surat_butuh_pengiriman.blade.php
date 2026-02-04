<p>Ada surat baru yang menunggu pengiriman.</p>
<p><strong>Perihal:</strong> {{ $surat->perihal ?? '-' }}</p>
<p><strong>Karyawan:</strong> {{ $surat->user->name ?? '-' }}</p>
<p><a href="{{ url('/admin/surat') }}">Buka Daftar Surat</a></p>
