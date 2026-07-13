<?php
/* Template Name: Audio Therapy */
get_header(); ?>
<main id="primary" class="site-main">

<style>
/* Scoped styles for Audio Therapy landing page */
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
<h1 class="page-title">Audio Therapy & Frequencies for the Soul</h1>
<p>Elevate your vibration, improve your focus, and find peace with our library of guided sounds.</p>

<img src="https://atmanme.com/wp-content/uploads/2026/07/hero-3.png" alt="Illustration of two people meditating with headphones surrounded by chakra symbols and a Tibetan singing bowl" class="audioterapia-hero-image">

<div class="audio-player-container">
<h3>Sample: Journey to Inner Calm</h3>
<!-- TODO: replace src with real sample audio from media library -->
<audio controls class="hero-audio track-play-btn" data-track-name="Sample: Journey to Inner Calm">
<source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
</div>

<a href="#catalogo" class="atmanme-btn cta-scroll">Explore Catalog</a>
</section>

<!-- Catalog Section -->
<section id="catalogo" class="catalog-section">
<h2 class="atmanme-section-header">Frequency Catalog</h2>

<!-- Category: Sleep -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Deep Sleep</span></h3>
<div class="catalog-grid">
<?php
// Mock tracks for Sleep
$sueno_tracks = [
['title' => 'Delta Waves for Insomnia', 'duration' => '60 min', 'icon' => '🌙'],
['title' => 'Guided Nighttime Relaxation', 'duration' => '45 min', 'icon' => '🛌'],
['title' => 'Rain and Tibetan Singing Bowls', 'duration' => '90 min', 'icon' => '🌧️']
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
<span class="track-meta">Duration: <?php echo $track['duration']; ?></span>
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

<!-- Category: Focus -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Focus & Productivity</span></h3>
<div class="catalog-grid">
<?php
$enfoque_tracks = [
['title' => 'Gamma Waves for Studying', 'duration' => '120 min', 'icon' => '🧠'],
['title' => 'Flow Frequency (Flow State)', 'duration' => '60 min', 'icon' => '⚡'],
['title' => 'Brown Noise for ADHD', 'duration' => '180 min', 'icon' => '🎯']
];
foreach ($enfoque_tracks as $track) {
?>
<article class="atmanme-blog-card">
<div class="track-thumbnail">
<?php echo $track['icon']; ?>
</div>
<div class="track-info">
<h4 class="track-title"><?php echo $track['title']; ?></h4>
<span class="track-meta">Duration: <?php echo $track['duration']; ?></span>
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

<!-- Category: Healing -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Healing & Balance</span></h3>
<div class="catalog-grid">
<?php
$sanacion_tracks = [
['title' => 'Chakra Alignment (Solfeggio)', 'duration' => '45 min', 'icon' => '🧘'],
['title' => '432 Hz - The Tone of the Universe', 'duration' => '60 min', 'icon' => '🌿'],
['title' => 'Emotional Trauma Release', 'duration' => '30 min', 'icon' => '💖']
];
foreach ($sanacion_tracks as $track) {
?>
<article class="atmanme-blog-card">
<div class="track-thumbnail">
<?php echo $track['icon']; ?>
</div>
<div class="track-info">
<h4 class="track-title"><?php echo $track['title']; ?></h4>
<span class="track-meta">Duration: <?php echo $track['duration']; ?></span>
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

<!-- Category: Frequencies -->
<div class="catalog-category">
<h3><span class="atmanme-category-badge">Binaural Frequencies</span></h3>
<div class="catalog-grid">
<?php
$frecuencias_tracks = [
['title' => 'Theta Waves for Meditation', 'duration' => '40 min', 'icon' => '🌌'],
['title' => '528 Hz - DNA Repair', 'duration' => '60 min', 'icon' => '🧬'],
['title' => 'Astral Travel and Lucid Dreams', 'duration' => '90 min', 'icon' => '✨']
];
foreach ($frecuencias_tracks as $track) {
?>
<article class="atmanme-blog-card">
<div class="track-thumbnail">
<?php echo $track['icon']; ?>
</div>
<div class="track-info">
<h4 class="track-title"><?php echo $track['title']; ?></h4>
<span class="track-meta">Duration: <?php echo $track['duration']; ?></span>
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
<h2 class="atmanme-section-header">The Power of Sound on the Brain</h2>

<p>Audio therapy and binaural frequencies aren't just spiritual concepts; they're grounded in neuroplasticity and the way our brain processes auditory stimuli. When each ear hears slightly different tones, the brain compensates by creating a third "phantom" frequency that encourages changes in brainwave patterns (brainwave entrainment).</p>

<div class="citation-box">
<p><strong>TODO: verify source</strong> "Brainwave synchronization through binaural frequencies can facilitate states of deep relaxation, reduce anxiety, and improve cognitive function by stimulating specific neural networks." - [Space for real neurological research citation]</p>
</div>

<p>Depending on the frequency chosen (such as Alpha waves for relaxation or Gamma for higher cognitive processing), we can guide our mind toward desired states of consciousness, promoting emotional wellbeing, better sleep quality, and greater focus.</p>

<div class="citation-box">
<p><strong>TODO: verify source</strong> "Regular exposure to therapeutic sound frequencies has been shown to promote neuroplasticity, helping manage chronic stress and improving restorative sleep quality." - [Space for real sleep/stress study citation]</p>
</div>
</div>
</section>

<!-- Offer Section -->
<section class="offer-section">
<h2 class="atmanme-section-header">Begin Your Sound Journey</h2>

<div class="offer-grid">
<!-- Individual Track -->
<div class="offer-card">
<h3>Individual Track</h3>
<div class="offer-price">$X.XX</div>
<ul class="offer-features">
<li>Lifetime access to the chosen track</li>
<li>Download in high-quality format (WAV/MP3)</li>
<li>Personal offline use</li>
</ul>
<button class="atmanme-btn offer-cta-btn" data-offer-type="individual">Buy Track</button>
</div>

<!-- Membership -->
<div class="offer-card premium">
<h3>Unlimited Access</h3>
<div class="offer-price">$XX.XX <span style="font-size: 1rem; font-weight: normal;">/ month</span></div>
<ul class="offer-features">
<li>Unlimited access to the entire catalog</li>
<li>New frequencies added every month</li>
<li>Exclusive meditations for members</li>
<li>Mobile app to listen anywhere</li>
</ul>
<button class="atmanme-btn offer-cta-btn" style="background-color: var(--atmanme-color-accent) !important; color: var(--atmanme-color-white) !important;" data-offer-type="membership">Subscribe Now</button>
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
