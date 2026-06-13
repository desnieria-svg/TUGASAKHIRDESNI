@props(['judul', 'nilai', 'ikon', 'warna' => 'blue'])

<div class="stat-card stat-{{ $warna }}">
    <div class="stat-icon">{{ $ikon }}</div>
    <div class="stat-info">
        <p class="stat-judul">{{ $judul }}</p>
        <h3 class="stat-nilai">{{ $nilai }}</h3>
    </div>
</div>
