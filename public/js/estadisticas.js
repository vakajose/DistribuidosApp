$(document).ready(function($) {

  var ctx = $("#pieChart");

  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: pieData[0],//[0]
        datasets: [{
            data: pieData[1], //[1]
            backgroundColor: getColors(pieData[0]),
            // borderColor: [ //[3]
            //     'rgba(255,99,132,1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            //     'rgba(75, 192, 192, 1)',
            //     'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)'
            // ],
            borderWidth: 1
        }]
    },
    options: {
        responsive : true,
    }
	});	
  console.log(pieData);
});
function getRandColor(){
	var colors =['#C46F6F','#A2C46F','#562846','#A4F857','#B66FC4','#4FD6DD'];
	return colors[Math.floor(Math.random()*colors.length)];
}
 function getRandRGBA(alfa){
	var r = getRandomInt(0,256);
	var rs = r.toString();

	var g = getRandomInt(0,256);
	var gs = g.toString();

	var b = getRandomInt(0,256);
	var bs = b.toString();

	return 'rgba('+rs+','+gs+','+bs+','+ alfa.toString() +')';
}
// Retorna un entero aleatorio entre min (incluido) y max (excluido)
// ¡Usando Math.round() te dará una distribución no-uniforme!
function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}
function getColors(data){
	var backgroundColor = [];
	
	data.forEach(function (item, index) {
		var rgba = getRandColor();
		backgroundColor.push(rgba);
	});
	return backgroundColor;
}

function changeEstadistica(argument) {
	// body...
}