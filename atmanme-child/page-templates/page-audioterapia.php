<?php
/* Template Name: Audioterapia */
get_header(); ?>
<main id="primary" class="site-main">

<style>
/* Scoped styles for Audioterapia landing page */
.audioterapia-hero {
text-align: center;
padding: 80px 20px;
background-color: var(--atmanme-color-bg);
border-bottom: 1px solid rgba(0,0,0,0.05);
}
.audioterapia-hero h1 {
margin-bottom: 20px;
}
.audioterapia-hero p {
font-size: 1.2rem;
margin-bottom: 40px;
color: var(--atmanme-color-text);
}
.audioterapia-hero-image {
max-width: 600px;
width: 100%;
border-radius: 8px;
box-shadow: 0 10px 15px rgba(0,0,0,0.1);
margin-bottom: 40px;
}
.audio-player-container {
margin: 0 auto 30px;
max-width: 500px;
background: var(--atmanme-color-white);
padding: 20px;
border-radius: 8px;
box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}
.audio-player-container h3 {
margin-top: 0;
margin-bottom: 15px;
font-size: 1.2rem;
}
.audio-player-container audio {
width: 100%;
outline: none;
}

.catalog-section {
padding: 60px 20px;
max-width: 1200px;
margin: 0 auto;
}
.catalog-category {
margin-bottom: 50px;
}
.catalog-category h3 {
margin-bottom: 20px;
border-bottom: 2px solid var(--atmanme-color-accent);
display: inline-block;
padding-bottom: 5px;
}
.catalog-grid {
display: grid;
grid-template-columns: 1fr;
gap: 30px;
}
@media (min-width: 768px) {
.catalog-grid {
grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}
}
.track-thumbnail {
background-color: var(--atmanme-color-primary);
color: var(--atmanme-color-accent);
height: 160px;
display: flex;
align-items: center;
justify-content: center;
font-size: 4rem;
border-radius: 4px;
margin-bottom: 15px;
}
.track-info {
margin-bottom: 15px;
}
.track-title {
font-size: 1.2rem;
font-weight: bold;
color: var(--atmanme-color-primary);
margin: 0 0 5px;
}
.track-meta {
font-size: 0.9rem;
color: #666;
}

.science-section {
background-color: var(--atmanme-color-white);
padding: 60px 20px;
border-top: 1px solid rgba(0,0,0,0.05);
border-bottom: 1px solid rgba(0,0,0,0.05);
}
.science-content {
max-width: 800px;
margin: 0 auto;
}
.science-content p {
margin-bottom: 20px;
line-height: 1.8;
}
.citation-box {
background-color: var(--atmanme-color-bg);
border-left: 4px solid var(--atmanme-color-accent);
padding: 15px 20px;
margin-bottom: 20px;
font-style: italic;
border-radius: 0 4px 4px 0;
}

.offer-section {
padding: 80px 20px;
max-width: 1000px;
margin: 0 auto;
}
.offer-grid {
display: grid;
grid-template-columns: 1fr;
gap: 40px;
}
@media (min-width: 768px) {
.offer-grid {
grid-template-columns: 1fr 1fr;
}
}
.offer-card {
background-color: var(--atmanme-color-white);
border: 2px solid var(--atmanme-color-accent);
border-radius: 8px;
padding: 40px 30px;
text-align: center;
box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}
.offer-card.premium {
background-color: var(--atmanme-color-primary);
border-color: var(--atmanme-color-primary);
color: var(--atmanme-color-white);
}
.offer-card.premium h3, .offer-card.premium p {
color: var(--atmanme-color-white);
}
.offer-card h3 {
font-size: 1.8rem;
margin-bottom: 15px;
margin-top: 0;
}
.offer-price {
font-size: 2.5rem;
font-weight: bold;
font-family: var(--atmanme-font-heading);
margin-bottom: 20px;
}
.offer-features {
list-style: none;
padding: 0;
margin: 0 0 30px;
text-align: left;
}
.offer-features li {
margin-bottom: 10px;
padding-left: 25px;
position: relative;
}
.offer-features li::before {
content: '✓';
color: var(--atmanme-color-accent);
position: absolute;
left: 0;
font-weight: bold;
}

/* Utility */
html {
scroll-behavior: smooth;
}
</style>

<div class="audioterapia-page">

<!-- Hero Section -->
<section class="audioterapia-hero">
<h1 class="page-title">Audioterapia & Frecuencias para el Alma</h1>
<p>Eleva tu vibración, mejora tu enfoque y encuentra la paz con nuestra biblioteca de sonidos guiados.</p>

<img src="https://atmanme.com/wp-content/uploads/2026/07/hero-3.png" alt="Ilustración de dos personas meditando con auriculares rodeadas de símbolos de chakras y un cuenco tibetano" class="audioterapia-hero-image">

<div class="audio-player-container">
<h3>Muestra: Viaje a la Calma Interior</h3>
<!-- TODO: replace src with real sample audio from media library -->
<audio controls class="hero-audio track-play-btn" data-track-name="Muestra: Viaje a la Calma Interior">
<source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
Tu navegador no soporta el elemento de audio.
</audio>
</div>

<a href="#catalogo" class="atmanme-btn cta-scroll">Explorar catálogo</a>
</section>

<!-- Catalog Section -->
<section id="catalogo" class="catalog-section">
<h2 class="atmanme-section-header">Catálogo de Frecuencias</h2>

<!-- Categoría: Sueño -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Sueño Profundo</span></h3>
<div class="catalog-grid">
<?php
// Mock tracks for Sueño
$sueno_tracks = [
['title' => 'Ondas Delta para Insomnio', 'duration' => '60 min', 'icon' => '🌙'],
['title' => 'Relajación Guiada Nocturna', 'duration' => '45 min', 'icon' => '🛌'],
['title' => 'Lluvia y Cuencos Tibetanos', 'duration' => '90 min', 'icon' => '🌧️']
];
foreach ($sueno_tracks as $track) {
?>
<article class="atmanme-blog-card">
<!-- TODO: Replace background and emoji with real thumbnails -->
<div class="track-thumbnail">
<?php echo $track['icon']; ?>
</div>
<div class="track-info">
<h4 class="track-title"><?php echo $track['title']; ?></h4>
<span class="track-meta">Duración: <?php echo $track['duration']; ?></span>
</div>
<!-- TODO: replace src with real sample audio from media library for this specific track -->
<audio controls class="track-play-btn" style="width: 100%; height: 40px;" data-track-name="<?php echo $track['title']; ?>">
<source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
</audio>
</article>
<?php
}
?>
</div>
</div>

<!-- Categoría: Enfoque -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Enfoque y Productividad</span></h3>
<div class="catalog-grid">
<?php
$enfoque_tracks = [
['title' => 'Ondas Gamma para Estudio', 'duration' => '120 min', 'icon' => '🧠'],
['title' => 'Frecuencia de Flujo (Flow State)', 'duration' => '60 min', 'icon' => '⚡'],
['title' => 'Ruido Marrón para TDAH', 'duration' => '180 min', 'icon' => '🎯']
];
foreach ($enfoque_tracks as $track) {
?>
<article class="atmanme-blog-card">
<div class="track-thumbnail">
<?php echo $track['icon']; ?>
</div>
<div class="track-info">
<h4 class="track-title"><?php echo $track['title']; ?></h4>
<span class="track-meta">Duración: <?php echo $track['duration']; ?></span>
</div>
<audio controls class="track-play-btn" style="width: 100%; height: 40px;" data-track-name="<?php echo $track['title']; ?>">
<source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
</audio>
</article>
<?php
}
?>
</div>
</div>

<!-- Categoría: Sanación -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Sanación y Equilibrio</span></h3>
<div class="catalog-grid">
<?php
$sanacion_tracks = [
['title' => 'Alineación de Chakras (Solfeggio)', 'duration' => '45 min', 'icon' => '🧘'],
['title' => '432 Hz - El Tono del Universo', 'duration' => '60 min', 'icon' => '🌿'],
['title' => 'Liberación de Trauma Emocional', 'duration' => '30 min', 'icon' => '💖']
];
foreach ($sanacion_tracks as $track) {
?>
<article class="atmanme-blog-card">
<div class="track-thumbnail">
<?php echo $track['icon']; ?>
</div>
<div class="track-info">
<h4 class="track-title"><?php echo $track['title']; ?></h4>
<span class="track-meta">Duración: <?php echo $track['duration']; ?></span>
</div>
<audio controls class="track-play-btn" style="width: 100%; height: 40px;" data-track-name="<?php echo $track['title']; ?>">
<source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
</audio>
</article>
<?php
}
?>
</div>
</div>

<!-- Categoría: Frecuencias -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Frecuencias Binaurales</span></h3>
<div class="catalog-grid">
<?php
$frecuencias_tracks = [
['title' => 'Ondas Theta para Meditación', 'duration' => '40 min', 'icon' => '🌌'],
['title' => '528 Hz - Reparación de ADN', 'duration' => '60 min', 'icon' => '🧬'],
['title' => 'Viaje Astral y Sueños Lúcidos', 'duration' => '90 min', 'icon' => '✨']
];
foreach ($frecuencias_tracks as $track) {
?>
<article class="atmanme-blog-card">
<div class="track-thumbnail">
<?php echo $track['icon']; ?>
</div>
<div class="track-info">
<h4 class="track-title"><?php echo $track['title']; ?></h4>
<span class="track-meta">Duración: <?php echo $track['duration']; ?></span>
</div>
<audio controls class="track-play-btn" style="width: 100%; height: 40px;" data-track-name="<?php echo $track['title']; ?>">
<source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
</audio>
</article>
<?php
}
?>
</div>
</div>
</section>

<!-- Science Section -->
<section class="science-section">
<div class="science-content">
<h2 class="atmanme-section-header">El Poder del Sonido en el Cerebro</h2>

<p>La audioterapia y las frecuencias binaurales no son solo conceptos espirituales; tienen bases en la neuroplasticidad y la forma en que nuestro cerebro procesa los estímulos auditivos. Al escuchar tonos ligeramente diferentes en cada oído, el cerebro compensa creando una tercera frecuencia "fantasma" que fomenta cambios en los patrones de ondas cerebrales (entrenamiento de ondas cerebrales).</p>

<div class="citation-box">
<p><strong>TODO: verificar fuente</strong> "La sincronización de ondas cerebrales a través de frecuencias binaurales puede facilitar estados de relajación profunda, reducir la ansiedad y mejorar funciones cognitivas al estimular redes neuronales específicas." - [Espacio para cita de investigación neurológica real]</p>
</div>

<p>Dependiendo de la frecuencia elegida (como las ondas Alfa para la relajación o Gamma para el procesamiento cognitivo superior), podemos guiar nuestra mente hacia estados de consciencia deseados, promoviendo el bienestar emocional, una mejor calidad de sueño y una mayor capacidad de concentración.</p>

<div class="citation-box">
<p><strong>TODO: verificar fuente</strong> "La exposición regular a frecuencias sonoras terapéuticas ha demostrado promover la neuroplasticidad, ayudando en el manejo del estrés crónico y mejorando la calidad del sueño reparador." - [Espacio para cita de estudio sobre sueño/estrés real]</p>
</div>
</div>
</section>

<!-- Offer Section -->
<section class="offer-section">
<h2 class="atmanme-section-header">Comienza tu Viaje Sonoro</h2>

<div class="offer-grid">
<!-- Individual Track -->
<div class="offer-card">
<h3>Pista Individual</h3>
<div class="offer-price">$X.XX</div>
<ul class="offer-features">
<li>Acceso de por vida a la pista elegida</li>
<li>Descarga en formato de alta calidad (WAV/MP3)</li>
<li>Uso personal sin conexión</li>
</ul>
<button class="atmanme-btn offer-cta-btn" data-offer-type="individual">Comprar Pista</button>
</div>

<!-- Membership -->
<div class="offer-card premium">
<h3>Acceso Ilimitado</h3>
<div class="offer-price">$XX.XX <span style="font-size: 1rem; font-weight: normal;">/ mes</span></div>
<ul class="offer-features">
<li>Acceso ilimitado a todo el catálogo</li>
<li>Nuevas frecuencias añadidas cada mes</li>
<li>Meditaciones exclusivas para miembros</li>
<li>App móvil para escuchar en cualquier lugar</li>
</ul>
<button class="atmanme-btn offer-cta-btn" style="background-color: var(--atmanme-color-accent) !important; color: var(--atmanme-color-white) !important;" data-offer-type="membership">Suscribirse Ahora</button>
</div>
</div>
</section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
// Analytics: Track Play Events
const audioElements = document.querySelectorAll('audio.track-play-btn');
audioElements.forEach(function(audio) {
audio.addEventListener('play', function() {
const trackName = this.getAttribute('data-track-name') || 'Unknown Track';

// GA4 / DataLayer event
if (typeof dataLayer !== 'undefined') {
dataLayer.push({
'event': 'audio_play',
'track_name': trackName
});
} else {
console.log('Analytics Event [audio_play]: ', trackName);
}
});
});

// Analytics: Track CTA Clicks in Offer Section
const offerBtns = document.querySelectorAll('.offer-cta-btn');
offerBtns.forEach(function(btn) {
btn.addEventListener('click', function(e) {
const offerType = this.getAttribute('data-offer-type') || 'unknown';

// GA4 / DataLayer event
if (typeof dataLayer !== 'undefined') {
dataLayer.push({
'event': 'offer_click',
'offer_type': offerType
});
} else {
console.log('Analytics Event [offer_click]: ', offerType);
}

// Note: Prevent default or add checkout logic here in the future
});
});
});
</script>

</main>
<?php get_footer(); ?>