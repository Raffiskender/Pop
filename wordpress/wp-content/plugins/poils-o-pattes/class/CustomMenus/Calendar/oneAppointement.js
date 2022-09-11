oneAppointement = {
	baseURI: 'https://poilsopattesbackend.raffiskender.com/wp-json/poils-o-pattes/v1/calendar/',
	response : "",
	appointementDay : "",
	appointementID : "",
	newAppointementDay : "",
	newAppointementTime : "",
	newAppointementCustomerId : "",
	newAppointementDog : "",
	stakholderId : "",
	
	handleSwitchToEditMode: async function(event) {
		//* Dom Elements Creation
		const modifyButton = event.currentTarget;
		const appointementDetails = modifyButton.closest('.appointement');
		
		oneAppointement.appointementID = appointementDetails.querySelector('h3').dataset.id;
		
		const allModifyAndDeleteButtons = document.querySelectorAll('.modify, .delete')
		
		const validateButton = appointementDetails.querySelector('.validate');
		const cancelButton = appointementDetails.querySelector('.cancel');
		
		const dayText = appointementDetails.querySelector('.day');
		const dayInput = appointementDetails.querySelector('.inputDay');
		
		const timeText = appointementDetails.querySelector('.time');
		//const timeInput = appointementDetails.querySelector('.inputTime');
		
		const customerText = appointementDetails.querySelector('.customer');
		const customerSelect = appointementDetails.querySelector('.selectCustomer');
		
		const dogText = appointementDetails.querySelector('.dog');
		const dogSelect = appointementDetails.querySelector('.selectDog');
		const allDogs = JSON.parse(dogSelect.dataset.dogs);
		
		//console.log (allModifyAndDeleteButtons);
		for (currentButton of allModifyAndDeleteButtons){
			currentButton.disabled = true;
		}
		
		appointementDetails.querySelector('.delete').classList.add('hide');
		modifyButton.classList.add('hide');
		validateButton.classList.remove('hide');
		cancelButton.classList.remove('hide');
		dayText.classList.add('hide');

		oneAppointement.appointementDay = dayText.dataset.appointementDate;
		dayInput.classList.remove('hide');
		oneAppointement.newAppointementDay = dayInput.value;
		
		
		//* Waiting for appointments datas to be fetched
		const tampon = await oneAppointement.loadThisDayAppointementsFromAPI(dayInput.value);
		timeText.classList.add('hide');
		timeZone = appointementDetails.querySelector('.timeChoose')
		//* Displaying all available appointements times in the timeZone:
		
		for (currentAppointement of oneAppointement.response){
			//console.log(timeText.dataset.currentTime);
			const newDiv = document.createElement('div');
			timeZone.append(newDiv);
				//* Radio Buttons
				const newInput = document.createElement('input');
				newInput.classList.add('radio', 'hide');
				newInput.type = ('radio');
				newInput.name = ('timeProposals');
				newInput.id = (currentAppointement.readableTime);
				newInput.value = (currentAppointement.inDBtime);

				//* Labels for Radio Buttons
				const newLabel = document.createElement('label');
				newLabel.classList.add('button-time');
				newLabel.htmlFor = (currentAppointement.readableTime);
				newLabel.textContent = (currentAppointement.readableTime);

				//* disableling choice if this date is unavailable  
				if(currentAppointement.available == 0){
					newLabel.classList.add('unavailable');
					newInput.disabled=true;
				}
				
				if (currentAppointement.readableTime == timeText.dataset.currentTime){
					newInput.disabled=false;
					newInput.checked=true;
					newLabel.classList.remove('unavailable');
				}
				
			newDiv.append(newInput, newLabel)
		}

		//timeInput.classList.remove('hide');
		customerText.classList.add('hide');
		customerSelect.classList.remove('hide');
		oneAppointement.newAppointementCustomerId = customerSelect.value;
		
		dogText.classList.add('hide');
		dogSelect.classList.remove('hide');
		const displayedDog = dogSelect.dataset.displayedDog;
		
		for (currentDog of allDogs){
			if (currentDog.owner == customerSelect.value){
				newOption = document.createElement('option');
				newOption.text = currentDog.name;
				newOption.value = currentDog.id;
				if (currentDog.name == displayedDog){
					newOption.selected = true;
				}
				dogSelect.append(newOption);
			}
		}
		oneAppointement.newAppointementDog = dogSelect.value;
	},
		
	handleSwitchDogsSelectOptions : function(event){
		currentSelect = event.currentTarget;
		const appointement = currentSelect.closest('.appointement');
		const dogSelect = appointement.querySelector('.selectDog');
		const allDogs = JSON.parse(dogSelect.dataset.dogs);

		oneAppointement.newAppointementCustomerId = currentSelect.value
		
		const options = dogSelect.querySelectorAll('option');
		//* Deletting all options before replacing them
		options.forEach(o => o.remove());
		
		for (currentDog of allDogs){
			if (currentDog.owner == currentSelect.value){
				newOption = document.createElement('option');
				newOption.text = currentDog.name;
				newOption.value = currentDog.id;
				dogSelect.append(newOption);
			}
		}
				oneAppointement.newAppointementDog = dogSelect.value;
	},
	
	handleRecordDogsSelect : function (event){
				oneAppointement.newAppointementDog = event.currentTarget.value;
	},
	
	handleAbordChanges : function (){
		location.reload();
	},
	
	handleSwitchTimesRadioButtons : async function(event){
		const currentDate = event.currentTarget;
		oneAppointement.newAppointementDay = currentDate.value
		
		const appointementDetails = currentDate.closest('.appointement');
		const timeText = appointementDetails.querySelector('.time');
		
		//* Waiting for appointments datas to be fetched
		const tampon = await oneAppointement.loadThisDayAppointementsFromAPI(oneAppointement.newAppointementDay);
	
		timeZone = appointementDetails.querySelector('.timeChoose')
		//* Displaying all available appointements times in the timeZone:
		allTimes = timeZone.querySelectorAll('div')
			allTimes.forEach(d => d.remove());

		for (currentAppointement of oneAppointement.response){
			//console.log(timeText.dataset.currentTime);
			const newDiv = document.createElement('div');
			
			timeZone.append(newDiv);
				//* Radio Buttons
				const newInput = document.createElement('input');
				newInput.classList.add('radio', 'hide');
				newInput.type = ('radio')
				newInput.name = ('timeProposals')
				newInput.id = (currentAppointement.readableTime)
				newInput.value = (currentAppointement.inDBtime)

				//* Labels for Radio Buttons
				const newLabel = document.createElement('label');
				newLabel.classList.add('button-time');
				newLabel.htmlFor = (currentAppointement.readableTime)
				newLabel.textContent = (currentAppointement.readableTime)

				//* disableling choice if this date is unavailable  
				if(currentAppointement.available == 0){
					newLabel.classList.add('unavailable');
					newInput.disabled=true
				}
				
				if (currentAppointement.readableTime == timeText.dataset.currentTime && currentDate.value == oneAppointement.appointementDay){
					newInput.checked=false
					newInput.disabled=false
					newLabel.classList.remove('unavailable');
				}	
			newDiv.append(newInput, newLabel)
		}
	},
	
	handlePreDelete : function(event) {
		const currentDeleteButton = event.currentTarget;
		const currentAppointement = currentDeleteButton.closest('.appointement');
		currentDeleteButton.classList.add('hide');
		currentAppointement.querySelector('.confirm').classList.remove('hide');
		currentAppointement.querySelector('.modify').disabled = true;
		currentAppointement.querySelector('.confirmButtons').classList.remove('hide');
		
	},
	
	handleCancelDelete : function(event) {
		const currentNoButton = event.currentTarget;
		const currentAppointement = currentNoButton.closest('.appointement');
		currentAppointement.querySelector('.modify').disabled = false;
		currentAppointement.querySelector('.delete').classList.remove('hide');
		currentAppointement.querySelector('.confirm').classList.add('hide');
		currentAppointement.querySelector('.confirmButtons').classList.add('hide');
	},
	
	handleConfirmDelete : async function(event) {
		const currentNoButton = event.currentTarget;
		const currentAppointement = currentNoButton.closest('.appointement');
		
		oneAppointement.appointementID = currentAppointement.querySelector('h3').dataset.id;
		
		const tampon = await oneAppointement.delete();
		location.reload();
		
	},
	
	handleInsertChanges : async function(event) {
		const validateButton = event.currentTarget;
		const appointementDetails = validateButton.closest('.appointement');
		oneAppointement.newAppointementTime = appointementDetails.querySelector('input[name="timeProposals"]:checked').value;

		const response = await oneAppointement.insertInDB()
		
		location.reload();
	},
	handleHonoreAppointement : async function(event)  {
		const honorMe = event.currentTarget;
		oneAppointement.appointementID = honorMe.dataset.rdvId
		oneAppointement.stakholderId = honorMe.dataset.userId
		const tampon = await oneAppointement.insertInDB();
		location.reload();

	},
	loadThisDayAppointementsFromAPI : async function (date) {
		date = date.replace('-', '');
		date = date.replace('-', '');
				
		await fetch(oneAppointement.baseURI + 'day/' + date)
			// Quand la réponse est reçue
			.then(
				function (response) {
						return response.json();
				}
			)
			.then(
				function (appointements) {
					oneAppointement.response = appointements;
				}
			);
	},

 	insertInDB : async function(){
	  const httpHeaders = new Headers();
    httpHeaders.append("Content-Type", "application/json");
	const appointementObject = {}
		if (oneAppointement.newAppointementCustomerId != ""){
			appointementObject.customerId = oneAppointement.newAppointementCustomerId
		}
		if (oneAppointement.newAppointementdog != ""){
			appointementObject.dogId = oneAppointement.newAppointementDog
		}
		if (oneAppointement.newAppointementDay != ""){
			appointementObject.day = oneAppointement.newAppointementDay
		}
		if (oneAppointement.newAppointementTime != ""){
			appointementObject.startTime = oneAppointement.newAppointementTime
		}
		if (oneAppointement.stakholderId != ""){
			appointementObject.skatholerId = oneAppointement.stakholderId
		}
	
    const config = {
			method: 'PUT',
			mode: 'cors',
			cache: 'no-cache',
			headers: httpHeaders,
			body: JSON.stringify(appointementObject)
    };

		await fetch(oneAppointement.baseURI + oneAppointement.appointementID, config)
		// Quand la réponse est reçue
		.then(
			function (response) {
					return response.json();
			}).then(
				function (secondResponse) {
					console.log (secondResponse);
				}
			);
 	},
	 
  delete : async function(){
		const httpHeaders = new Headers();
    httpHeaders.append("Content-Type", "application/json");
			
    const config = {
			method: 'DELETE',
			mode: 'cors',
			cache: 'no-cache',
			headers: httpHeaders
    };

		await fetch(oneAppointement.baseURI + oneAppointement.appointementID, config)
		// Quand la réponse est reçue
		.then(
			function (response) {
					return response.json();
			}).then(
				function (secondResponse) {
					
			}
		);
 	},
}