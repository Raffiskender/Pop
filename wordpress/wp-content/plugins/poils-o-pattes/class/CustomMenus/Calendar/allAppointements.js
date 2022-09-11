allAppointements = {
	
	init() {
		
		const newAppointementButton = document.querySelector('.new');
		newAppointementButton.addEventListener('click', newAppointement.handleDisplayNewAppointement)
		
		const newDayInput = document.querySelector('.newFormInputDay');
		newDayInput.addEventListener('change', newAppointement.handleSwitchTimesRadioButtons)
		
		const newSelectCustommer = document.querySelector('.newFormSelectCustomer');
		newSelectCustommer.addEventListener('change', newAppointement.handleSwitchDogsSelectOptions)
		
		const newSelectDog = document.querySelector('.newFormSelectDog');
		newSelectDog.addEventListener('change', newAppointement.handleRecordDogsSelect)
		
		const submitNewButton = document.querySelector('.newFormSubmitButton');
		submitNewButton.addEventListener('click', newAppointement.handleInsertNewAppointement)
	
		const allHonorMeButtons = document.querySelectorAll('.honorMe');
		for (const currentHonorMeButton of allHonorMeButtons){
			currentHonorMeButton.addEventListener('click', oneAppointement.handleHonoreAppointement)
		}
		const allModifyButtons = document.querySelectorAll('.modify');
		for (const currentModifyButton of allModifyButtons){
			currentModifyButton.addEventListener('click', oneAppointement.handleSwitchToEditMode)
		}
		
		const allCustomersSelects = document.querySelectorAll('.selectCustomer')
		for (const currentCustomersSelect of allCustomersSelects){
			currentCustomersSelect.addEventListener('change', oneAppointement.handleSwitchDogsSelectOptions)
		}
		const allDogsSelects = document.querySelectorAll('.selectDog')
		for (const currentDogsSelect of allDogsSelects){
			currentDogsSelect.addEventListener('change', oneAppointement.handleRecordDogsSelect)
		}
		
		const allTimesInputs = document.querySelectorAll('.inputDay')
		for (const currentTimeInput of allTimesInputs){
			currentTimeInput.addEventListener('change', oneAppointement.handleSwitchTimesRadioButtons)
		}
		
		const allValidateButton = document.querySelectorAll('.validate')
		for (const currentValidateButton of allValidateButton){
			currentValidateButton.addEventListener('click', oneAppointement.handleInsertChanges)
		}		
		const allCancelButton = document.querySelectorAll('.cancel')
		for (const currentCancelButton of allCancelButton){
			currentCancelButton.addEventListener('click', oneAppointement.handleAbordChanges);
		}	
		const allDeleteButton = document.querySelectorAll('.delete')
		for (const currentDeleteButton of allDeleteButton){
			currentDeleteButton.addEventListener('click', oneAppointement.handlePreDelete);
		}	
		const allConfirmYesButton = document.querySelectorAll('.confirm-yes')
		for (const currentConfirmYesButton of allConfirmYesButton){
			currentConfirmYesButton.addEventListener('click', oneAppointement.handleConfirmDelete);
		}
		const allConfirmNoButton = document.querySelectorAll('.confirm-no')
		for (const currentConfirmNoButton of allConfirmNoButton){
			currentConfirmNoButton.addEventListener('click', oneAppointement.handleCancelDelete);
		}	
	}
}