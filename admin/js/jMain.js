function checkAll(n, state) {
	for (i=1; i<=n; i++) {
		box = eval('document.formDelete.cb'+i);
		if (state == true) {
			box.checked = true;
			document.formDelete.boxchecked.value=n;
		}
		else {
			box.checked = false;
			document.formDelete.boxchecked.value=0;
		}
	}
	
}
function isChecked(isitchecked){
	if (isitchecked == true){
		document.formDelete.boxchecked.value++;
	}
	else {
		document.formDelete.boxchecked.value--;
	}
}
function submitOrder() {
	document.adminForm.state.value='order';
	document.adminForm.submit();
}
function submitDelete() {
	if (document.formDelete.boxchecked.value == 0)
		alert('Silahkan pilih data yang ada di tabel.');
	else {
		document.formDelete.submit();
	}
}


function checkRadio(obj) {
	result=false;
	for (var i=0; i<=obj.length-1; i++) {
		if (obj[i].checked) {
			result=true;
			i=obj.length-1;
		}
	}
	if (!result) {
		alert('Anda belum menentukan pilihan.');
		return false;
	}

}
function onSubmit() {
	if (document.formAbsen.nis==''){
		alert('Masukkan NIS terlebih dahulu');
		return false;
	}
	else  {
		document.formAbsen.submit();
		return true;
	}
}
function popupCalendar(target) {
	show_calendar(target);
}
function enabledInput(cbInput,txtInput){
   if(eval(cbInput.checked) == true){
		txtInput.readOnly = false;
		txtInput.focus();
   } else if (eval(cbInput.checked) == false) {
		txtInput.value = '';
		txtInput.readOnly = true;
   }
}
function enabledInput2(cbInput,txtInput1, txtInput2){
   if(eval(cbInput.checked) == true){
		txtInput1.readOnly = false;
		txtInput2.readOnly = false;
		txtInput1.focus();
   } else if (eval(cbInput.checked) == false) {
		txtInput1.value = '';
		txtInput2.value = '';
		txtInput1.readOnly = true;
		txtInput2.readOnly = true;
   }
}