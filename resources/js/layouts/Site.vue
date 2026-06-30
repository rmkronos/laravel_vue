<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
<div class="min-h-screen flex flex-col">
    <!-- Barra de Navegação -->
    <nav class="bg-white shadow p-4 flex gap-4">
      <Link href="/home" class="text-blue-600 font-bold">Home</Link>
      <Link href="/sobre" class="text-gray-600">Sobre</Link>
      <Link href="/contato" class="text-gray-600">Contato</Link>
    </nav>

    <!-- Conteúdo Dinâmico das Páginas -->
  <main class="flex-grow bg-gray-100 p-8">
    <slot />
  </main>
  <footer class="bg-gray-900 text-gray-300 py-12 px-6 font-sans">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <!-- Coluna 1: Sobre / Marca -->
        <div class="flex flex-col gap-4">
            <h2 class="text-white text-xl font-bold tracking-wider">SUA MARCA</h2>
            <p class="text-sm leading-relaxed text-gray-400">
                Criando soluções digitais inovadoras para impulsionar o seu negócio rumo ao futuro.
            </p>
        </div>

        <!-- Coluna 2: Links Úteis -->
        <div>
            <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Empresa</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-white transition-colors duration-200">Sobre Nós</a></li>
                <li><a href="#" class="hover:text-white transition-colors duration-200">Carreiras</a></li>
                <li><a href="#" class="hover:text-white transition-colors duration-200">Blog</a></li>
            </ul>
        </div>

        <!-- Coluna 3: Suporte -->
        <div>
            <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Suporte</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-white transition-colors duration-200">Ajuda & FAQ</a></li>
                <li><a href="#" class="hover:text-white transition-colors duration-200">Contato</a></li>
                <li><a href="#" class="hover:text-white transition-colors duration-200">Privacidade</a></li>
            </ul>
        </div>

        <!-- Coluna 4: Newsletter / Redes Sociais -->
        <div class="flex flex-col gap-4">
            <h3 class="text-white font-semibold text-sm uppercase tracking-wider">Nossa Newsletter</h3>
            <div class="flex flex-col sm:flex-row gap-2">
                <input type="email" placeholder="Seu e-mail" class="bg-gray-800 text-white px-4 py-2 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" />
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium transition-colors duration-200">
                    Assinar
                </button>
            </div>
        </div>

    </div>

    <!-- Barra Inferior de Direitos Autorais -->
    <div class="max-w-7xl mx-auto border-t border-gray-800 mt-12 pt-6 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
        <p>&copy; 2026 Sua Marca. Todos os direitos reservados.</p>
        <div class="flex gap-4">
            <a href="#" class="hover:text-gray-300">Termos de Uso</a>
            <a href="#" class="hover:text-gray-300">Cookies</a>
        </div>
    </div>
  </footer>

</div>
</template>