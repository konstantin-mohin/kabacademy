document.addEventListener("DOMContentLoaded", function(event) {
	const submit = document.getElementById('place_order');

	submit.onclick = () => {
		insertData()
	}
}, false );

function getAnalyticsData() {
	if (getParameterByName instanceof Function) {
		try {
			const data = {
				"gaClientId": ga.getAll()[0].get('clientId') || null,
				"gaUserId":  ga.getAll()[0].get('userId')|| null,
				"utmSource": getParameterByName('utm_source') || null,
				"utmCampaign": getParameterByName('utm_campaign') || null,
				"utmTerm": getParameterByName('utm_term') || null,
				"utmMedium": getParameterByName('utm_medium') || null,
				"utmContent": getParameterByName('utm_content') || null
			};

			return data;
		} catch (e) {
			console.error('error when get Analytics Data', e)
			return null
		}
	}
	return null;
}

function insertAnalytics() {
	const data = getAnalyticsData();

	if (data) {
		Object.keys(data).forEach(key => {
			const val = data[key];
			const el  = document.getElementById(key);

			el.value = val;
		});
	}
}

function insertData() {
	const leadIdField = document.getElementById('LeadId');

	leadIdField.value = window.getLeadId();
	// customerIP = window.ipGeoLocation ? window.ipGeoLocation.ip : null;
	insertAnalytics();
}
