newAppointement = {
	baseURI: 'https://poilsopattesbackend.raffiskender.com/wp-json/poils-o-pattes/v1/calendar/',
	
  thisDaysTimes:"",
	day: "",
	time: "",
	skateholderId: "",
	customerId: "",
	dogId: "0",
	
	handleDisplayNewAppointement: async function(event) {
		//* Dom Elements Creation
		const newButton = event.currentTarget;
		newAppointement.skateholderId = newButton.dataset.skateholderId
		const allModifyAndDeleteButtons = document.querySelectorAll('.modify, .delete')
		
		const formDiv = document.querySelector('.newAppointement');		
		const dayInput = document.querySelector('.newFormInputDay');		
		const timeChoose = document.querySelector('.newFormTimeChoose');
		const customerSelect = document.querySelector('.newFormSelectCustomer');
		const dogSelect = document.querySelector('.newFormSelectDog');
		
		const allDogs = JSON.parse(dogSelect.dataset.dogs);
		
		//* changing displays
		//* Disabeling all buttons
		for (const currentButton of allModifyAndDeleteButtons){
			currentButton.disabled = true;
		}
		//* Hide the 'Add New' button
		newButton.classList.add('hide');	
		
		//* showing Form
		formDiv.classList.remove('hide');	
		
		//* showing All availiables appointements of selected Day :
				
		//* 1-Waiting for appointments datas to be fetched
		const tampon = await newAppointement.loadThisDayAppointementsFromAPI(dayInput.value);
		console.log(newAppointement.thisDaysTimes);
		//* 2- Displaying all available appointements times in the timeChoose zone:
		
		for (currentAppointement of newAppointement.thisDaysTimes){
			//console.log(timeText.dataset.currentTime);
			const newDiv = document.createElement('div');
			timeChoose.append(newDiv);
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
				
			newDiv.append(newInput, newLabel)
			
		}

		newAppointement.customerId = customerSelect.value;
		
		for (currentDog of allDogs){
			if (currentDog.owner == customerSelect.value){
				newOption = document.createElement('option');
				newOption.text = currentDog.name;
				newOption.value = currentDog.id;
				dogSelect.append(newOption);
			}
		}
		newAppointement.dogId = dogSelect.value;
	},
		
	handleSwitchDogsSelectOptions : function(event){
		currentSelect = event.currentTarget;
		const appointement = currentSelect.closest('.appointement');
		const dogSelect = document.querySelector('.newFormSelectDog');
		const allDogs = JSON.parse(dogSelect.dataset.dogs);

		newAppointement.customerId = currentSelect.value
		
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
				newAppointement.newAppointementDog = dogSelect.value;
	},
	
	handleRecordDogsSelect : function (event){
				newAppointement.dogId = event.currentTarget.value;
	},
	
	handleSwitchTimesRadioButtons : async function(event){
		const currentDate = event.currentTarget;
		newAppointement.day = currentDate.value
	
		//* Waiting for appointments datas to be fetched
		const tampon = await newAppointement.loadThisDayAppointementsFromAPI(newAppointement.day);
	
		const timeZone = document.querySelector('.newFormTimeChoose')
		
		//* Displaying all available appointements times in the timeZone:
		timeZone.querySelectorAll('div').forEach(d => d.remove());

		for (currentAppointement of newAppointement.thisDaysTimes){
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

			newDiv.append(newInput, newLabel)
		}
	},
	

	handleInsertNewAppointement : async function(event) {
		 const createButton = event.currentTarget;
		
		newAppointement.day = document.querySelector('.newFormInputDay').value;
		newAppointement.time = document.querySelector('input[name="timeProposals"]:checked').value;
		newAppointement.customerId = document.querySelector('.newFormSelectCustomer').value
		newAppointement.dogId = document.querySelector('.newFormSelectDog').value

		const response = await newAppointement.insertNewInDB();
		location.reload();
	},
	
	loadThisDayAppointementsFromAPI : async function (date) {
		date = date.replace('-', '');
		date = date.replace('-', '');
				
		await fetch(newAppointement.baseURI + "day/" + date)
			// Quand la réponse est reçue
			.then(
				function (response) {
						return response.json();
				}
			)
			.then(
				function (appointements) {
					newAppointement.thisDaysTimes = appointements;
				}
			);
	},

 	insertNewInDB : async function(){
	  const httpHeaders = new Headers();
    httpHeaders.append("Content-Type", "application/json");
		const appointementObject = {
				"customerId": newAppointement.customerId,
				"dogId": newAppointement.dogId,
				"skatholerId": newAppointement.skateholderId,
				"day": newAppointement.day,
				"startTime": newAppointement.time,
				"stopTime":"00:00:00",
		}
	console.log(appointementObject);    const config = {
			method: 'POST',
			mode: 'cors',
			cache: 'no-cache',
			headers: httpHeaders,
			body: JSON.stringify(appointementObject)
    };

		await fetch(newAppointement.baseURI, config)
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
	 
}