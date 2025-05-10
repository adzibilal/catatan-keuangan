<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CatatKeuangan - Aplikasi Pencatatan Keuangan Pribadi</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,600,700" rel="stylesheet" />
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex-shrink-0">
                    <a href="#" class="text-2xl font-bold text-blue-600 dark:text-blue-400">CatatKeuangan</a>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="py-12 sm:py-16 bg-gradient-to-br from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-full py-8">
                    <h1 class="text-4xl sm:text-5xl font-bold mb-6">Kelola Keuangan Dengan Mudah</h1>
                    <p class="text-xl mb-8">Aplikasi pencatatan keuangan yang membantu Anda melacak dan mengelola keuangan pribadi dengan cara yang sederhana dan efektif.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-blue-600 font-medium rounded-md shadow hover:bg-gray-100 transition-colors duration-300">Mulai Sekarang</a>
                        <a href="#fitur" class="px-6 py-3 bg-transparent border border-white text-white font-medium rounded-md hover:bg-white/10 transition-colors duration-300">Lihat Fitur</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Fitur Utama</h2>
                <p class="mt-4 text-xl text-gray-600 dark:text-gray-300">Berbagai kemudahan yang kami tawarkan untuk pengelolaan keuangan Anda</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-lg mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Catat Transaksi</h3>
                    <p class="text-gray-600 dark:text-gray-300">Catat setiap pemasukan dan pengeluaran dengan cepat dan mudah.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-lg mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Laporan Keuangan</h3>
                    <p class="text-gray-600 dark:text-gray-300">Lihat ringkasan keuangan dalam bentuk grafik yang mudah dipahami.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-lg mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Kategorisasi</h3>
                    <p class="text-gray-600 dark:text-gray-300">Kelompokkan transaksi berdasarkan kategori untuk analisis lebih baik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Apa Kata Pengguna</h2>
                <p class="mt-4 text-xl text-gray-600 dark:text-gray-300">Pengalaman mereka menggunakan aplikasi CatatKeuangan</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 dark:text-blue-300 font-bold">BS</span>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Budi Santoso</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Pengusaha</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">"Aplikasi ini sangat membantu saya mengelola keuangan dengan lebih rapi. Sekarang saya tahu dengan jelas pengeluaran terbesar saya."</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 dark:text-blue-300 font-bold">AN</span>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Ani Nurhayati</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Ibu Rumah Tangga</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">"Sederhana dan mudah digunakan. Saya jadi lebih bisa mengontrol pengeluaran bulanan keluarga kami."</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 dark:text-blue-300 font-bold">DP</span>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Dewi Putri</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Mahasiswa</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">"Sebagai mahasiswa, aplikasi ini sangat membantu saya mengatur uang bulanan. Fitur kategori membantu saya melihat pada apa uang saya habis."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-br from-blue-600 to-indigo-700 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Mulai Kelola Keuangan Anda Sekarang</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Daftar gratis dan rasakan manfaat mencatat keuangan Anda dengan teratur. Ambil kontrol atas keuangan Anda hari ini!</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-blue-600 font-medium rounded-md shadow hover:bg-gray-100 transition-colors duration-300">Daftar Gratis</a>
                <a href="{{ route('login') }}" class="px-8 py-3 bg-transparent border border-white text-white font-medium rounded-md hover:bg-white/10 transition-colors duration-300">Login</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:order-2 space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-base text-gray-500">&copy; 2023 CatatKeuangan. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> 