@extends('Layout.main')
@section('isi')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.5); 
    }

    .modal-content {
        background-color: white;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 50%; 
        border-radius: 8px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover, .close:focus {
        color: black;
        text-decoration: none;
    }
</style>


<div class="container">
    <div class="main-artikel">
        <hr>
        <div class="tittle">
            Artikel
        </div>
        <div class="produk">
            @forelse ($artikel as $a)
                <div class="food">
                    <div class="gambar" style="background-color: grey;"></div>
                    <div class="jenis" style="color:black; font-size:20px;">
                        {{ $a->name }}
                        <div class="deskripsi" style="font-size:14px; color:grey;">
                            {{ Str::words($a->content, 3, '...') }}
                            <a href="#" class="open-modal" 
                               data-title="{{ $a->name }}" 
                               data-content="{{ $a->content }}" 
                               data-author="Jane Drinks" 
                               data-date="13 June 2023">
                                Click For More
                            </a>
                        </div>
                        <div class="loh" style="margin-bottom: 5px;">
                            @if ($a->categories->isEmpty())
                            <span class="text-danger">Belum di-setting</span>
                        @else
                            @foreach ($a->categories as $category)
                                <span class="badge bg-primary">{{ $category->kategori->name }}</span>
                            @endforeach
                        @endif
                        
                        @if ($a->tags->isEmpty())
                        <span class="text-danger">Belum di-setting</span>
                         @else
                            @foreach ($a->tags as $tag)
                                <span class="badge bg-success">{{ $tag->tag->name }}</span>
                            @endforeach
                       @endif
                    </div>
                        <div class="info">
                            <div class="cef">{{ $a->author->name }}</div>
                            <div class="cef">{{ \Carbon\Carbon::parse($a->created_at)->translatedFormat('d F Y') }}</div>
                        </div>
                        
                    </div>
                </div>
            @empty
                <p>Ga ada data</p>
            @endforelse
        </div>
        
        <!-- Modal Box (Hanya 1 Modal untuk Semua Artikel) -->
        <div id="modalBox" class="modal" style="display: none;">
            <div class="modal-content">
                <span id="closeModal" class="close">&times;</span>
                <h2 id="modalTitle"></h2>
                <p id="modalContent"></p>
                <div id="modalAuthor"></div>
                <div id="modalDate"></div>
            </div>
        </div>
        
        
        
    </div>

    <br><br>
    <div class="main-body1">
        <div class="bagian1">
            <div class="logo-headphone">
                <i class="fas fa-headphones"></i> Podcast Episode
            </div>
            <div class="judul">
                Dailiy Minute:Reports From around the world.
            </div>
            <div class="logo-play">
                <button class="play-button">
                    <i class="fas fa-play"></i>
                </button>
                <div class="logo-durasi">
                    <input type="range" class="timeline" min="0" max="135" value="0" step="22">
                    <span class="lama-durasi">02:15</span>
                </div>
            </div>
            <div class="news-card">
                <hr>
                <div class="gambar1">
                    <img src="img/kucing.jfif" alt="Kucing" />
                </div>
                <div class="judul-gambar">
                    News
                </div>
                <div class="deskripsi">
                    Lost cat found the way back to her home.
                </div>
                <div class="under-desc">
                    By Tom Jerry
                </div>
                <div class="date">
                    13 June 2023
                </div>
            </div>
        </div>
        <div class="bagian2">
            <div class="gambar2">
                <img src="img/kucing.jfif" alt="Kucing" />
            </div>
            <div class="jenis">
                Culture
            </div>
            <div class="judul2">
                Best summer reads for your vacation
            </div>
            <div class="deskripsi2">
                Summer is the perfect time to indulge in some leisurely reading, whether it's lying on the beach or lounging in the park. So if you're looking for a way to unwind this summer, why not pick up a few books and escape into some captivating stories?
            </div>
            <div class="author">
                RAD BOOKER
            </div>
            <div class="date2">
                13 June 2023
            </div>
        </div>
        <div class="bagian3">
            <div class="img3">
                <img src="img/kucing.jfif" alt="Kucing" />
            </div>
            <div class="jenis">
                SPORTS
            </div>
            <div class="judul3">
                Footballer leads Argentina to victory
            </div>
            <div class="author">
                Fred Baller
            </div>
            <div class="date">
                14 June 2023
            </div>
            <div class="img3">
                <img src="img/kucing.jfif" alt="Kucing" />
            </div>
            <div class="jenis">
                NEWS
            </div>
            <div class="judul3">
                Major cyberattack happened
            </div>
            <div class="author">
                Peter Computer
            </div>
            <div class="date">
                14 June 2023
            </div>
        </div>
    </div>
    <br><br>
    <div class="main-body2">
        <hr>
        <div class="tittle">
            Food And Drink
            <div class="seeall">
                see all
            </div>
        </div>
        <div class="produk">
            <div class="food">
                <img src="img/kucing.jfif" alt="Kucing" />
                <div class="jenis">
                    Drinks
                    <div class="deskripsi">
                        On a hunt for the best 
                    </div>
                    <div class="info">
                        <div class="cef">Jane Drinks</div>
                        <div class="date">13 June 2023</div>
                    </div>
                </div>
            </div>
            <div class="food">
                <img src="img/kucing.jfif" alt="Kucing" />
                <div class="jenis">
                    Food
                    <div class="deskripsi">
                        Shoreditch's best bodegas
                    </div>
                    <div class="info">
                        <div class="cef">Tony Hungry</div>
                        <div class="date">13 June 2023</div>
                    </div>
                </div>
            </div>
            <div class="food">
                <img src="img/kucing.jfif" alt="Kucing" />
                <div class="jenis">
                    Food
                    <div class="deskripsi">
                        Cooking on Budget
                    </div>
                    <div class="info">
                        <div class="cef">Tony Hungry</div>
                        <div class="date">13 June 2023</div>
                    </div>
                </div>
            </div>
            <div class="food">
                <img src="img/kucing.jfif" alt="Kucing" />
                <div class="jenis">
                    Drinks
                    <div class="deskripsi">
                        Best Alcohol-free cocktails
                    </div>
                    <div class="info">
                        <div class="cef">Jane Drinks</div>
                        <div class="date">13 June 2023</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-body3">
        <hr>
        <div class="tittle">
            Editor's Picks
        </div>
        <div class="articles">
            <div class="article-card">
                <div class="header">
                    <div class="number">1</div>
                    <img src="img/kucing.jfif" alt="Kucing" />
                </div>
                <div class="type">News</div>
                <div class="article">People are happy and healthy everywhere</div>
                <div class="author">Tom Jerry</div>
            </div>
            <div class="article-card">
                <div class="header">
                    <div class="number">2</div>
                    <img src="img/kucing.jfif" alt="Kucing" />
                </div>
                <div class="type">SPORTS</div>
                <div class="article">Life is beautiful and full of surprises</div>
                <div class="author">John Doe</div>
            </div>
            <div class="article-card">
                <div class="header">
                    <div class="number">3</div>
                    <img src="img/kucing.jfif" alt="Kucing" />
                </div>
                <div class="type">CULTURE</div>
                <div class="article">Adventure awaits those who seek it</div>
                <div class="author">Alice Smith</div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("modalBox");
        const closeModal = document.getElementById("closeModal");
        const modalTitle = document.getElementById("modalTitle");
        const modalContent = document.getElementById("modalContent");
        const modalAuthor = document.getElementById("modalAuthor");
        const modalDate = document.getElementById("modalDate");

        // Tambahkan event listener untuk semua link "Click For More"
        document.querySelectorAll('.open-modal').forEach(link => {
            link.addEventListener("click", (e) => {
                e.preventDefault();

                // Ambil data dari atribut data-*
                const title = link.getAttribute('data-title');
                const content = link.getAttribute('data-content');
                const author = link.getAttribute('data-author');
                const date = link.getAttribute('data-date');

                // Isi konten modal
                modalTitle.textContent = title;
                modalContent.textContent = content;
                modalAuthor.textContent = "Author: " + author;
                modalDate.textContent = "Date: " + date;

                // Tampilkan modal
                modal.style.display = "block";
            });
        });

        // Tutup modal saat tombol "X" diklik
        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });

        // Tutup modal saat klik di luar modal content
        window.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>

@endsection