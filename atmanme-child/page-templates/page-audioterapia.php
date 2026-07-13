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
height: 160px;
display: flex;
align-items: center;
justify-content: center;
font-size: 3.5rem;
border-radius: 12px;
margin-bottom: 15px;
box-shadow: inset 0 0 0 1px rgba(0,0,0,0.03);
}
.track-thumbnail.cat-sleep {
background: linear-gradient(135deg, var(--atmanme-color-primary) 0%, var(--atmanme-color-bg) 100%);
color: var(--atmanme-color-white);
}
.track-thumbnail.cat-focus {
background: linear-gradient(135deg, var(--atmanme-color-accent) 0%, var(--atmanme-color-bg) 100%);
color: var(--atmanme-color-white);
}
.track-thumbnail.cat-healing {
background: linear-gradient(135deg, var(--atmanme-color-primary) 0%, var(--atmanme-color-accent) 100%);
color: var(--atmanme-color-white);
}
.track-thumbnail.cat-frequencies {
background: linear-gradient(135deg, var(--atmanme-color-accent) 0%, var(--atmanme-color-primary) 100%);
color: var(--atmanme-color-white);
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
border-radius: 0 4px 4px 0;
}
.citation-box p {
margin-bottom: 0;
line-height: 1.6;
}

.testimonials-section {
padding: 60px 20px;
max-width: 1000px;
margin: 0 auto;
}
.testimonials-grid {
display: grid;
grid-template-columns: 1fr;
gap: 30px;
}
@media (min-width: 768px) {
.testimonials-grid {
grid-template-columns: repeat(3, 1fr);
}
}
.testimonial-card {
background-color: var(--atmanme-color-white);
border-radius: 8px;
padding: 30px 25px;
box-shadow: 0 4px 6px rgba(0,0,0,0.05);
text-align: center;
}
.testimonial-avatar {
width: 56px;
height: 56px;
border-radius: 50%;
background-color: var(--atmanme-color-primary);
color: var(--atmanme-color-white);
display: flex;
align-items: center;
justify-content: center;
font-weight: bold;
margin: 0 auto 15px;
font-family: var(--atmanme-font-heading);
}
.testimonial-quote {
font-style: italic;
color: var(--atmanme-color-text);
margin-bottom: 15px;
line-height: 1.6;
}
.testimonial-name {
font-weight: bold;
color: var(--atmanme-color-primary);
font-size: 0.95rem;
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
.offer-card a.offer-cta-btn {
display: inline-block;
text-decoration: none;
}

.faq-section {
background-color: var(--atmanme-color-bg);
padding: 60px 20px;
border-top: 1px solid rgba(0,0,0,0.05);
}
.faq-content {
max-width: 800px;
margin: 0 auto;
}
.faq-item {
background-color: var(--atmanme-color-white);
border-radius: 8px;
padding: 20px 25px;
margin-bottom: 15px;
box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}
.faq-item h4 {
margin: 0 0 10px;
color: var(--atmanme-color-primary);
}
.faq-item p {
margin: 0;
line-height: 1.6;
color: var(--atmanme-color-text);
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

<!-- Science Section (moved up: educate before selling) -->
<section class="science-section">
<div class="science-content">
<h2 class="atmanme-section-header">The Power of Sound on the Brain</h2>

<p>Audio therapy and binaural frequencies aren't just spiritual concepts; they're grounded in how our brain processes auditory stimuli. When each ear hears a slightly different tone, the brain compensates by creating a third "phantom" frequency — a well-documented phenomenon known as brainwave entrainment.</p>

<div class="citation-box">
<p><strong>What this means in practice:</strong> brainwave entrainment is an active area of research, and results vary from person to person. Consistency matters more than any single session — a few short listens a week tend to help more than one long session now and then.</p>
</div>

<p>Depending on the frequency chosen (such as Alpha waves for relaxation or Gamma for higher cognitive processing), sound can support your mind toward a desired state — helping with relaxation, better sleep, or sharper focus.</p>

<div class="citation-box">
<p><strong>A note on expectations:</strong> we don't publish invented statistics or studies we haven't verified — you deserve better than that. If stress, anxiety, or sleep are affecting your daily life in a serious way, please also talk to a qualified professional. Sound can support your wellbeing, but it isn't a medical treatment.</p>
</div>
</div>
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
<!-- TODO: replace icon-on-gradient with a commissioned illustration once available -->
<div class="track-thumbnail cat-sleep">
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
<div class="track-thumbnail cat-focus">
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
<div class="track-thumbnail cat-healing">
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
<div class="track-thumbnail cat-frequencies">
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

<!-- Testimonials Section -->
<!-- TODO: replace all three placeholder testimonials below with real customer quotes before this section goes live. Avoid stock photos of "customers" — initials-only avatars are used intentionally here and can stay even with real quotes. -->
<section class="testimonials-section">
<h2 class="atmanme-section-header">What Our Community Says</h2>
<div class="testimonials-grid">
<div class="testimonial-card">
<div class="testimonial-avatar">?</div>
<p class="testimonial-quote">"[Placeholder — add a real quote about how audio therapy helped with sleep before this goes live]"</p>
<p class="testimonial-name">Sample customer — replace with real testimonial</p>
</div>
<div class="testimonial-card">
<div class="testimonial-avatar">?</div>
<p class="testimonial-quote">"[Placeholder — add a real quote about focus or stress relief before this goes live]"</p>
<p class="testimonial-name">Sample customer — replace with real testimonial</p>
</div>
<div class="testimonial-card">
<div class="testimonial-avatar">?</div>
<p class="testimonial-quote">"[Placeholder — add a real quote about the Unlimited Access membership before this goes live]"</p>
<p class="testimonial-name">Sample customer — replace with real testimonial</p>
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
<!-- TODO: replace mailto with a real checkout/payment link once processing is set up. Using an interim contact email as a functional stopgap so the CTA isn't dead. -->
<a href="mailto:hello@atmanme.com?subject=I'd%20like%20to%20buy%20an%20audio%20track" class="atmanme-btn offer-cta-btn" data-offer-type="individual">Buy Track</a>
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
<!-- TODO: replace mailto with a real subscription checkout link once processing is set up. -->
<a href="mailto:hello@atmanme.com?subject=I'd%20like%20to%20subscribe%20to%20Unlimited%20Access" class="atmanme-btn offer-cta-btn" style="background-color: var(--atmanme-color-accent) !important; color: var(--atmanme-color-white) !important;" data-offer-type="membership">Subscribe Now</a>
</div>
</div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
<div class="faq-content">
<h2 class="atmanme-section-header">Frequently Asked Questions</h2>

<div class="faq-item">
<h4>Do I need headphones for binaural frequencies?</h4>
<p>Yes. Binaural beats only work with stereo headphones, since each ear needs to receive a slightly different tone at the same time.</p>
</div>

<div class="faq-item">
<h4>How often should I listen?</h4>
<p>Most people notice more benefit from short, consistent sessions — 15 to 30 minutes, a few times a week — than from one long session every once in a while.</p>
</div>

<div class="faq-item">
<h4>Is this a replacement for therapy or medical treatment?</h4>
<p>No. Audio therapy can support relaxation and focus, but it isn't a substitute for professional mental health or medical care. If you're struggling, please also reach out to a qualified professional.</p>
</div>

<div class="faq-item">
<h4>Can I download tracks for offline use?</h4>
<p>Yes. Individually purchased tracks are available for download in WAV or MP3 format for personal offline use.</p>
</div>

<div class="faq-item">
<h4>What's the difference between an individual track and Unlimited Access?</h4>
<p>An individual track gives you lifetime access to that one track. Unlimited Access unlocks the entire catalog, plus new frequencies added every month.</p>
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

// Note: offerBtns are now real mailto links (see TODOs above); replace with real checkout logic when payment processing is ready.
});
});
});
</script>

</main>
<?php get_footer(); ?>
