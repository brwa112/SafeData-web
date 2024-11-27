<template>
  <div>
    <ul class="flex space-x-2 rtl:space-x-reverse mb-6">
      <li>
        <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
        <span>Charts</span>
      </li>
    </ul>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="panel lg:col-span-2 p-3 flex items-center text-primary overflow-x-auto whitespace-nowrap">
        <div class="ring-2 ring-primary/30 rounded-full bg-primary text-white p-1.5 ltr:mr-3 rtl:ml-3">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            class="w-3.5 h-3.5">
            <path
              d="M19.0001 9.7041V9C19.0001 5.13401 15.8661 2 12.0001 2C8.13407 2 5.00006 5.13401 5.00006 9V9.7041C5.00006 10.5491 4.74995 11.3752 4.28123 12.0783L3.13263 13.8012C2.08349 15.3749 2.88442 17.5139 4.70913 18.0116C9.48258 19.3134 14.5175 19.3134 19.291 18.0116C21.1157 17.5139 21.9166 15.3749 20.8675 13.8012L19.7189 12.0783C19.2502 11.3752 19.0001 10.5491 19.0001 9.7041Z"
              stroke="currentColor" stroke-width="1.5" />
            <path opacity="0.5" d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          </svg>
        </div>
        <span class="ltr:mr-3 rtl:ml-3">Documentation: </span>
        <a href="https://www.npmjs.com/package/vue3-apexcharts" target="_blank"
          class="block hover:underline">https://www.npmjs.com/package/vue3-apexcharts</a>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white-light">Simple Line</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="lineChart" :series="lineChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Simple Area</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="areaChart" :series="areaChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Simple Column</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="columnChart" :series="columnChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Simple Column Stacked</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="simpleColumnStacked" :series="simpleColumnStackedSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Simple Bar</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="barChart" :series="barChartSeries" class="bg-white dark:bg-black rounded-lg">
          </apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Mixed</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="mixedChart" :series="mixedChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Basic Radar</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="radarChart" :series="radarChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Basic Pie</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="pieChart" :series="pieChartSeries" class="bg-white dark:bg-black rounded-lg">
          </apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Basic Donut</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="donutChart" :series="donutChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Basic Polar Area</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="polarAreaChart" :series="polarAreaChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Radial Bar</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="radialBarChart" :series="radialBarChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white">Bubble Chart</h5>
        </div>
        <div class="mb-5">
          <apexchart height="300" :options="bubbleChart" :series="bubbleChartSeries"
            class="bg-white dark:bg-black rounded-lg"></apexchart>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, computed, inject } from 'vue';
import apexchart from 'vue3-apexcharts';

const theme = inject('theme');
const rtlClass = inject('rtlClass');

const generateData = (baseval, count, yrange) => {
  var i = 0;
  var series = [];
  while (i < count) {
    var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;
    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
    var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

    series.push([x, y, z]);
    baseval += 86400000;
    i++;
  }
  return series;
};

const lineChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  const isRtl = rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'line',
      toolbar: false,
    },
    colors: ['#4361ee'],
    tooltip: {
      marker: false,
      y: {
        formatter(number) {
          return '$' + number;
        },
      },
      theme: isDark ? 'dark' : 'light',
    },
    stroke: {
      width: 2,
      curve: 'smooth',
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June'],
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      opposite: isRtl ? true : false,
      labels: {
        offsetX: isRtl ? -20 : 0,
      },
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
  };
});

const lineChartSeries = ref([
  {
    name: 'Sales',
    data: [45, 55, 75, 25, 45, 110],
  },
]);

const areaChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  const isRtl = rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      type: 'area',
      height: 300,
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#805dca'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 2,
      curve: 'smooth',
    },
    xaxis: {
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      opposite: isRtl ? true : false,
      labels: {
        offsetX: isRtl ? -40 : 0,
      },
    },
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    legend: {
      horizontalAlign: 'left',
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
    tooltip: {
      theme: isDark ? 'dark' : 'light',
    },
  };
});

const areaChartSeries = ref([
  {
    name: 'Income',
    data: [16800, 16800, 15500, 17800, 15500, 17000, 19000, 16000, 15000, 17000, 14000, 17000],
  },
]);

const columnChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  const isRtl = rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'bar',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#805dca', '#e7515a'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent'],
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded',
      },
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      opposite: isRtl ? true : false,
      labels: {
        offsetX: isRtl ? -10 : 0,
      },
    },
    tooltip: {
      theme: isDark ? 'dark' : 'light',
      y: {
        formatter: function (val) {
          return val;
        },
      },
    },
  };
});

const columnChartSeries = ref([
  {
    name: 'Net Profit',
    data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
  },
  {
    name: 'Revenue',
    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
  },
]);

const simpleColumnStacked = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  const isRtl = rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'bar',
      stacked: true,
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#2196f3', '#3b3f5c'],
    responsive: [
      {
        breakpoint: 480,
        options: {
          legend: {
            position: 'bottom',
            offsetX: -10,
            offsetY: 5,
          },
        },
      },
    ],
    plotOptions: {
      bar: {
        horizontal: false,
      },
    },
    xaxis: {
      type: 'datetime',
      categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT', '01/05/2011 GMT', '01/06/2011 GMT'],
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      opposite: isRtl ? true : false,
      labels: {
        offsetX: isRtl ? -20 : 0,
      },
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
    legend: {
      position: 'right',
      offsetY: 40,
    },
    tooltip: {
      theme: isDark ? 'dark' : 'light',
    },
    fill: {
      opacity: 0.8,
    },
  };
});

const simpleColumnStackedSeries = ref([
  {
    name: 'PRODUCT A',
    data: [44, 55, 41, 67, 22, 43],
  },
  {
    name: 'PRODUCT B',
    data: [13, 23, 20, 8, 13, 27],
  },
]);

const barChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  const isRtl = rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'bar',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 1,
    },
    colors: ['#4361ee'],
    xaxis: {
      categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      opposite: isRtl ? true : false,
      reversed: isRtl ? true : false,
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
    plotOptions: {
      bar: {
        horizontal: true,
      },
    },
    fill: {
      opacity: 0.8,
    },
  };
});

const barChartSeries = ref([
  {
    name: 'Sales',
    data: [44, 55, 41, 67, 22, 43, 21, 70],
  },
]);

const mixedChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  const isRtl = rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      height: 300,
      // stacked: false,
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#2196f3', '#00ab55', '#4361ee'],
    stroke: {
      width: [0, 2, 2],
      curve: 'smooth',
    },
    plotOptions: {
      bar: {
        columnWidth: '50%',
      },
    },
    fill: {
      opacity: [1, 0.25, 1],
    },

    labels: [
      '01/01/2022',
      '02/01/2022',
      '03/01/2022',
      '04/01/2022',
      '05/01/2022',
      '06/01/2022',
      '07/01/2022',
      '08/01/2022',
      '09/01/2022',
      '10/01/2022',
      '11/01/2022',
    ],
    markers: {
      size: 0,
    },
    xaxis: {
      type: 'datetime',
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      title: {
        text: 'Points',
      },
      min: 0,
      opposite: isRtl ? true : false,
      labels: {
        offsetX: isRtl ? -10 : 0,
      },
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
    tooltip: {
      shared: true,
      intersect: false,
      theme: isDark ? 'dark' : 'light',
      y: {
        formatter: (y) => {
          if (typeof y !== 'undefined') {
            return y.toFixed(0) + ' points';
          }
          return y;
        },
      },
    },
    legend: {
      itemMargin: {
        horizontal: 4,
        vertical: 8,
      },
    },
  };
});

const mixedChartSeries = ref([
  {
    name: 'TEAM A',
    type: 'column',
    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30],
  },
  {
    name: 'TEAM B',
    type: 'area',
    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43],
  },
  {
    name: 'TEAM C',
    type: 'line',
    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39],
  },
]);

const radarChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'radar',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#4361ee'],
    xaxis: {
      categories: ['January', 'February', 'March', 'April', 'May', 'June'],
    },
    plotOptions: {
      radar: {
        polygons: {
          strokeColors: isDark ? '#191e3a' : '#e0e6ed',
          connectorColors: isDark ? '#191e3a' : '#e0e6ed',
        },
      },
    },
    tooltip: {
      theme: isDark ? 'dark' : 'light',
    },
  };
});

const radarChartSeries = ref([
  {
    name: 'Series 1',
    data: [80, 50, 30, 40, 100, 20],
  },
]);

const pieChart = computed(() => {
  return {
    chart: {
      height: 300,
      type: 'pie',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
    colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
    stroke: {
      show: false,
    },
    legend: {
      position: 'bottom',
    },
  };
});

const pieChartSeries = ref([44, 55, 13, 43, 22]);

const donutChart = computed(() => {
  return {
    chart: {
      height: 300,
      type: 'donut',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    stroke: {
      show: false,
    },
    labels: ['Team A', 'Team B', 'Team C'],
    colors: ['#4361ee', '#805dca', '#e2a03f'],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
    legend: {
      position: 'bottom',
    },
  };
});

const donutChartSeries = ref([44, 55, 13]);

const polarAreaChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'polarArea',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f', '#2196f3', '#3b3f5c'],
    stroke: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
    plotOptions: {
      polarArea: {
        rings: {
          strokeColor: isDark ? '#191e3a' : '#e0e6ed',
        },
        spokes: {
          connectorColors: isDark ? '#191e3a' : '#e0e6ed',
        },
      },
    },
    legend: {
      position: 'bottom',
    },
    fill: {
      opacity: 0.85,
    },
  };
});

const polarAreaChartSeries = ref([14, 23, 21, 17, 15, 10, 12, 17, 21]);

const radialBarChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'radialBar',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#4361ee', '#805dca', '#e2a03f'],
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            fontSize: '22px',
          },
          value: {
            fontSize: '16px',
          },
          total: {
            show: true,
            label: 'Total',
            formatter: function (w) {
              // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
              return 249;
            },
          },
        },
      },
    },
    labels: ['Apples', 'Oranges', 'Bananas'],
    fill: {
      opacity: 0.85,
    },
  };
});

const radialBarChartSeries = ref([44, 55, 41]);

const bubbleChart = computed(() => {
  const isDark = theme === 'dark' ? true : false;
  const isRtl = rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'bubble',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ['#4361ee', '#00ab55'],
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      tickAmount: 12,
      type: 'category',
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      max: 70,
      opposite: isRtl ? true : false,
      labels: {
        offsetX: isRtl ? -10 : 0,
      },
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
    tooltip: {
      theme: isDark ? 'dark' : 'light',
    },
    stroke: {
      colors: isDark ? ['#191e3a'] : ['#e0e6ed'],
    },
    fill: {
      opacity: 0.85,
    },
  };
});

const bubbleChartSeries = ref([
  {
    name: 'Bubble1',
    data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
      min: 10,
      max: 60,
    }),
  },
  {
    name: 'Bubble2',
    data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
      min: 10,
      max: 60,
    }),
  },
]);
</script>
