<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <div class="navbar-container">
    <?php include 'navbar.php'; ?>
  </div>
  <title>Search</title>
  <link rel="stylesheet" href="../static/css/search.css">
 
  <script src="../static/js/common.js" defer></script>
  
</head>
<body>
  <div class="navbar-container"></div>
  <script src="../static/js/navbar.js"></script>
  
  <div class="content">
    <h1>Select filters and click "Search" to generate the graph</h1>
    <div class="filters">
      <div class="sectiune">
        <label class="bar_text" for="bar_an">Select Year</label>
        <select class="bar" name="optiune_an" id="bar_an">
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
        </select>
      </div>
      <div class="sectiune">
        <label class="bar_text" for="bar_vizualizare">Select Type</label>
        <select class="bar" name="optiune_vizualizare" id="bar_vizualizare" onchange="handleTypeChange()">
          <option value="confiscari">Confiscari</option>
          <option value="urgente_medicale">Urgente Medicale</option>
          <option value="campanii_prevenire">Campanii de Prevenire</option>
        </select>
      </div>
      <div class="sectiune">
        <label class="bar_text" for="chart_type">Select Chart Type</label>
        <select class="bar" name="chart_type" id="chart_type">
          <option value="bar">Bar</option>
          <option value="pie">Pie</option>
          <option value="line">Graph</option>
        </select>
      </div>
      <div class="sectiune" id="filter_section" style="display: none;">
        <label class="bar_text" for="filter_type">Select Filter</label>
        <select class="bar" name="filter_type" id="filter_type" onchange="showFilterOptions()">
          <!-- Options will be dynamically populated based on the type -->
        </select>
      </div>
      <div class="sectiune" id="filter_value_section" style="display: none;">
        <label class="bar_text" for="filter_value">Select Value</label>
        <select class="bar" name="filter_value" id="filter_value">
          <!-- Options will be dynamically populated based on the filter type -->
        </select>
      </div>
      <button class="button_search" onclick="fetchData()">Search</button>
    </div>
    <div class="button_container">
  <button class="button_icon" onclick="downloadChart('png')">
    <img src="/Tehnologii_Web_RoDX/static/pictures/icon.webp" alt="PNG">PNG
  </button>
  <button class="button_icon" onclick="downloadChart('svg')">
    <img src="/Tehnologii_Web_RoDX/static/pictures/icon.webp" alt="SVG">SVG
  </button>
  <button class="button_icon" onclick="downloadCSV()">
    <img src="/Tehnologii_Web_RoDX/static/pictures/icon.webp" alt="CSV">CSV
  </button>
</div>

  </div>
  
  <div class="chart-container">
    <canvas id="myChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    let myChartInstance = null;

    function handleTypeChange() {
      const type = document.getElementById('bar_vizualizare').value;
      const filterSection = document.getElementById('filter_section');
      const filterType = document.getElementById('filter_type');
      const filterValueSection = document.getElementById('filter_value_section');

      filterType.innerHTML = ''; // Clear existing options
      filterType.removeEventListener('change', showFilterOptions);

      if (type === 'urgente_medicale') {
        filterSection.style.display = 'block';
        filterValueSection.style.display = 'block';
        filterType.innerHTML = `
          <option value="">None</option>
          <option value="gender">Gender</option>
          <option value="age_group">Age Group</option>
          <option value="administration_route">Administration Route</option>
          <option value="consumption_model">Consumption Model</option>
          <option value="diagnosis_type">Diagnosis Type</option>
        `;
        filterType.addEventListener('change', showFilterOptions);
      } else if (type === 'confiscari') {
        filterSection.style.display = 'block';
        filterValueSection.style.display = 'none'; // Hide for confiscari
        filterType.innerHTML = `
          <option value="grame">Grame</option>
          <option value="comprimate">Comprimate</option>
          <option value="doze_buc">Doze Buc</option>
          <option value="mililitri">Mililitri</option>
          <option value="nr_capturi">Nr Capturi</option>
        `;
      } else {
        filterSection.style.display = 'none';
        filterValueSection.style.display = 'none';
      }
    }

    function showFilterOptions() {
      const filterType = document.getElementById('filter_type').value;
      const filterValueSection = document.getElementById('filter_value_section');
      const filterValue = document.getElementById('filter_value');

      if (document.getElementById('bar_vizualizare').value !== 'urgente_medicale') {
        filterValueSection.style.display = 'none';
        return;
      }

      let options = '';
      if (filterType) {
        filterValueSection.style.display = 'block';

        if (filterType === 'gender') {
          options = '<option value="Masculin">Masculin</option><option value="Feminin">Feminin</option>';
        } else if (filterType === 'age_group') {
          options = '<option value="<25"><25</option><option value="25-34">25-34</option><option value=">35">>35</option>';
        } else if (filterType === 'administration_route') {
          options = '<option value="Oral/fumat/prizat">Oral/fumat/prizat</option><option value="Injectabil">Injectabil</option>';
        } else if (filterType === 'consumption_model') {
          options = '<option value="Consum singular">Consum singular</option><option value="Consum combinat">Consum combinat</option>';
        } else if (filterType === 'diagnosis_type') {
          options = '<option value="Intoxicație">Intoxicație</option><option value="Utilizare nocivă">Utilizare nocivă</option><option value="Dependență">Dependență</option><option value="Sevraj">Sevraj</option><option value="Tulburări de comportament">Tulburări de comportament</option><option value="Supradoză">Supradoză</option><option value="Testare toxicologică">Testare toxicologică</option>';
        }
      } else {
        filterValueSection.style.display = 'none';
      }

      filterValue.innerHTML = options;
    }

    function fetchData() {
    const year = document.getElementById('bar_an').value;
    const type = document.getElementById('bar_vizualizare').value;
    const chartType = document.getElementById('chart_type').value;
    const filterType = document.getElementById('filter_type').value;
    const filterValue = document.getElementById('filter_value').value;

    const params = new URLSearchParams({
        year,
        type,
        chart_type: chartType
    });

    if (filterType) {
        params.append('filter', filterType);

        // Append filter value only for urgente_medicale
        if (type === 'urgente_medicale' && filterValue) {
            params.append('filter_value', filterValue);
        }
    }

    fetch(`/Tehnologii_Web_RoDX/api/controllers/SearchController.php?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            console.log('Response Data:', data); // Log the response data
            if (data.status === 'success') {
                renderChart(data.data, type, chartType, filterType);
            } else {
                console.error(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}




function renderChart(data, type, chartType, filterType) {
    const labels = data.map(item => item.drug_name);
    let datasets = [];

    if (type === 'confiscari') {
        const key = filterType ? 'value' : 'grame';
        const label = filterType ? filterType : 'grame'; // Use the selected filter as the label
        const backgroundColor = chartType === 'pie' ? data.map((_, index) => `hsl(${index * (360 / data.length)}, 70%, 70%)`) : 'rgba(75, 192, 192, 0.2)';
        const borderColor = chartType === 'pie' ? data.map((_, index) => `hsl(${index * (360 / data.length)}, 70%, 70%)`) : 'rgba(75, 192, 192, 1)';

        datasets = [{
            label: label,
            data: data.map(item => item[key]),
            backgroundColor,
            borderColor,
            borderWidth: 1,
            fill: chartType !== 'line',
            pointBackgroundColor: chartType === 'line' ? 'rgba(75, 192, 192, 1)' : null,
            pointBorderColor: chartType === 'line' ? 'rgba(75, 192, 192, 1)' : null,
            pointRadius: chartType === 'line' ? 5 : null,
            pointHoverRadius: chartType === 'line' ? 7 : null
        }];
    } else {
        datasets = [{
            label: type,
            data: data.map(item => item.value),
            backgroundColor: chartType === 'pie' ? data.map((_, index) => `hsl(${index * (360 / data.length)}, 70%, 70%)`) : 'rgba(75, 192, 192, 0.2)',
            borderColor: chartType === 'pie' ? data.map((_, index) => `hsl(${index * (360 / data.length)}, 70%, 70%)`) : 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            fill: chartType !== 'line',
            pointBackgroundColor: chartType === 'line' ? 'rgba(75, 192, 192, 1)' : null,
            pointBorderColor: chartType === 'line' ? 'rgba(75, 192, 192, 1)' : null,
            pointRadius: chartType === 'line' ? 5 : null,
            pointHoverRadius: chartType === 'line' ? 7 : null
        }];
    }

    const ctx = document.getElementById('myChart').getContext('2d');

    // Destroy existing chart instance if it exists
    if (myChartInstance) {
        myChartInstance.destroy();
    }

    // Create new chart instance
    myChartInstance = new Chart(ctx, {
        type: chartType,
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    display: chartType !== 'pie'
                },
                x: {
                    display: chartType !== 'pie'
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: adjustFontSize()
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            return label;
                        }
                    },
                    bodyFont: {
                        size: adjustFontSize()
                    },
                    titleFont: {
                        size: adjustFontSize()
                    }
                }
            }
        }
    });
}


    function adjustFontSize() {
      const windowWidth = window.innerWidth;
      if (windowWidth < 600) {
        return 12;
      } else if (windowWidth < 900) {
        return 14;
      } else {
        return 16;
      }
    }

    window.addEventListener('resize', () => {
      if (myChartInstance) {
        myChartInstance.options.plugins.legend.labels.font.size = adjustFontSize();
        myChartInstance.options.plugins.tooltip.bodyFont.size = adjustFontSize();
        myChartInstance.options.plugins.tooltip.titleFont.size = adjustFontSize();
        myChartInstance.update();
      }
    });

    function downloadChart(format) {
      if (format === 'png') {
        const link = document.createElement('a');
        link.href = myChartInstance.toBase64Image();
        link.download = 'chart.png';
        link.click();
      } else if (format === 'svg') {
        const canvas = document.getElementById('myChart');
        const xmlSerializer = new XMLSerializer();
        const svgElement = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svgElement.setAttribute("xmlns", "http://www.w3.org/2000/svg");
        svgElement.setAttribute("width", canvas.width);
        svgElement.setAttribute("height", canvas.height);

        const foreignObject = document.createElementNS("http://www.w3.org/2000/svg", "foreignObject");
        foreignObject.setAttribute("width", "100%");
        foreignObject.setAttribute("height", "100%");

        const canvasDataURL = canvas.toDataURL("image/png");
        const image = new Image();
        image.setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
        image.setAttribute("src", canvasDataURL);
        foreignObject.appendChild(image);
        svgElement.appendChild(foreignObject);

        const svgString = xmlSerializer.serializeToString(svgElement);
        const svgBlob = new Blob([svgString], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(svgBlob);

        const link = document.createElement('a');
        link.href = url;
        link.download = 'chart.svg';
        link.click();
        URL.revokeObjectURL(url);
      }
    }

    function downloadCSV() {
    const year = document.getElementById('bar_an').value;
    const type = document.getElementById('bar_vizualizare').value;
    const filterType = document.getElementById('filter_type').value;
    const filterValue = document.getElementById('filter_value').value;

    const params = new URLSearchParams({
        year,
        type,
        csv: true
    });

    if (filterType) {
        params.append('filter', filterType);
    }

    if (filterValue) {
        params.append('filter_value', filterValue);
    }

    window.location.href = `/Tehnologii_Web_RoDX/api/controllers/SearchController.php?${params.toString()}`;
}


    document.addEventListener('DOMContentLoaded', () => {
      handleTypeChange(); // Initialize correctly based on the default type
    });
  </script>
</body>
</html>
