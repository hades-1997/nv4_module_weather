<!-- BEGIN: main -->
<link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/weather/css/weather.css" type="text/css" media="all" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/weather/js/all.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/weather/js/weather.js"></script>
<div class="container-weather">
	<div class="main-section">
		<div class="search-bar">
			<span>Thông tin dự báo thời tiết</span>
		</div>
		<div class="info-wrapper">
			<p class="city-name">--</p>
			<p class="weather-state">--</p>
			<img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="weather-icon">
			<p class="temperature">--</p>
		</div>
	</div>
	<div class="additional-section">
		<div class="row">
			<div class="item">
				<div class="label">MT Mọc</div>
				<div class="value sunrise text-center">--</div>
			</div>
			<div class="item">
				<div class="label">MT Lặn</div>
				<div class="value sunset text-center">--</div>
			</div>
		</div>
		<div class="row">
			<div class="item">
				<div class="label">Độ ẩm</div>
				<div class="value text-center"><span class="humidity ">--</span>%</div>
			</div>
			<div class="item">
				<div class="label">Gió</div>
				<div class="value text-center"><span class="wind-speed">--</span> km/h</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	var APP_ID = '{CONFIG.token}';
	var DEFAULT_VALUE = '--';
	var CONFIG_CITY = '{CITY}';

	//const searchInput = document.querySelector('#search-input');
	var cityName = document.querySelector('.city-name');
	var weatherState = document.querySelector('.weather-state');
	var weatherIcon = document.querySelector('.weather-icon');
	var temperature = document.querySelector('.temperature');
	var sunrise = document.querySelector('.sunrise');
	var sunset = document.querySelector('.sunset');
	var humidity = document.querySelector('.humidity');
	var windSpeed = document.querySelector('.wind-speed');

	fetch('https://api.openweathermap.org/data/2.5/weather?q='+ CONFIG_CITY +'&appid='+ APP_ID +'&units=metric&lang=vi')
		.then(async res => {
			const data = await res.json();
			cityName.innerHTML = data.name || DEFAULT_VALUE;
			weatherState.innerHTML = data.weather[0].description || DEFAULT_VALUE;
			weatherIcon.setAttribute('src', `http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`);
			temperature.innerHTML = Math.round(data.main.temp) || DEFAULT_VALUE;

			sunrise.innerHTML = moment.unix(data.sys.sunrise).format('H:mm') || DEFAULT_VALUE;
			sunset.innerHTML = moment.unix(data.sys.sunset).format('H:mm') || DEFAULT_VALUE;
			humidity.innerHTML = data.main.humidity || DEFAULT_VALUE;
			windSpeed.innerHTML = (data.wind.speed * 3.6).toFixed(2) || DEFAULT_VALUE;
		});
</script>
<!-- END: main -->