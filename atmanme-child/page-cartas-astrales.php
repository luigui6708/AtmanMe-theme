<?php
/**
* Template Name: Birth Chart Landing
*/

get_header(); ?>

<main id="main" class="site-main carta-astral-landing">
<style>
.carta-astral-landing { padding: 40px 20px; max-width: 1200px; margin: 0 auto; }
.hero-section { display: flex; flex-wrap: wrap; gap: 40px; margin-bottom: 60px; align-items: center; }
.hero-content { flex: 1; min-width: 300px; }
.hero-image { flex: 1; min-width: 300px; text-align: center; }
.hero-image img { max-width: 100%; border-radius: 8px; box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
.form-group { margin-bottom: 15px; text-align: left; }
.form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
.form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }

.value-section { margin-bottom: 60px; }
.value-cards { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
.value-card { flex: 1; min-width: 250px; text-align: center; }

.social-proof-section { background-color: var(--atmanme-color-white); padding: 40px; border-radius: 8px; margin-bottom: 60px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
.testimonials { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-bottom: 20px; }
.testimonial { flex: 1; min-width: 250px; text-align: center; }
.testimonial img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; }
.counter { text-align: center; font-size: 1.5rem; font-weight: bold; color: var(--atmanme-color-primary); }

.comparison-section { margin-bottom: 60px; }
.comparison-columns { display: flex; flex-wrap: wrap; gap: 20px; }
.comparison-col { flex: 1; min-width: 300px; background-color: var(--atmanme-color-white); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
.comparison-col.premium { border: 2px solid var(--atmanme-color-accent); }
.comparison-col h3 { text-align: center; margin-top: 0; }
.comparison-col ul { list-style: none; padding: 0; margin-bottom: 30px; }
.comparison-col ul li { padding: 10px 0; border-bottom: 1px solid #eee; text-align: left; }
.comparison-col ul li:last-child { border-bottom: none; }

.faq-section { margin-bottom: 60px; }
.faq-accordion details { background-color: var(--atmanme-color-white); margin-bottom: 10px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: left; }
.faq-accordion summary { padding: 15px; font-weight: bold; cursor: pointer; color: var(--atmanme-color-primary); }
.faq-accordion .faq-answer { padding: 0 15px 15px; margin: 0; color: var(--atmanme-color-text); }

.final-cta-section { text-align: center; padding: 60px 20px; background-color: var(--atmanme-color-white); border-radius: 8px; }
</style>

<!-- Hero Section -->
<section class="hero-section">
<div class="hero-content">
<h1 class="page-title">Discover Your Birth Chart</h1>
<p>Learn the position of the planets at the moment of your birth and discover your true potential.</p>

<?php if ( isset($_GET['success']) && $_GET['success'] == '1' ) : ?>
<div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
Your data was saved successfully! You'll receive your birth chart soon.
</div>
<?php endif; ?>

<form id="carta-astral-form" method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
<?php wp_nonce_field('submit_carta_astral', 'carta_astral_nonce'); ?>
<input type="hidden" name="action" value="submit_carta_astral_form">

<div class="form-group">
<label for="ca_fecha">Date of birth</label>
<input type="date" id="ca_fecha" name="ca_fecha" required>
</div>
<div class="form-group">
<label for="ca_hora">Time of birth</label>
<input type="time" id="ca_hora" name="ca_hora" required>
</div>
<div class="form-group">
<label for="ca_lugar">Place of birth</label>
<input type="text" id="ca_lugar" name="ca_lugar" placeholder="City, Country" required>
</div>

<button type="submit" class="atmanme-btn" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'generate_chart_hero_click'});">Generate my birth chart</button>
</form>
</div>
<div class="hero-image">
<img src="https://atmanme.com/wp-content/uploads/2026/07/hero-2.png" alt="Illustration of a glowing astrological birth chart">
</div>
</section>

<!-- Value Section -->
<section class="value-section">
<h2 class="atmanme-section-header">What Will You Discover?</h2>
<div class="value-cards">
<div class="atmanme-blog-card value-card">
<div style="font-size: 2rem; margin-bottom: 10px;">🌟</div>
<h3 class="entry-title">Personality</h3>
<p class="entry-summary">Learn your deep strengths and weaknesses.</p>
</div>
<div class="atmanme-blog-card value-card">
<div style="font-size: 2rem; margin-bottom: 10px;">⏳</div>
<h3 class="entry-title">Life Cycles</h3>
<p class="entry-summary">Understand your rhythms and key moments.</p>
</div>
<div class="atmanme-blog-card value-card">
<div style="font-size: 2rem; margin-bottom: 10px;">🎯</div>
<h3 class="entry-title">Purpose</h3>
<p class="entry-summary">Align your life with your true mission.</p>
</div>
</div>
</section>

<!-- Social Proof Section -->
<section class="social-proof-section">
<h2 class="atmanme-section-header">What Our Users Say</h2>
<p style="text-align:center;color:#B08D57;font-size:0.85rem;font-style:italic;max-width:520px;margin:0 auto 30px;">Placeholder space — real testimonials will replace these once we start collecting them.</p>
<div class="testimonials">
<div class="testimonial">
<div style="width:80px;height:80px;border-radius:50%;background:rgba(176,141,87,0.15);border:1px solid rgba(176,141,87,0.4);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;color:#B08D57;font-size:1.4rem;">?</div>
<h4>Sample customer — replace with real testimonial</h4>
<p>"[Placeholder — add a real quote about the birth chart experience before this goes live]"</p>
</div>
<div class="testimonial">
<div style="width:80px;height:80px;border-radius:50%;background:rgba(176,141,87,0.15);border:1px solid rgba(176,141,87,0.4);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;color:#B08D57;font-size:1.4rem;">?</div>
<h4>Sample customer — replace with real testimonial</h4>
<p>"[Placeholder — add a real quote about the premium report experience]"</p>
</div>
</div>
</section>

<!-- Comparison Section -->
<section class="comparison-section">
<h2 class="atmanme-section-header">Choose Your Experience</h2>
<div class="comparison-columns">
<div class="comparison-col">
<h3>Free Basic Chart</h3>
<ul>
<li>✅ Planet positions</li>
<li>✅ Sun, moon and rising sign</li>
<li>❌ In-depth interpretation</li>
<li>❌ Branded PDF format</li>
<li>❌ Explanatory audio/video</li>
</ul>
<div style="text-align: center;">
<a href="#carta-astral-form" class="atmanme-btn" style="background-color: #ccc !important; color: #333 !important;" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'select_free_chart'});">Get It Free</a>
</div>
</div>
<div class="comparison-col premium">
<h3>Premium Chart</h3>
<div style="text-align:center;font-size:1.8rem;font-weight:700;color:var(--atmanme-color-accent);margin-bottom:15px;">$25 <span style="font-size:0.9rem;font-weight:400;color:var(--atmanme-color-text);">one-time</span></div>
<ul>
<li>✅ Planet positions</li>
<li>✅ Sun, moon and rising sign</li>
<li>✅ In-depth personalized interpretation</li>
<li>✅ Branded PDF format</li>
<li>✅ Explanatory audio/video</li>
</ul>
<div style="text-align: center;">
<a href="#carta-astral-form" class="atmanme-btn" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'select_premium_chart'});">Buy Premium</a>
</div>
</div>
</div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
<h2 class="atmanme-section-header">Frequently Asked Questions</h2>
<div class="faq-accordion">
<details>
<summary class="faq-question">Do I need to know my exact birth time?</summary>
<p class="faq-answer">Yes, the exact time is essential to accurately calculate your rising sign and astrological houses.</p>
</details>
<details>
<summary class="faq-question">What if I don't know my birth time?</summary>
<p class="faq-answer">You can request a solar chart, or try to get your birth certificate, where it's usually recorded.</p>
</details>
<details>
<summary class="faq-question">How long does the Premium Chart take to arrive?</summary>
<p class="faq-answer">The premium chart is generated personally for you, and you'll receive it by email within 24 to 48 hours.</p>
</details>
<details>
<summary class="faq-question">What format is the Premium Chart delivered in?</summary>
<p class="faq-answer">You'll receive a PDF document with an exclusive design and an audio/video file with a detailed explanation.</p>
</details>
</div>
</section>

<!-- Final CTA Section -->
<section class="final-cta-section">
<h2>Ready to discover your star map?</h2>
<p style="margin-bottom: 30px;">Start your self-discovery journey today.</p>
<a href="#carta-astral-form" class="atmanme-btn" onclick="if(typeof dataLayer !== 'undefined') dataLayer.push({'event': 'final_cta_click'});">Generate my birth chart</a>
</section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
var form = document.getElementById('carta-astral-form');
if(form) {
form.addEventListener('submit', function(e) {
var fecha = document.getElementById('ca_fecha').value;
var hora = document.getElementById('ca_hora').value;
var lugar = document.getElementById('ca_lugar').value;

if(!fecha || !hora || !lugar) {
e.preventDefault();
alert('Please fill in all fields.');
}
});
}
});
</script>

<script>
(function(){
var params = new URLSearchParams(window.location.search);
var fecha = params.get('ca_fecha');
var hora = params.get('ca_hora');
var lugar = params.get('ca_lugar');
if (fecha || hora || lugar) {
var elFecha = document.getElementById('ca_fecha');
var elHora = document.getElementById('ca_hora');
var elLugar = document.getElementById('ca_lugar');
if (fecha && elFecha) elFecha.value = fecha;
if (hora && elHora) elHora.value = hora;
if (lugar && elLugar) elLugar.value = lugar;
var formEl = document.getElementById('carta-astral-form');
if (formEl) { formEl.scrollIntoView({behavior:'smooth', block:'center'}); }
}
})();
</script>
<?php get_footer(); ?>
