<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="/Tehnologii_Web_RoDX/static/css/index.css">  
  <script src="../static/js/common.js" defer></script>
    
</head>
<body>
  <div class="navbar-container">
    <?php include 'navbar.php'; ?>
  </div>

  <div class="content">
    <h1>Romanian Drug Explorer</h1>
  </div>

  <div class="hero">
    <div class="hero_content">
      <p class="hero_title">Ce reprezinta termenul drog?</p>
      <p class="hero_text">Drog este un termen folosit pentru a desemna acele substanțe naturale sau sintetice care prin natura lor chimică determină alterarea funcționării unui organ și modifică starea psihică a unei persoane. 
        Acest termen se referă la substanțe psihoactive, mai ales cele ilegale.</p>
      <a href="/Tehnologii_Web_RoDX/views/search.php" class="hero_button">Vezi Statistici</a>
    </div>
  </div>
  
  <div class="content1">
    <div class="drug_info_left">
      <img class="img" src="/Tehnologii_Web_RoDX/static/pictures/canabis_img.webp">
      <div class="containter_description">
        <p class="title_description">Cannabis</p>
        <p class="description">În România, consumul de cannabis în scop recreațional este ilegal și este pedepsit prin Legea nr. 143/2000. 
        Cannabisul medicinal a fost legalizat în 2013.
        Consumul nu este incriminat de Legea 143/2000, însă deținerea de cannabis pentru consum propriu, fără drept, 
        se pedepsește cu închisoare de la 3 luni la 2 ani sau cu amendă.</p>
      </div>
    </div>

    <div class="drug_info_right">
      <div class="containter_description_right">
        <p class="title_description_right">Cocaina</p>
        <p class="description_right">Cocaina este un drog cu efect stimulant puternic asupra sistemului nervos central care da dependenta. 
          Este produsa din frunzele plantei de coca originara din America de Sud.
          Cultivarea, oferirea, vânzarea, transportul, cumpărarea, deținerea de cocaina se pedepseste cu inchisoare de la 5 la 15 ani.</p>
      </div>
      <img class="img_right" src="/Tehnologii_Web_RoDX/static/pictures/cocaina_mg.jpg">
    </div>
  </div>
  <div class="content1">
    <div class="drug_info_left">
      <img class="img" src="/Tehnologii_Web_RoDX/static/pictures/heroina_img.webp">
      <div class="containter_description">
        <p class="title_description">Heroina</p>
        <p class="description">Heroina este un drog foarte puternic obținut din opiu.
          Este unul dintre drogurile care produc o puternică dependență fizică și psihică. 
          Toleranța se produce rapid și este urmată la scurt timp de dependența fizică.
          Fiind tot din categoria de droguri de mare risc, la fel ca cocaina, operatiunile cu heroina se pedepsesc cu inchisoare de la 5 la 15 ani.
        </p>
      </div>
    </div>

    <div class="drug_info_right">
      <div class="containter_description_right">
        <p class="title_description_right">MDMA</p>
        <p class="description_right">
          MDMA este o substanță psihoactivă, efectele sale psihice constand în euforie, stare energică, reducerea anxietății, creșterea dorintei de empatie sexuală.
          Nefiind clasificat ca un drog de mare risc, operatiunile cu MDMA se pedepsesc cu inchisoare de la 3 luni la 2 ani sau cu amenda.
        </p>
      </div>
      <img class="img_right" src="/Tehnologii_Web_RoDX/static/pictures/mdma_img.webp">
    </div>

  </div>
  <div class="content1">
    <div class="drug_info_left">
      <img class="img" src="/Tehnologii_Web_RoDX/static/pictures/amfetamina_img.jpg">
      <div class="containter_description">
        <p class="title_description">Amfetamina</p>
        <p class="description">
          Amfetamina este un stimulent potent al sistemului nervos central, utilizat în tratamentul ADHD, narcolepsiei, obezității si bolii Parkinson.
          Este clasificat ca drog de mare risc, astfel operatiunile cu Amfetamina se pedepsesc cu inchisoare de la 5 la 15 ani.
        </p>
      </div>
    </div>

    <div class="drug_info_right">
        <div class="containter_description_right">
          <p class="title_description_right">Oxicodona</p>
          <p class="description_right">Oxicodona este un analgezic opioid semi-sintetic, un agonist al receptorilor opioizi.
            Pe cale orală, are un efect de aproximativ 1,5 ori mai mare decât morfina, pentru o masă echivalentă de substanță.
            Este clasificat ca drog de mare risc, astfel operatiunile cu Oxicodona se pedepsesc cu inchisoare de la 5 la 15 ani.
          </p>
        </div>
        <img class="img_right" src="/Tehnologii_Web_RoDX/static/pictures/oxicodona_img.avif">
    </div>
  </div>
  <div class="disclaimer">
    <p>
      <strong>Disclaimer:</strong> 
      The information provided on this website is for educational purposes only. We do not condone or promote the illegal use of drugs.
      Stimulants, like other substances discussed here, can pose serious health risks and legal consequences if misused.
    </p>
  </div>

  <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
      const token = localStorage.getItem('jwtToken');
      if (!token) {
        window.location.href = '/Tehnologii_Web_RoDX/views/login.php';
      }

      // Optional: You can add further token validation here
      // const payload = JSON.parse(atob(token.split('.')[1]));
      // if (payload.exp * 1000 < Date.now()) {
      //   localStorage.removeItem('jwtToken');
      //   window.location.href = '/Tehnologii_Web_RoDX/views/login.php';
      // }
    });
  </script> -->
</body>
</html>