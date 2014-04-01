
function create_event(day,month,year){
    alert("Today is " + month + day + year);
}
function test(){
	alert("It worked!");
}
function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
s=checkTime(s);
	if(h > 12){
		h = h - 12;	
		document.getElementById('txt').innerHTML=h+":"+m+":"+s+" PM";
	}
	else {
		document.getElementById('txt').innerHTML=h+":"+m+":"+s+" AM";
	}
t=setTimeout(function(){startTime()},500);

}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}