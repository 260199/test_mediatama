<link rel="stylesheet" href="css/style.css">
<div class="body">
    <div class="container">
        <div class="dashboard-header">
            <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
            <p>Ini adalah dashboard Anda. Anda dapat mengelola artikel, pengaturan akun, dan lainnya dari sini.</p>
        </div>

        <div class="dashboard-content">
            <!-- Artikel Card -->
            <div class="card" id="artikelCard">
                <h3>Jumlah Artikel</h3>
                <p>{{ $artikelCount }} Artikel Terdaftar</p>
            </div>

            <!-- Author Card -->
            <div class="card" id="authorCard">
                <h3>Author</h3>
                <p>{{ $authorCount }} author Terdaftar</p>
            </div>

            <!-- Kategori Card -->
            <div class="card" id="kategoriCard">
                <h3>Jumlah Kategori</h3>
                <p>{{ $kategoriCount }} Kategori Terdaftar</p>
            </div>

            <!-- Tag Card -->
            <div class="card" id="tagCard">
                <h3>Jumlah Tag</h3>
                <p>{{ $tagCount }} tag Terdaftar</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure for Artikel -->
<div id="artikelModal" class="modal">
    <div class="modal-content">
        <h4>Artikel Details</h4>
        <table id="artikelTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Artikel</th>
                    <th>Penulis</th>
                    <th>Created At</th> <!-- Kolom Created At -->
                </tr>
            </thead>
            <tbody id="artikelTableBody">
                <!-- Data Artikel akan ditampilkan disini -->
            </tbody>
        </table>
        <div class="kelola-container">
            <a href="{{ url('artikel') }}" class="kelola-btn">Kelola Data Artikel</a>
        </div>
    </div>
    <button class="close-btn">Close</button>
</div>

<!-- Modal Structure for Author -->
<div id="authorModal" class="modal">
    <div class="modal-content">
        <h4>Author Details</h4>
        <table id="authorTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Author</th>
                    <th>Email</th>
                    <th>Created At</th> <!-- Kolom Created At -->
                </tr>
            </thead>
            <tbody id="authorTableBody">
                <!-- Data Author akan ditampilkan disini -->
            </tbody>
        </table>
        <div class="kelola-container">
            <a href="{{ url('author') }}" class="kelola-btn">Kelola Data Author</a>
        </div>
    </div>
    <button class="close-btn">Close</button>
</div>

<!-- Modal Structure for Kategori -->
<div id="kategoriModal" class="modal">
    <div class="modal-content">
        <h4>Kategori Details</h4>
        <table id="kategoriTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Created At</th> <!-- Kolom Created At -->
                </tr>
            </thead>
            <tbody id="kategoriTableBody">
                <!-- Data Kategori akan ditampilkan disini -->
            </tbody>
        </table>
        <div class="kelola-container">
            <a href="{{ url('kategori') }}" class="kelola-btn">Kelola Data Kategori</a>
        </div>
    </div>
    <button class="close-btn">Close</button>
</div>

<!-- Modal Structure for Tag -->
<div id="tagModal" class="modal">
    <div class="modal-content">
        <h4>Tag Details</h4>
        <table id="tagTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tag</th>
                    <th>Created At</th> <!-- Kolom Created At -->
                </tr>
            </thead>
            <tbody id="tagTableBody">
                <!-- Data Tag akan ditampilkan disini -->
            </tbody>
        </table>
        <div class="kelola-container">
            <a href="{{ url('tag') }}" class="kelola-btn">Kelola Data Tag</a>
        </div>
    </div>
    <button class="close-btn">Close</button>
</div>

<script>
    // Ambil data untuk artikel, kategori, tag, dan author dari Laravel
    const artikel = @json($artikel);  // Data artikel dalam format JSON
    const kategori = @json($kategori); // Data kategori
    const tag = @json($tag); // Data tag
    const authors = @json($authors); // Data authors

    // Ambil elemen-elemen modal
    const artikelCard = document.getElementById('artikelCard');
    const kategoriCard = document.getElementById('kategoriCard');
    const tagCard = document.getElementById('tagCard');
    const authorCard = document.getElementById('authorCard');
    const modalElements = document.querySelectorAll('.modal');
    const closeBtns = document.querySelectorAll('.close-btn');

    function showModal(modalId, tableBodyId, data, columns) {
        const modal = document.getElementById(modalId);
        const tableBody = document.getElementById(tableBodyId);
        tableBody.innerHTML = ''; // Bersihkan tabel sebelumnya

        if (data.length === 0) {
            const row = document.createElement('tr');
            const cell = document.createElement('td');
            cell.colSpan = columns.length; // Tidak perlu kolom Aksi lagi
            cell.textContent = 'No Data';
            row.appendChild(cell);
            tableBody.appendChild(row);
        } else {
            data.forEach(function (item, index) {
                const row = document.createElement('tr');

                // Kolom Nomor
                const noCell = document.createElement('td');
                noCell.textContent = index + 1;
                row.appendChild(noCell);

                // Kolom Data
                columns.forEach(function (col) {
                    const cell = document.createElement('td');

                    if (col === 'created_at') {
                        cell.textContent = new Date(item[col]).toLocaleString(); // Format Tanggal
                    } else if (col === 'author.name') {
                        cell.textContent = item.author ? item.author.name : 'No Author';
                    } else {
                        cell.textContent = item[col];
                    }

                    row.appendChild(cell);
                });

                tableBody.appendChild(row);
            });
        }

        modal.style.display = 'flex';
    }

    artikelCard.addEventListener('click', function () {
        showModal('artikelModal', 'artikelTableBody', artikel, ['name', 'author.name', 'created_at']);
    });

    kategoriCard.addEventListener('click', function () {
        showModal('kategoriModal', 'kategoriTableBody', kategori, ['name', 'created_at']);
    });

    tagCard.addEventListener('click', function () {
        showModal('tagModal', 'tagTableBody', tag, ['name', 'created_at']);
    });

    authorCard.addEventListener('click', function () {
        showModal('authorModal', 'authorTableBody', authors, ['name', 'email', 'created_at']);
    });

    // Event listener untuk menutup modal
    closeBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            modalElements.forEach(function(modal) {
                modal.style.display = 'none';
            });
        });
    });

    // Menutup modal jika klik di luar konten modal
    window.addEventListener('click', function(event) {
        if (modalElements.some(modal => event.target === modal)) {
            modalElements.forEach(function(modal) {
                modal.style.display = 'none';
            });
        }
    });
</script>   