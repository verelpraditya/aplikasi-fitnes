// form validation function //
function validate(form, arrItem) {	
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var jamRegex = /^([0-1][0-9]|2[0-3])\:[0-5][0-9]$/;
	var tglRegex = /^(0?[1-9]|[12][0-9]|3[01])[- /.](0?[1-9]|1[012])[- /.](19|20)\d\d$/;
	for (var i=0; i<=arrItem.length; i++) {
		var item = eval('form.'+arrItem[i]+'.value');
		if (item == '' && arrItem[i] != 'Jam2') {		
			inlineMsg(arrItem[i],'<b>Catatan:</b><br>'+arrItem[i]+' tidak boleh kosong.', 2);
			return false;
		}		
		if (arrItem[i] == 'email') {
			if(!item.match(emailRegex)) {
				inlineMsg(arrItem[i],'<b>Catatan:</b><br>Anda memasukkan email yang tidak valid.', 2);
				return false;
			}
		}
		if (arrItem[i] == 'Jam' || arrItem[i] == 'Jam2') {
			if(!item.match(jamRegex)) {
				inlineMsg(arrItem[i],'<b>Catatan:</b><br>Anda memasukkan jam yang tidak valid.', 2);
				return false;
			}
		}
		if (arrItem[i] == 'Tanggal' || arrItem[i] == 'Tanggal2') {
			if(!item.match(tglRegex)) {
				inlineMsg(arrItem[i],'<b>Catatan:</b><br>Anda memasukkan tanggal yang tidak valid.', 2);
				return false;
			}
		}
	}
	return true;
}

// START OF MESSAGE SCRIPT //

var MSGTIMER = 20;
var MSGSPEED = 5;
var MSGOFFSET = 3;
var MSGHIDE = 3;

// build out the divs, set attributes and call the fade function //
function inlineMsg(target,string,autohide) {
	var msg;
	var msgcontent;
	if(!document.getElementById('msg')) {
		msg = document.createElement('div');
		msg.id = 'msg';
		msgcontent = document.createElement('div');
		msgcontent.id = 'msgcontent';
		document.body.appendChild(msg);
		msg.appendChild(msgcontent);
		msg.style.filter = 'alpha(opacity=0)';
		msg.style.opacity = 0;
		msg.alpha = 0;
	} 
	else {
		msg = document.getElementById('msg');
		msgcontent = document.getElementById('msgcontent');
	}
	msgcontent.innerHTML = string;
	msg.style.display = 'block';
	var msgheight = msg.offsetHeight;
	var targetdiv = document.getElementById(target);
	targetdiv.focus();
	var targetheight = targetdiv.offsetHeight;
	var targetwidth = targetdiv.offsetWidth;
	var topposition = topPosition(targetdiv) - ((msgheight - targetheight) / 2);
	var leftposition = leftPosition(targetdiv) + targetwidth + MSGOFFSET;
	msg.style.top = topposition + 'px';
	msg.style.left = leftposition + 'px';
	clearInterval(msg.timer);
	msg.timer = setInterval("fadeMsg(1)", MSGTIMER);
	if(!autohide) {
		autohide = MSGHIDE;  
	}
	window.setTimeout("hideMsg()", (autohide * 1000));
}

// hide the form alert //
function hideMsg(msg) {
	var msg = document.getElementById('msg');
	if(!msg.timer) {
		msg.timer = setInterval("fadeMsg(0)", MSGTIMER);
	}
}

// face the message box //
function fadeMsg(flag) {
	if(flag == null) {
		flag = 1;
	}
	var msg = document.getElementById('msg');
	var value;
	if(flag == 1) {
		value = msg.alpha + MSGSPEED;
	} 
	else {
		value = msg.alpha - MSGSPEED;
	}
	msg.alpha = value;
	msg.style.opacity = (value / 100);
	msg.style.filter = 'alpha(opacity=' + value + ')';
	if(value >= 99) {
		clearInterval(msg.timer);
		msg.timer = null;
	} 
	else if(value <= 1) {
		msg.style.display = "none";
		clearInterval(msg.timer);
	}
}

// calculate the position of the element in relation to the left of the browser //
function leftPosition(target) {
	var left = 0;
	if(target.offsetParent) {
		while(1) {
			left += target.offsetLeft;
			if(!target.offsetParent) {
				break;
			}
			target = target.offsetParent;
		}
	} 
	else if(target.x) {
		left += target.x;
	}
	return left;
}

// calculate the position of the element in relation to the top of the browser window //
function topPosition(target) {
	var top = 0;
	if(target.offsetParent) {
		while(1) {
			top += target.offsetTop;
			if(!target.offsetParent) {
				break;
			}
			target = target.offsetParent;
		}
	} 
	else if(target.y) {
		top += target.y;
	}
	return top;
}

// preload the arrow //
if(document.images) {
	arrow = new Image(7,80); 
	arrow.src = "../images/msg_arrow.gif"; 
}