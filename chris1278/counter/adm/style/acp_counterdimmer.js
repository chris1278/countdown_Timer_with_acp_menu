/* acp_counterdimmer.js
------------------------------------*/

'use strict';

counterdimmer.setConfig = function () {
	const enabled = "1.0";
	const disabled = "0.35";

	document.getElementById("dim_counter_text_opt").style.opacity = ((document.getElementById("counter_text_0").checked) ? disabled : enabled);
};

counterdimmer.customFormReset = function () {
	document.getElementById("chris1278_counter_acp").reset();
	counterdimmer.setConfig();
};

window.onload = counterdimmer.setConfig();
