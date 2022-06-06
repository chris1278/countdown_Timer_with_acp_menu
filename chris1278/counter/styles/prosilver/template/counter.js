window.addEventListener('DOMContentLoaded', CountdownAds);
var countdownyear = countdown_year;
var CountdownMonth = Countdown_Month;
var countdownday = countdown_day;
var countdownhour = countdown_hour
var CountdownMinute = Countdown_Minute;
var countdownsecond = countdown_second;
var counterfinish = js_counter_finish;
var counterbefore = js_counter_before;
var counterbreakbefore = js_counter_break_before;
var counterbreakafter = js_counter_break_after;
var counterafter = js_counter_after;
function CountdownAds()
{
	var now = new Date();
	var Countdown = new Date(countdownyear, CountdownMonth-1, countdownday, countdownhour, CountdownMinute, countdownsecond);
	var MillisecondsToCountdown = Countdown.getTime()-now.getTime();
	var Rest = Math.floor(MillisecondsToCountdown/1000);
	var CountdownText = "";

	if(Rest <= 0)
	{
		document.getElementById('Countdown').innerHTML = counterfinish;
		return;
	}
	else
	{
		if(Rest>=31536000)
		{
				var years = Math.floor(Rest/31536000);
				Rest = Rest-years*31536000;
				(years != 1) ? CountdownText += years + " " + count_years + " " : CountdownText += years + " " +  count_year + " " ;
		}
		if(Rest>=86400)
		{
				var days = Math.floor(Rest/86400);
				Rest = Rest-days*86400;
				(days != 1) ? CountdownText += days + " " + count_days + " " : CountdownText += days + " " +  count_day + " " ;
		}
		if(Rest>=3600)
		{
				var hours = Math.floor(Rest/3600);
				Rest = Rest-hours*3600;
				(hours != 1) ? CountdownText += hours + " " + count_hours + " " : CountdownText += hours + " " +  count_hour + " " ;
		}
		if(Rest>=60)
		{
				var minutes = Math.floor(Rest/60);
				Rest = Rest-minutes*60;
				(minutes != 1) ? CountdownText += minutes + " " + count_minutes + " " : CountdownText += minutes + " " +  count_minute + " " ;
		}
		(Rest != 1) ? CountdownText += Rest + " " + count_seconds : CountdownText += Rest + " " + count_second;
		document.getElementById('Countdown').innerHTML = counterbefore + counterbreakbefore + CountdownText + counterbreakafter + counterafter;
		window.setTimeout("CountdownAds()", 1000);
	}
}
