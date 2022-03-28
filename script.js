const makeCars = {
    functionname: 'makeCars',
    carNum: 3
}
const moveCars = {
    functionname: 'moveCars'
}
let movingCars = 0;
// USE RECEIVED DATA
function clientResponse(funct, data) {
    switch (funct) {
        case "makeCars": // kocsik elhelyezése a versenypályán a kapott adatok alapján
            console.log(data);
            $('.racetrack').empty();
            data["cars"].forEach(car => {
                const moveRotation = car["distance"] / 100 * 360 * car["maxLap"];
                $('.racetrack').append(
                    `<div id="car${car["placement"]}" class="racer"
                    style=" transform: translateY(-50%) rotate(-${moveRotation}deg);">
                   <div style="
                   right: ${car["placement"]*40}px; 
                   background-color: ${car["color"]};
                   " class="current-pos">
                   </div>
                   </div>`
                )
            });
            break;
        case "moveCars": // kocsik mozgása illetve nyerése a kapott adatok alapján
            movingCars = 0;
            console.log("car moving WROM WROM")
            console.log(data)
            const numOfCars = $('.racetrack').children().length;
            data["cars"].forEach(car => {
                const moveRotation = car["distance"] / 100 * 360 * car["maxLap"];
                $(`#car${car["placemenet"]}`).css("transform", `translateY(-50%) rotate(-${moveRotation}deg)`);
            if (car["distance"]<100){
                movingCars +=1;
            }
            });
            break;
        default:
            console.log("unknown function");
    }

}
// SEND DATA TO SERVER
function sendServerData(path, funct) {
    $.post(path, funct,
        function (data, status) {
            clientResponse(funct["functionname"], JSON.parse(data))
        });
}

$(".start-button").click(function () {
    sendServerData("init.php", makeCars);

    movingCars = 1;
    var interval = setInterval(() => {
        console.log(movingCars)
        if (movingCars <= 0) {
            clearInterval(interval)
        } else {
            sendServerData("init.php", moveCars);
        }
    }, 150)
});