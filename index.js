const $html = document.querySelector('html')
const $checkbox = document.querySelector('#switch')
let darkMode = localStorage.getItem("dark-mode");

const enableDarkMode = () => {
    $html.classList.add('dark-mode');
    $checkbox.checked = true;
    localStorage.setItem("dark-mode", "enabled");
};

const disableDarkMode = () => {
    $html.classList.remove('dark-mode');
    $checkbox.checked = false;
    localStorage.setItem("dark-mode", "disabled");
};

if (darkMode === "enabled") {
  enableDarkMode(); // set state of darkMode on page load
}

$checkbox.addEventListener("change", (e) => {
  darkMode = localStorage.getItem("dark-mode"); // update darkMode when clicked
  if (darkMode === "disabled") {
    enableDarkMode();
  } else {
    disableDarkMode();
  }
});

function show(){
    document.querySelector('.hamburger').classList.toggle('open')
    document.querySelector('.navigation').classList.toggle('active')
}


const pieChart = {
  chart: null,
  data: [
    ['Product', 'Sales'],
    ['Laptops', 1708],
    ['Desktops', 1457],
    ['Cameras', 660],
    ['Phones', 1507],
    ['Accessories', 768]
  ],
  element: '#pie-chart',
  options: {
    title: '2019 Units Sold',
    width: 500,
    height: 300
  }
};

const barChart = {
  chart: null,
  data: [
    ['Product', 'Sales'],
    ['Laptops', 1708],
    ['Desktops', 1457],
    ['Cameras', 660],
    ['Phones', 1507],
    ['Accessories', 768]
  ],
  element: '#bar-chart',
  options:  {
    title: '2019 Units Sold',
    width: 500,
    height: 300
  }
};

const lineChart = {
  chart: null,
  data: [
    ['Year', 'Sales'],
    ['2015', 5752],
    ['2016', 5621],
    ['2017', 5876],
    ['2018', 6585],
    ['2019', 6100]
  ],
  element: '#line-chart',
  options: {
    title: 'Total Units Sold History',
    width: 500,
    height: 300
  }
};

// https://developers.google.com/chart/interactive/docs/gallery/piechart
// https://developers.google.com/chart/interactive/docs/gallery/barchart
// https://developers.google.com/chart/interactive/docs/gallery/linechart
// https://developers.google.com/chart/interactive/docs/reference#draw
// https://developers.google.com/chart/interactive/docs/reference#arraytodatatable
const init = () => {
  pieChart.chart = new google.visualization.PieChart(
    document.querySelector(pieChart.element)
  );
  pieChart.chart.draw(
    google.visualization.arrayToDataTable(pieChart.data),
    pieChart.options
  );
  
  barChart.chart = new google.visualization.BarChart(
    document.querySelector(barChart.element)
  );
  barChart.chart.draw(
    google.visualization.arrayToDataTable(barChart.data),
    barChart.options
  );
  
  lineChart.chart = new google.visualization.LineChart(
    document.querySelector(lineChart.element)
  );
  lineChart.chart.draw(
    google.visualization.arrayToDataTable(lineChart.data),
    lineChart.options
  );
};

// https://developers.google.com/chart/interactive/docs/quick_start
google.charts.load('current', {
  packages: ['corechart'],
  callback: init
});

// https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector
// https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener
document.querySelector('#update-pie-chart').addEventListener('click', () => {
  pieChart.data = [
    ['Product', 'Sales'],
    ['Laptops', 1508],
    ['Desktops', 1497],
    ['Cameras', 360],
    ['Phones', 1790],
    ['Accessories', 518]
  ];
  pieChart.chart.draw(
    google.visualization.arrayToDataTable(pieChart.data),
    pieChart.options
  );
});