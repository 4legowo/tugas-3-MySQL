document.addEventListener('DOMContentLoaded', () => {
    fetch('get_jadwal.php')
        .then(response => response.json())
        .then(data => {
            const lapanganListDiv = document.getElementById('lapangan-list');
            data.lapangan.forEach(lapangan => {
                const card = document.createElement('div');
                card.classList.add('lapangan-card');
                card.innerHTML = `
                    <h2>${lapangan.nama_lapangan}</h2>
                    <p>${lapangan.deskripsi || 'Tidak ada deskripsi.'}</p>
                    <p>Harga: Rp ${lapangan.harga_per_jam} / jam</p>
                    <h3>Jadwal Hari Ini:</h3>
                    <ul class="jadwal-list" id="jadwal-${lapangan.id_lapangan}">
                        <!-- Jadwal akan dimuat di sini -->
                    </ul>
                `;
                lapanganListDiv.appendChild(card);

                const jadwalListUl = document.getElementById(`jadwal-${lapangan.id_lapangan}`);
                const bookings = data.booking.filter(b => b.id_lapangan == lapangan.id_lapangan);
                if (bookings.length > 0) {
                    bookings.forEach(booking => {
                        const jadwalItem = document.createElement('li');
                        jadwalItem.classList.add('jadwal-item');
                        jadwalItem.textContent = `${booking.jam_mulai} - ${booking.jam_selesai}`;
                        jadwalListUl.appendChild(jadwalItem);
                    });
                } else {
                    jadwalListUl.innerHTML = '<li>Belum ada booking hari ini.</li>';
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});