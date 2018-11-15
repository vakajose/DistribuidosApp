$(document).ready(function($) {

  var ctx = $("#pieChart");
    var back = [];
    var bord = [];
    pieData[0].forEach( function(label, i) {
        var colors = getRandRGBA(0.8, 0.5);
        back.push(colors[0]);
        bord.push(colors[1]);
    });
  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: pieData[0],//[0]
        datasets: [{
            data: pieData[1], //[1]
            backgroundColor: back,
            borderColor: '#ffffff',
            borderWidth: 1
        }]
    },
    options: {
        responsive : true,
    }
	});	
});

function getRandColor(){
	var colors =['#C46F6F','#A2C46F','#562846','#A4F857','#B66FC4','#4FD6DD'];
	return colors[Math.floor(Math.random()*colors.length)];
}
function getRandRGBA(alfa1,alfa2){
    var r = getRandomInt(0,256);
    var rs = r.toString();

    var g = getRandomInt(0,256);
    var gs = g.toString();

    var b = getRandomInt(0,256);
    var bs = b.toString();
    var colors= [];
    colors.push('rgba('+rs+','+gs+','+bs+','+ alfa1.toString() +')');
    colors.push('rgba('+rs+','+gs+','+bs+','+ alfa2.toString() +')');
    return colors;
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
